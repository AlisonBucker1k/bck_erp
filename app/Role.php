<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	//define table, primary and fillable field
	protected $table   		= 'roleaccess';
	protected $primarykey 	= 'roleaccessid';
	protected $fillable  	= ['roleid,userid'];



}
