<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CustomerController extends Controller
{
    //
    public function index(){
        $customer = new Customer();
        
        $data['customers'] = $customer->getCustomers();
        return view('customer.index', $data);
    }

    public function show(){
        $customer = new Customer();
        
        return response( $customer->getCustomers() );
    }

    public function insert(Request $request){
        $customer = new Customer();
        $this->validate($request, [
            'name'=>['string'],
            'street'=>['string'],
            'neighborhood'=>['string'],
            'city'=>['string'],
            'number'=>['numeric'],
            'details'=>['string'],
            'zipcode'=>['string'],
            'phone'=>['string'],
            'cpf'=>['string'],
            'email'=>['email']
        ]);

        $customer->insertCostumer($request->name, $request->street, $request->neighborhood, $request->city, $request->number, $request->details, $request->zipcode, $request->phone, $request->cpf, $request->email);

        return redirect()->back()->with('success', 'O cliente '.$request->name.' foi inserido!');
    }

    public function remove($id){
        $customer = new Customer();

        $customer->remove($id);
        return redirect()->back()->with('success', 'Removido');
    }

    public function edit($id){
        $customer = new Customer();
        $data = [
            'customerData' => $customer->get($id)
        ];

        return view('customer.edit', $data);
    }

    public function editAction(Request $request){
        $customer = new Customer();
        $this->validate($request, [
            'name'=>['string'],
            'street'=>['string'],
            'neighborhood'=>['string'],
            'city'=>['string'],
            'number'=>['numeric'],
            'details'=>['string'],
            'zipcode'=>['string'],
            'phone'=>['string'],
            'cpf'=>['string'],
            'email'=>['email'],
            'id'=>['numeric']
        ]);

        $customer = \App\Customer::find($request->id);

        $customer->name = $request->name;
        $customer->street = $request->street;
        $customer->neighborhood = $request->neighborhood;
        $customer->city = $request->city;
        $customer->number = $request->number;
        $customer->details = $request->details;
        $customer->zipcode = $request->zipcode;
        $customer->phone = $request->phone;
        $customer->cpf = $request->cpf;
        $customer->email = $request->email;
        $customer->save();
        
        return redirect()->back()->with('success', 'O cliente foi editado!');
    }

}
