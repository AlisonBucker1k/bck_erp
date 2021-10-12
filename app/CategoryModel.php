<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    //define table, primary and fillable field
	protected $table 		= 'category';
    protected $primarykey	='categoryid'; 
    protected $fillable		= ['name,description,type'];
}
