<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;


	protected $table = 'users';


	protected $primaryKey = 'userid';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
	'name', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
	'password', 'remember_token',
	];


	public function roles() {
		$userid = $this->userid;

		$role = Role::where( 'userid', $userid )->get();
		foreach ( $role as $user ) {
			echo $user->userid;
		}
	}

	public function isrole( $roleid ) {
		$userid = $this->userid;
		//$checkrole ='';
		$roles = Role::where( 'userid', $userid )->get();
		foreach ( $roles as $role ) {
			$checkrole =  $role->roleid;
			if ( $roleid == $checkrole ) {
				return true;
			}
		}
		return false;
	}
}
