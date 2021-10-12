<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = new Product();

        $data = [
            'products' => $products->getProducts()
        ];

        return view('product.index', $data);
    }

    public function insert(Request $request)
    {
        $products = new Product();
        $this->validate($request, [
            'name'=>['string'],
            'ref'=>['string'],
            'qt'=>['numeric'],
            'buyPrice'=>['numeric'],
            'sellPrice'=>['numeric']
        ]);

        $products->insertProduct($request->name, $request->ref, $request->qt, $request->buyPrice, $request->sellPrice);

        return redirect()->back()->with('success', 'O produto '.$request->name.' foi inserido!');
    }

    public function remove($id){
        $products = new Product();

        $products->remove($id);
        return redirect()->back()->with('success', 'Removido');
    }

    public function edit($id){
        $products = new Product();
        $data = [
            'productData' => $products->get($id)
        ];

        return view('product.edit', $data);
    }

    public function editAction(Request $request){
        $this->validate($request, [
            'name'=>['string'],
            'ref'=>['string'],
            'qt'=>['integer'],
            'buyPrice'=>['numeric'],
            'sellPrice'=>['numeric']
        ]);

        $products = \App\Product::find($request->id);

        $products->name = $request->name;
        $products->ref = $request->ref;
        $products->quantity = $request->qt;
        $products->buy_price = $request->buyPrice;
        $products->sell_price = $request->sellPrice;
        $products->save();
        
        return redirect()->back()->with('success', 'O Produto foi editado!');
    }
}
