<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoalModel extends Model
{
    //define table, primary and fillable field
	protected $table 		= 'goals';
    protected $primarykey	='goalsid'; 
    protected $fillable		= ['name,userid,accountid,balance,amount,deposit'];
}
