<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>

<head>
  <title>
    Trang Quản lý Dành cho Admin | Home :: w3layouts
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
  <script type="application/x-javascript">
    addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);

                      function hideURLbar() { window.scrollTo(0, 1); }
  </script>
  <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

  <!-- Bootstrap Core CSS -->
  <link href="{{asset('public/backend/css/bootstrap.css')}}" rel="stylesheet" type="text/css" />
  <!-- Custom CSS -->
  <link href="{{asset('public/backend/css/style.css')}}" rel="stylesheet" type="text/css" />
  <!-- font-awesome icons CSS -->
  <link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet" />
  <!-- //font-awesome icons CSS-->
  <!-- side nav css file -->
  <link href="{{asset('public/backend/css/SidebarNav.min.css')}}" media="all" rel="stylesheet" type="text/css" />
  <meta name="csrf-token" content="{{csrf_token()}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  {{--
  <link rel="stylesheet" type="text/css" href="{{asset('public/backend/css/datatable.css')}}" /> --}}
  <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <!-- //side nav css file -->
  <!-- js-->

  <script src="{{asset('public/backend/js/modernizr.custom.js')}}"></script>
  <!--webfonts-->
  <link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext"
    rel="stylesheet" />
  <!--//webfonts-->
  <!-- chart -->
  <script src="{{asset('public/backend/js/Chart.js')}}"></script>
  <!-- //chart -->
  <!-- Metis Menu -->
  <script src="{{asset('public/backend/js/metisMenu.min.js')}}"></script>
  <script src="{{asset('public/backend/js/custom.js')}}"></script>
  <link href="{{asset('public/backend/css/custom.css')}}" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <!--//Metis Menu -->
  <style>
    #chartdiv {
      width: 100%;
      height: 295px;
    }
  </style>
  <!--pie-chart -->
  <!-- index page sales reviews visitors pie chart -->
  <script src="{{asset('public/backend/js/pie-chart.js')}}" type="text/javascript"></script>
  <script type="text/javascript">
    $(document).ready(function () {
        $('#demo-pie-1').pieChart({
          barColor: '#2dde98',
          trackColor: '#eee',
          lineCap: 'round',
          lineWidth: 8,
          onStep: function (from, to, percent) {
            $(this.element)
              .find('.pie-value')
              .text(Math.round(percent) + '%');
          },
        });

        $('#demo-pie-2').pieChart({
          barColor: '#8e43e7',
          trackColor: '#eee',
          lineCap: 'butt',
          lineWidth: 8,
          onStep: function (from, to, percent) {
            $(this.element)
              .find('.pie-value')
              .text(Math.round(percent) + '%');
          },
        });

        $('#demo-pie-3').pieChart({
          barColor: '#ffc168',
          trackColor: '#eee',
          lineCap: 'square',
          lineWidth: 8,
          onStep: function (from, to, percent) {
            $(this.element)
              .find('.pie-value')
              .text(Math.round(percent) + '%');
          },
        });
      });
  </script>
  <!-- //pie-chart -->
  <!-- index page sales reviews visitors pie chart -->
  <!-- requried-jsfiles-for owl -->
  <link href="{{asset('public/backend/css/owl.carousel.css')}}" rel="stylesheet" />
  <script src="{{asset('public/backend/js/owl.carousel.js')}}"></script>
  <script>
    $(document).ready(function () {
        $('#owl-demo').owlCarousel({
          items: 3,
          lazyLoad: true,
          autoPlay: true,
          pagination: true,
          nav: true,
        });
      });
  </script>
  <!-- //requried-jsfiles-for owl -->
</head>

<body class="cbp-spmenu-push">
  <div class="main-content">
    <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
      <!--left-fixed -navigation-->
      <aside class="sidebar-left">
        <nav class="navbar navbar-inverse">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse"
              aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <h1>
              <a class="navbar-brand" href="{{url('/dashboard')}}"><span class="fa fa-area-chart"></span> Laptop<span
                  class="dashboard_text">Admin Page</span></a>
            </h1>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="sidebar-menu">
              <li class="header">ĐIỀU HƯỚNG CHÍNH</li>
              <li class="treeview">
                <a href="{{url('/dashboard')}}">
                  <i class="fa fa-dashboard"></i> <span>Tổng quan</span>
                </a>
              </li>

              <li class="treeview ">
                <a href="{{URL::to('/manage-order')}}">
                  <i class="fa fa-files-o" ></i>
                  <span>Quản lý đơn hàng</span>
                </a>

              </li>
              <li class="treeview ">
                <a href="#">
                  <i class="fa fa-percent" aria-hidden="true"></i>
                  <span>Mã giảm giá</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{URL::to('/insert-coupon')}}"><i class="fa fa-angle-right"></i> Quản lý mã giảm giá</a>
                  </li>
                  <li>
                    <a href="{{URL::to('/list-coupon')}}"><i class="fa fa-angle-right"></i> Liệt kê mã giảm giá</a>
                  </li>
                </ul>
              </li>
              <li class="treeview ">
                <a href="{{URL::to('/delivery')}}">
                  <i class="fa fa-truck" aria-hidden="true"></i>
                  <span>Quản lý vận chuyển</span>

                </a>

              </li>
              <li class="header">Quản lý trang khách</li>
              <li class="treeview">
                <a href="{{url('/information')}}">
                  <i class="fa fa-info"></i> <span>Thông tin website</span>
                </a>
              </li>
              <li class="treeview ">
                <a href="#">
                  <i class="fa fa-laptop"></i>
                  <span>Thương hiệu sản phẩm</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{URL::to('/add-brand-product')}}"><i class="fa fa-angle-right"></i> Thêm thương hiệu
                      sản phẩm</a>
                  </li>
                  <li>
                    <a href="{{URL::to('/all-brand-product')}}"><i class="fa fa-angle-right"></i> Liệt kê thương hiệu
                      sản phẩm</a>
                  </li>
                </ul>
              </li>
              <li class="treeview ">
                <a href="#">
                  <i class="fa fa-laptop"></i>
                  <span>Danh mục sản phẩm</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{URL::to('/add-category-product')}}"><i class="fa fa-angle-right"></i> Thêm danh mục
                      sản phẩm</a>
                  </li>
                  <li>
                    <a href="{{URL::to('/all-category-product')}}"><i class="fa fa-angle-right"></i> Liệt kê danh mục
                      sản phẩm</a>
                  </li>
                </ul>
              </li>
              <li class="treeview ">
                <a href="#">
                  <i class="fa fa-laptop"></i>
                  <span>Sản phẩm</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{URL::to('/add-product')}}"><i class="fa fa-angle-right"></i> Thêm sản phẩm</a>
                  </li>
                  <li>
                    <a href="{{URL::to('/all-product')}}"><i class="fa fa-angle-right"></i> Liệt kê sản
                      phẩm</a>
                  </li>
                </ul>
              </li>
              <li class="treeview ">
                <a href="#">
                  <i class="fa fa-laptop"></i>
                  <span>Slider</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{URL::to('/manage-slider')}}"><i class="fa fa-angle-right"></i> Liệt kê
                      slider</a>
                  </li>
                  <li>
                    <a href="{{URL::to('/add-slider')}}"><i class="fa fa-angle-right"></i> Thêm slider</a>
                  </li>
                </ul>
              </li>




             

              @impersonate
              <li class="treeview ">
                <a href="{{URL::to('/impersonate-destroy')}}">
                  <i class="fa fa-laptop"></i>
                  <span>Stop chuyển quyền</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
              </li>
              @endimpersonate

              @hasrole(['admin','author'])
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-angle-right text-aqua"></i>
                  <span>Users</span>

                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{URL::to('/add-users')}}"><i class="fa fa-angle-right"></i> Thêm user</a>
                  </li>
                  <li>
                    <a href="{{URL::to('/users')}}"><i class="fa fa-angle-right"></i> Liệt kê user</a>
                  </li>
                </ul>
              </li>
              @endhasrole

              </li>
            </ul>
          </div>
          <!-- /.navbar-collapse -->
        </nav>
      </aside>
    </div>
    <!--left-fixed -navigation-->
    <!-- header-starts -->
    <div class="sticky-header header-section">
      <div class="header-left">
        <!--toggle button start-->
        <button id="showLeftPush"><i class="fa fa-bars"></i></button>
        <!--toggle button end-->


      </div>
      <div class="header-right">
        <!--search-box-->
        <div class="search-box">
          <form class="input">
            <input class="sb-search-input input__field--madoka" placeholder="Search..." type="search" id="input-31" />
            <label class="input__label" for="input-31">
              <svg class="graphic" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                <path d="m0,0l404,0l0,77l-404,0l0,-77z" />
              </svg>
            </label>
          </form>
        </div>
        <!--//end-search-box-->
        <div class="profile_details">
          <ul>
            <li class="dropdown profile_details_drop">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <div class="profile_img">
                  <span class="prfil-img"><img src="{{asset('public/backend/images/2.jpg')}}" alt="" />
                  </span>
                  <div class="user-name">
                    <p>
                      <?php
                      if(Session::get('login_normal')){
                        $name = Session::get('admin_name');

                      }else{
                        $name = Auth::user()->admin_name;
                      }
                      if($name){
                        echo $name;
                        
                      }
                      ?>
                    </p>
                    @hasrole(['admin'])
                    <span>
                      Admin</span>
                    @endhasrole
                    @hasrole(['author'])
                    <span>
                      Author</span>
                    @endhasrole
                    @hasrole(['user'])
                    <span>
                      User</span>
                    @endhasrole
                  </div>
                  <i class="fa fa-angle-down lnr"></i>
                  <i class="fa fa-angle-up lnr"></i>
                  <div class="clearfix"></div>
                </div>
              </a>
              <ul class="dropdown-menu drp-mnu">
               
                <li>
                  <a href="{{URL::to('/logout-auth')}}"><i class="fa fa-sign-out"></i> Đăng xuất</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="clearfix"></div>
    </div>
    <!-- //header-ends -->
    <!-- main content start-->
    <div id="page-wrapper">
      <div class="main-page">




        <!-- for amcharts js -->
        <script src="{{asset('public/backend/js/amcharts.js')}}"></script>
        <script src="{{asset('public/backend/js/serial.js')}}"></script>
        <script src="{{asset('public/backend/js/export.min.js')}}"></script>
        <link rel="stylesheet" href="{{asset('public/backend/css/export.css')}}" type="text/css" media="all" />
        <script src="{{asset('public/backend/js/light.js')}}"></script>
        <!-- for amcharts js -->
        <script src="{{asset('public/backend/js/index1.js')}}"></script>

        @yield('admin_content')
      </div>
    </div>
    <!--footer-->
    <div class="footer">
      <p>
        &copy; 2022 Dashboard
      </p>
    </div>
    <!--//footer-->
  </div>
  <!-- new added graphs chart js-->
  <script src="{{asset('public/backend/js/Chart.bundle.js')}}"></script>
  <script src="{{asset('public/backend/js/utils.js')}}"></script>

  <!-- new added graphs chart js-->
  <!-- Classie -->
  <!-- for toggle left push menu script -->
  <script src="{{asset('public/backend/js/classie.js')}}"></script>
  <script>
    var menuLeft = document.getElementById('cbp-spmenu-s1'),
        showLeftPush = document.getElementById('showLeftPush'),
        body = document.body;

      showLeftPush.onclick = function () {
        classie.toggle(this, 'active');
        classie.toggle(body, 'cbp-spmenu-push-toright');
        classie.toggle(menuLeft, 'cbp-spmenu-open');
        disableOther('showLeftPush');
      };

      function disableOther(button) {
        if (button !== 'showLeftPush') {
          classie.toggle(showLeftPush, 'disabled');
        }
      }
  </script>
  <!-- //Classie -->
  <!-- //for toggle left push menu script -->
  <!--scrolling js-->
  <script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
  <script src="{{asset('public/backend/js/scripts.js')}}"></script>
  <!--//scrolling js-->
  <!-- side nav js -->
  <script src="{{asset('public/backend/js/SidebarNav.min.js')}}" type="text/javascript"></script>
  <script>
    $('.sidebar-menu').SidebarNav();
  </script>
  <!-- //side nav js -->
  <!-- for index page weekly sales java script -->
  <script src="{{asset('public/backend/js/SimpleChart.js')}}"></script>
  <script src="{{asset('public/backend/js/simple.money.format.js')}}"></script>


  <!-- //for index page weekly sales java script -->
  <!-- Bootstrap Core JavaScript -->
  <script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
  <!-- //Bootstrap Core JavaScript -->


  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  {{-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> --}}

  <script type="text/javascript" src="{{asset('public/backend/js/datatables.js')}}"> </script>


  <script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>


  <script type="text/javascript">
    $('.price_format').simpleMoneyFormat();
  </script>


  <script type="text/javascript">
    $(function() {
        $( "#start_coupon" ).datepicker({
          prevText:"Tháng trước",
          nextText:"Tháng sau",
          dateFormat:"dd/mm/yy",
          monthNames:["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
          dayNamesMin:["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ nhật"],
          duration:"slow"
        });
        $( "#end_coupon" ).datepicker({
          prevText:"Tháng trước",
          nextText:"Tháng sau",
          dateFormat:"dd/mm/yy",
          monthNames:["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
          dayNamesMin:["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ nhật"],
          duration:"slow"
        });
      } );
  </script>
  <script>
    // Replace the <textarea id="editor1"> with a CKEditor instance, using default configuration.
  
    CKEDITOR.replace('ckeditor');
    CKEDITOR.replace('ckeditor1');
    CKEDITOR.replace('ckeditor2');
    CKEDITOR.replace('ckeditor3');
    CKEDITOR.replace('id4');
  </script>
  <script type="text/javascript">
    $(document).ready( function () {
  $('#myTable').DataTable();
} );
  </script>
  <script type="text/javascript">
    function ChangeToSlug()
    {
        var slug;
     
        //Lấy text từ thẻ input title 
        slug = document.getElementById("slug").value;
        slug = slug.toLowerCase();
        //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
        document.getElementById('convert_slug').value = slug;
    }
    
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
      load_gallery();

      function load_gallery(){
        var pro_id = $('.pro_id').val();
        var _token = $('input[name="_token"]').val();
        // alert(pro_id);
        $.ajax({
            url:"{{url('/select-gallery')}}",
            method:"POST",
            data:{pro_id:pro_id,_token:_token},
            success:function(data){
                $('#gallery_load').html(data);
            }
        });
        }

        $('#file').change(function(){
          var error = '';
          var files = $('#file')[0].files;
          if(files.length>5){
            error += '<p>Bạn chỉ chọn tối đa được 5 ảnh</p>';
          } else if(files.length == '') {
            error += '<p>Bạn không được bỏ trống ảnh</p>';
          } else if(files.size >2000000){

            error += '<p>File ảnh không được quá 2MB</p>';
          }

          if(error == ''){

          }
          else{
            $('#file').val('');
            $('#error_gallery').html('<span class="text-danger">'+error+'</span>');
            return false;
          }
        });


        $(document).on('blur','.edit_gal_name' ,function(){
            var gal_id = $(this).data('gal_id');
            var gal_text = $(this).text();
            var _token = $('input[name="_token"]').val();

            $.ajax({
            url:"{{url('/update-gallery-name')}}",
            method:"POST",
            data:{gal_id:gal_id,gal_text:gal_text,_token:_token},
            success:function(data){
                load_gallery();
                $('#error_gallery').html('<span class="text-danger">Cập nhật tên hình ảnh thành công</span>');
            }
        });
        });

        $(document).on('click','.delete-gallery' ,function(){
            var gal_id = $(this).data('gal_id');
            var _token = $('input[name="_token"]').val();
          if(confirm('Bạn muốn xóa hình ảnh này không?'))
          {
            $.ajax({
            url:"{{url('/delete-gallery')}}",
            method:"POST",
            data:{gal_id:gal_id,_token:_token},
            success:function(data){
                load_gallery();
                $('#error_gallery').html('<span class="text-danger">Xóa hình ảnh sản phẩm thành công</span>');
            }
        });
          };
        });
    
    
        $(document).on('change','.file_image' ,function(){
            var gal_id = $(this).data('gal_id');
            var image= document.getElementById('file-'+gal_id).files[0];
           
            var form_data = new FormData();

            form_data.append("file",document.getElementById('file-'+gal_id).files[0]);
            form_data.append("gal_id",gal_id);
        
            $.ajax({
            url:"{{url('/update-gallery')}}",
            method:"POST",
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
            data:form_data,
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
                load_gallery();
                $('#error_gallery').html('<span class="text-danger">Cập nhật hình ảnh thành công</span>');
            }
        });
      
      });


        
 });
  </script>
  <script type="text/javascript">
    $(document).ready(function(){

      
      // var colorDanger = "#FF1744";
      //       Morris.Donut({
      //       element: 'donut',
      //       resize: true,
      //       colors: [
      //           '#E0F7FA',
      //           '#B2EBF2',
      //           '#80DEEA',
      //           '#4DD0E1',
      //           '#26C6DA',
      //           '#00BCD4',
      //           '#00ACC1',
      //           '#0097A7',
      //           '#00838F',
      //           '#006064'
      //       ],
      //       //labelColor:"#cccccc", // text color
      //       //backgroundColor: '#333333', // border color
      //       data: [
      //           {label:"San pham", value:<?php echo $product ?>},
      //           //value test
      //           {label:"Bai viet", value:5},
      //           {label:"Video", value:6},
      //           //value test 
            
      //           {label:"Don hang", value:<?php echo $order ?>},
      //           {label:"Khach hang", value:<?php echo $customer ?>}
      //       ]
      //       });



      chart60daysorder();

      var chart = new Morris.Bar({
            // ID of the element in which to draw the chart.
            element: 'chart',
            //option 
            lineColors:['#819C79','#fc8710','#ff6541','#a4add3','#766856'],
            parseTime:false,
            hideHover:'auto',
            xkey: 'period',
            ykeys: ['order','sales','profit','quantity'],
            labels: ['đơn hàng','doanh số','lợi nhuận','số lượng']
        });

        function chart60daysorder(){
            var _token =$('input[name="_token"]').val();

            $.ajax({
                url: "{{url('/days-order')}}",
                method:'post',
                dataType:"JSON",
                data:{_token:_token},

                success:function(data){
                    chart.setData(data)
                }
            });
        }   

    $('.dashboard-filter').change(function(){
            var dashboard_value = $(this).val();
            var _token =$('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/dashboard-filter')}}",
                method:"POST",
                dataType:"JSON",
                data:{dashboard_value:dashboard_value,_token:_token},

                success:function(data){
                    chart.setData(data);
                    // chart.setData(JSON.parse(data));

                }
            });
        });

        
        $('#btn-dashboard-filter').click(function(){
        var _token =$('input[name="_token"]').val();

        var from_date= $('#datepicker').val();
        var to_date= $('#datepicker2').val();
      
        $.ajax({
            url:"{{url('filter-by-date')}}",
            method:"post",
            dateType:"JSON",
            data:{from_date:from_date,to_date:to_date,_token:_token},
            success:function(data){
                chart.setData(JSON.parse(data));
            }
        });
    });
    
  });

  </script>



  <script type="text/javascript">
    $(function() {
        $( "#datepicker" ).datepicker({
          prevText:"Tháng trước",
          nextText:"Tháng sau",
          dateFormat:"yy-mm-dd",
          monthNames:["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
          dayNamesMin:["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ nhật"],
          duration:"slow"
        });
        $( "#datepicker2" ).datepicker({
          prevText:"Tháng trước",
          nextText:"Tháng sau",
          dateFormat:"yy-mm-dd",
          monthNames:["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
          dayNamesMin:["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ nhật"],
          duration:"slow"
        });
      } );
  </script>



  <script type="text/javascript">
    $('.update_quantity_order').click(function(){
        var order_product_id = $(this).data('product_id');
        var order_qty = $('.order_qty_'+order_product_id).val();
        var order_code = $('.order_code').val();
        var _token = $('input[name="_token"]').val();
        // alert(order_product_id);
        // alert(order_qty);
        // alert(order_code);
        $.ajax({
                url : '{{url('/update-qty')}}',

                method: 'POST',

                data:{_token:_token, order_product_id:order_product_id ,order_qty:order_qty ,order_code:order_code},
                // dataType:"JSON",
                success:function(data){

                    alert('Cập nhật số lượng thành công');
                 
                   location.reload();
                    
              
                    

                }
        });

    });
  </script>
  <script type="text/javascript">
    $('.order_details').change(function(){
        var order_status = $(this).val();
        var order_id = $(this).children(":selected").attr("id");
        var _token = $('input[name="_token"]').val();

        //lay ra so luong
        quantity = [];
        $("input[name='product_sales_quantity']").each(function(){
            quantity.push($(this).val());
        });
        //lay ra product id
        order_product_id = [];
        $("input[name='order_product_id']").each(function(){
            order_product_id.push($(this).val());
        });
        j = 0;
        for(i=0;i<order_product_id.length;i++){
            //so luong khach dat
            var order_qty = $('.order_qty_' + order_product_id[i]).val();
            //so luong ton kho
            var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();

            if(parseInt(order_qty)>parseInt(order_qty_storage)){
                j = j + 1;
                if(j==1){
                    alert('Số lượng bán trong kho không đủ');
                }
                $('.color_qty_'+order_product_id[i]).css('background','#000');
            }
        }
        if(j==0){
          
                $.ajax({
                        url : '{{url('/update-order-qty')}}',
                            method: 'POST',
                            data:{_token:_token, order_status:order_status ,order_id:order_id ,quantity:quantity, order_product_id:order_product_id},
                            success:function(data){
                                alert('Thay đổi tình trạng đơn hàng thành công');
                                location.reload();
                            }
                });
            
        }

    });
 
  </script>
  // <script src="{{asset('public/backend/js/jquery.form-validator.min.js')}}">
    // 
  // 
  // 
  </script>
  // <script type="text/javascript">
    //   $.validate({
           
  //   });
  // 
  // 
  // 
  </script>
  <script type="text/javascript">
    $(document).ready(function(){

        fetch_delivery();

        function fetch_delivery(){
            var _token = $('input[name="_token"]').val();
             $.ajax({
                url : '{{url('/select-feeship')}}',
                method: 'POST',
                data:{_token:_token},
                success:function(data){
                   $('#load_delivery').html(data);
                }
            });
        }
        $(document).on('blur','.fee_feeship_edit',function(){

            var feeship_id = $(this).data('feeship_id');
            var fee_value = $(this).text();
             var _token = $('input[name="_token"]').val();
            // alert(feeship_id);
            // alert(fee_value);
            $.ajax({
                url : '{{url('/update-delivery')}}',
                method: 'POST',
                data:{feeship_id:feeship_id, fee_value:fee_value, _token:_token},
                success:function(data){
                   fetch_delivery();
                }
            });

        });
        $('.add_delivery').click(function(){

           var city = $('.city').val();
           var province = $('.province').val();
           var wards = $('.wards').val();
           var fee_ship = $('.fee_ship').val();
            var _token = $('input[name="_token"]').val();
           // alert(city);
           // alert(province);
           // alert(wards);
           // alert(fee_ship);
            $.ajax({
                url : '{{url('/insert-delivery')}}',
                method: 'POST',
                data:{city:city, province:province, _token:_token, wards:wards, fee_ship:fee_ship},
                success:function(data){
                   fetch_delivery();
                }
            });


        });
        $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            // alert(action);
            //  alert(matp);
            //   alert(_token);

            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url : '{{url('/select-delivery')}}',
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#'+result).html(data);     
                }
            });
        }); 
    })
  </script>
  <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
  {!! Toastr::message() !!}

</body>

</html>