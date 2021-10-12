<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategoryModel extends Model
{
    //define table, primary and fillable field
	protected $table 		= 'subcategory';
    protected $primarykey	='subcategoryid'; 
    protected $fillable		= ['categoryid,name,description,type'];
}
