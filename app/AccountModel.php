<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountModel extends Model
{
	//define table, primary and fillable field
	protected $table   		= 'account';
	protected $primarykey 	='accountid';
	protected $fillable  	= ['name,balance,description'];

}
