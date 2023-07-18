<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin_role extends Authenticatable
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'id_admin_roles', 'admin_admin_id', 'roles_id_roles'
    ];
    protected $primaryKey = 'id_admin_roles';
 	protected $table = 'admin_roles';
 	
}