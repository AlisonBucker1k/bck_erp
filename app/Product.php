<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primarykey = 'id';
    protected $fillable = ['name'];

    public function insertProduct($name, $ref, $qt, $buyPrice, $sellPrice)
    {
        $this->name = $name;
        $this->ref = $ref;
        $this->quantity = $qt;
        $this->buy_price = $buyPrice;
        $this->sell_price = $sellPrice;
        $this->save();
    }

    public function updateThis($name, $ref, $qt, $buyPrice, $sellPrice, $id)
    {
        $this->find($id);
        $this->name = $name;
        $this->ref = $ref;
        $this->quantity = $qt;
        $this->buy_price = $buyPrice;
        $this->sell_price = $sellPrice;
        $this->save();
    }

    public function remove($id)
    {
        DB::table('products')->where('id', '=', $id)->delete();
        return true;
    }

    public function get($id){
        return $this->find($id);
    }

    public function getProducts(){
        return $this::all();
    }
}
