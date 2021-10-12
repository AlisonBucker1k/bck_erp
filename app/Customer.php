<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primarykey = 'id';
    protected $fillable = ['name'];

    public function insertCostumer($name, $street, $neighborhood, $city, $number, $details, $zipcode, $phone, $cpf, $email)
    { 
        $this->name = $name;
        $this->street = $street;
        $this->neighborhood = $neighborhood;
        $this->city = $city;
        $this->number = $number;
        $this->details = $details;
        $this->zipcode = $zipcode;
        $this->phone = $phone;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->save();
    }

    public function remove($id)
    {
        DB::table('customers')->where('id', '=', $id)->delete();
        return true;
    }

    public function updateThis($name, $street, $neighborhood, $city, $number, $details, $zipcode, $phone, $cpf, $email, $id)
    {
        $this->find($id);
        $this->name = $name;
        $this->street = $street;
        $this->neighborhood = $neighborhood;
        $this->city = $city;
        $this->number = $number;
        $this->details = $details;
        $this->zipcode = $zipcode;
        $this->phone = $phone;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->save();
    }

    public function get($id){
        return $this->find($id);
    }

    public function getCustomers()
    {
        return $this::all();
    }
}
