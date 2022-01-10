<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
	use HasFactory;
	use HasRoles;
	protected $guarded=[
		'id','remember_token','created_at','updated_at'
	];
	public function getAuthPassword()
	{
		return $this->activation_code;
	}
}
