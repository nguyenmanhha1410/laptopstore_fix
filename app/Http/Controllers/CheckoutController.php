<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Cart;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
use App\City;
use App\Province;
use Carbon\Carbon;
use App\Wards;
use App\Feeship;
use App\Slider;
use App\Shipping;
use App\Order;
use App\Coupon;
use App\OrderDetails;
use App\Contact;
use Auth;
use Toastr;


class CheckoutController extends Controller
{
    public function execPostRequest($url, $data)
        {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data))
            );
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            //execute post
            $result = curl_exec($ch);
            //close connection
            curl_close($ch);
            return $result;
        }
    public function momo_payment(Request $request){
        
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";



            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $orderInfo = "Thanh toán qua ATM MoMo";
            $amount = $_POST['total_momo'];
            $orderId = time() . "";
            $redirectUrl = env('APP_URL')."/checkout";
            $ipnUrl = env('APP_URL')."/checkout";
            $extraData = "";




        $requestId = time() . "";
        // $requestType = "payWithATM";
        $requestType ='captureWallet';
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        // dd($signature);
        $data = array('partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature,
           );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        // dd($result);
        $jsonResult = json_decode($result, true);  // decode json

    //Just a example, please check more in there
    
    return redirect()->to($jsonResult['payUrl'])->with(Session::put('success_momo',true)
);
    // header('Location: ' . $jsonResult['payUrl']);
            }
        
    public function vnpay_payment(Request $request){
        
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $data= $request->all();
            $code_cart = rand(00,9999);
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://localhost/LaptopStore/checkout";
            $vnp_TmnCode = "TFZTTZR7";//Mã website tại VNPAY 
            $vnp_HashSecret = "HLOVDLXJMSDNIRJBQXBESQMAHWTQWICQ"; //Chuỗi bí mật

            $vnp_TxnRef = $code_cart; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Thanh toan don hang test';
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $data['total_vnpay'] * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            //Add Params of 2.0.1 Version
            // $vnp_ExpireDate = $_POST['txtexpire'];
            //Billing
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
                      

            
            );


            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }
            //var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }
            $vnp_Url = $vnp_Url . "?" . $query;
            
            
            
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
           
            
            $returnData = array('code' => '00'
                , 'message' => 'success'
                , 'data' => $vnp_Url);
                
                if (isset($_POST['redirect'])) {

                    
                    header('Location: ' . $vnp_Url);
                    
                    die();
                } else {
                    echo json_encode($returnData);
                }
	// vui lòng tham khảo thêm tại code demo
    }


    public function confirm_order(Request $request){
         $data = $request->all();

         
        //get coupon
        if(Session::get('coupon')!=null)
        {
            $coupon = Coupon::where('coupon_code',$data['order_coupon'])->first();
           $coupon->coupon_used = $coupon->coupon_used.','.Session::get('customer_id');
           $coupon->coupon_time = $coupon->coupon_time - 1;
           $coupon->save();
           //get van chuyen
         $shipping = new Shipping();
         $shipping->shipping_name = $data['shipping_name'];
         $shipping->shipping_email = $data['shipping_email'];
         $shipping->shipping_phone = $data['shipping_phone'];
         $shipping->shipping_address = $data['shipping_address'];
         $shipping->shipping_notes = $data['shipping_notes'];
         $shipping->shipping_method = $data['shipping_method'];
         $shipping->save();
         $shipping_id = $shipping->shipping_id;

         $checkout_code = substr(md5(microtime()),rand(0,26),5);

        //get order
         $order = new Order;
         $order->customer_id = Session::get('customer_id');
         $order->shipping_id = $shipping_id;
         $order->order_status = 1;
         $order->order_code = $checkout_code;

         date_default_timezone_set('Asia/Ho_Chi_Minh');
         // $order->creat_at= now();

         $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');

         $order_date = Carbon::now('Asia/Ho_Chi_Minh')
         ->format('Y-m-d');
         // $order->creat_at =  date('d-m-y h:i:s');
         $order->created_at = $today;
         $order->order_date = $order_date;
         $order->save();
        }
        else{
         //get van chuyen
         $shipping = new Shipping();
         $shipping->shipping_name = $data['shipping_name'];
         $shipping->shipping_email = $data['shipping_email'];
         $shipping->shipping_phone = $data['shipping_phone'];
         $shipping->shipping_address = $data['shipping_address'];
         $shipping->shipping_notes = $data['shipping_notes'];
         $shipping->shipping_method = $data['shipping_method'];
         $shipping->save();
         $shipping_id = $shipping->shipping_id;

         $checkout_code = substr(md5(microtime()),rand(0,26),5);

        //get order
         $order = new Order;
         $order->customer_id = Session::get('customer_id');
         $order->shipping_id = $shipping_id;
         $order->order_status = 1;
         $order->order_code = $checkout_code;

         date_default_timezone_set('Asia/Ho_Chi_Minh');
         // $order->creat_at= now();

         $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');

         $order_date = Carbon::now('Asia/Ho_Chi_Minh')
         ->format('Y-m-d');
         // $order->creat_at =  date('d-m-y h:i:s');
         $order->created_at = $today;
         $order->order_date = $order_date;
         $order->save();
        }
         if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart){
                $order_details = new OrderDetails;
                $order_details->order_code = $checkout_code;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sales_quantity = $cart['product_qty'];
                $order_details->product_coupon =  $data['order_coupon'];
                $order_details->product_feeship = $data['order_fee'];
                $order_details->save();
            }
        }
        //  Session::forget('success_vnpay');
         Session::forget('coupon');
         Session::forget('fee');
         Session::forget('cart');
         Session::forget('success_paypal');
         Session::forget('success_vnpay');
         Session::forget('success_momo');
         Session::forget('total_paypal');


        //  return view('pages.history.history');
    }
    public function del_fee(){
        Session::forget('fee');
        return redirect()->back();
    }

     public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function calculate_fee(Request $request){
        $data = $request->all();
        if($data['matp']){
            $feeship = Feeship::where('fee_matp',$data['matp'])->where('fee_maqh',$data['maqh'])->where('fee_xaid',$data['xaid'])->get();
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship>0){
                     foreach($feeship as $key => $fee){
                        Session::put('fee',$fee->fee_feeship);
                        Session::save();
                        
                    }
                }else{ 
                    Session::put('fee',50000);
                    Session::save();
                    
                }
                
            }
            
           
        }
        
    }
    public function select_delivery_home(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action']=="city"){
                $select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
                    $output.='<option>---Chọn quận huyện---</option>';
                foreach($select_province as $key => $province){
                    $output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
                }

            }else{

                $select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                $output.='<option>---Chọn xã phường---</option>';
                foreach($select_wards as $key => $ward){
                    $output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
                }
            }
            echo $output;
        }
    }
    public function view_order($orderId){
        $this->AuthLogin();
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->select('tbl_order.*','tbl_customers.*','tbl_shipping.*','tbl_order_details.*')->first();

        $manager_order_by_id  = view('admin.order.view_order')->with('order_by_id',$order_by_id);
        return view('admin_layout')->with('admin.order.view_order', $manager_order_by_id);
        
    }
    public function login_checkout(Request $request){
         //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        $contact = Contact::where('info_id',1)->get();

        //seo 
        $meta_desc = "Đăng nhập thanh toán"; 
        $meta_keywords = "Đăng nhập thanh toán";
        $meta_title = "Đăng nhập thanh toán";
        $url_canonical = $request->url();
        //--seo 

    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get(); 



    	return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('contact',$contact);
    }
//     public function validation($request){

//         return $this->validate($request,[
//     'customer_name' => 'required|max:255',
//     'customer_phone' =>'required|max:255',
//     'customer_email' =>'required|unique:tbl_customers,customer_email|max:255',
//     'customer_password' =>'required|max:255',
//     ]);
// }
    public function add_customer(Request $request){
        // $this->validation($request);

        $data = $request->validate([
        'customer_email' => 'required|unique:tbl_customers|max:255|email',
        
        'customer_name' => 'required',
        'customer_phone' => 'required|numeric|digits_between:10,10',
        'customer_password' => 'required',
       
        
        ],
        [ 
        'customer_email.required' => 'Địa chỉ Email không được để trống',
        'customer_email.unique' => 'Địa chỉ Email đã tồn tại, vui lòng chọn tên khác',
        'customer_email.email' => 'Vui lòng điền địa chỉ Email hợp lệ',

        'customer_name.required' => 'Vui lòng điền họ tên của bạn',

        
        'customer_phone.required' => 'Vui lòng điền số điện thoại',
        'customer_phone.numeric' => 'Vui lòng điền số điện thoại hợp lệ',
        'customer_phone.digits_between' => 'Vui lòng điền số điện thoại là 10 số',
        'customer_phone.digits_between' => 'Vui lòng điền số điện thoại là 10 số',

        'customer_password.required' => 'Vui lòng điền mật khẩu',
        
       
      
            ]
        );

    	$data['customer_name'] = $request->customer_name;
    	$data['customer_phone'] = $request->customer_phone;
    	$data['customer_email'] = $request->customer_email;
    	$data['customer_password'] = md5($request->customer_password);

    	$customer_id = DB::table('tbl_customers')->where('customer_email','<>','')->insertGetId($data);

    	Session::put('customer_id',$customer_id);
    	Session::put('customer_name',$request->customer_name);
        Toastr::success('Đăng ký thành công, vui lòng đăng nhập','Thành công');

    	return Redirect::to('/dang-nhap');


    }
    // public function add_phone(Request $request){
    //     // $this->validation($request);

    //     // $data = $request->validate([
      
    //     // 'customer_phone' => 'required|numeric|digits_between:10,10',
       
       
        
    //     // ],
    //     // [ 
        

        
    //     // 'customer_phone.required' => 'Vui lòng điền số điện thoại',
    //     // 'customer_phone.numeric' => 'Vui lòng điền số điện thoại hợp lệ',
    //     // 'customer_phone.digits_between' => 'Vui lòng điền số điện thoại là 10 số',
    //     // 'customer_phone.digits_between' => 'Vui lòng điền số điện thoại là 10 số',
        
       
      
    //     //     ]
    //     // );

    
    // 	// $data['customer_phone'] = $request->customer_phone;
    

    // 	// $customer_id = DB::table('tbl_customers')->where('customer_email','<>','')->insertGetId($data);

    // 	// Session::put('customer_id',$customer_id);
    // 	// Session::put('customer_name',$request->customer_name);
    //     // Toastr::success('Xác nhận số điện thoại thành công','Thành công');

    // 	return Redirect::to('/checkout');


    // }
    public function checkout(Request $request){
         //seo 
         //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        $meta_desc = "Đăng nhập thanh toán"; 
        $meta_keywords = "Đăng nhập thanh toán";
        $meta_title = "Đăng nhập thanh toán";
        $url_canonical = $request->url();
        //--seo 
        
        //contact
        $contact = Contact::where('info_id',1)->get();

    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get(); 
        $city = City::orderby('matp','ASC')->get();


    	return view('pages.checkout.show_checkout')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('city',$city)->with('slider',$slider)->with('contact',$contact);
    }
    public function save_checkout_customer(Request $request){
    	$data = array();
    	$data['shipping_name'] = $request->shipping_name;
    	$data['shipping_phone'] = $request->shipping_phone;
    	$data['shipping_email'] = $request->shipping_email;
    	$data['shipping_notes'] = $request->shipping_notes;
    	$data['shipping_address'] = $request->shipping_address;

    	$shipping_id = DB::table('tbl_shipping')->insertGetId($data);

    	Session::put('shipping_id',$shipping_id);
    	
    	return Redirect::to('/payment');
    }
    public function payment(Request $request){
        //seo 
        $meta_desc = "Đăng nhập thanh toán"; 
        $meta_keywords = "Đăng nhập thanh toán";
        $meta_title = "Đăng nhập thanh toán";
        $url_canonical = $request->url();
        //--seo 
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get(); 
        $contact = Contact::where('info_id',1)->get();

        return view('pages.checkout.payment')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('contact',$contact);

    }
    public function order_place(Request $request){
        //insert payment_method
        //seo 
        $meta_desc = "Đăng nhập thanh toán"; 
        $meta_keywords = "Đăng nhập thanh toán";
        $meta_title = "Đăng nhập thanh toán";
        $url_canonical = $request->url();
        //--seo 
        // contact
        $contact = Contact::where('info_id',1)->get();

        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //insert order_details
        $content = Cart::content();
        foreach($content as $v_content){
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_d_data);
        }
        if($data['payment_method']=='chuyenkhoan'){

            Cart::destroy();

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get(); 

            return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('contact',$contact);


        }elseif($data['payment_method']=='tienmat'){
            Cart::destroy();

            $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
            $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get(); 
            $contact = Contact::where('info_id',1)->get();

            return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('contact',$contact);

        }else{
            echo 'Thẻ ghi nợ';

        }
        
        //return Redirect::to('/payment');
    }
    public function logout_checkout(){
    	Session::forget('customer_id');
    	Session::forget('coupon');
    	Session::forget('cart');
        Session::forget('success_paypal');
        Session::forget('success_momo');
        // Session::forget('success_vnpay');  
        Toastr::success('Đăng xuất thành công','Thành công');

    	return Redirect::to('/dang-nhap');
    }
    public function login_customer(Request $request){
    	$email = $request->email_account;
    	$password = md5($request->password_account);
    	$result = DB::table('tbl_customers')->where('customer_email',$email)->where('customer_password',$password)->first();
    	if(Session::get('coupon') == true){
            Session::forget('coupon');


        }
    	
    	if($result){
           
    		Session::put('customer_id',$result->customer_id);
    		Session::put('customer_name',$result->customer_name);
            Toastr::success('Đăng nhập thành công','Thành công');

    		return Redirect::to('/');
    	}
        else{
            Toastr::error('Vui lòng thử lại kiểm tra lại tài khoản và mật khẩu','Thất bại');

    		return Redirect::to('/dang-nhap');
    	}
        Session::save();
    
    }
    public function manage_order(){
        
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->select('tbl_order.*','tbl_customers.customer_name')
        ->orderby('tbl_order.order_id','desc')->get();
        $manager_order  = view('admin.order.manage_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.order.manage_order', $manager_order);
    }
}