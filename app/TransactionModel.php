<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionModel extends Model
{
    //define table, primary and fillable field
	protected $table 		= 'transaction';
    protected $primarykey	='transactionid'; 
    protected $fillable		= ['categoryid,accountid,name,transactiondate,reference,type,description,file'];
}
