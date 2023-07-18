<?php

use App\Admin_role;

if (!function_exists('aFunctionName')) {
    function checkAdminPermission($admin_id)
    {
        $admin = Admin_role::query()->select(['roles_id_roles'])->where('admin_admin_id', $admin_id)->first();
        if ($admin->roles_id_roles == 1) {
            return true;
        }
        else {
            return false;
        }
    }
}
