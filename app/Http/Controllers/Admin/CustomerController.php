<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Order;
use App\CustomerAddress;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::where('isdelete', 0)->orderBy('customer_id', 'desc')->get();
        return view('customer.customer')->with('customers', $customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        try {
        
        $customer = Customer::findOrFail($customer->customer_id);
        return view('customer.customer_edit')->with('customer', $customer);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        dd(date('Y-m-d', strtotime($request->customer_anniversary_date)), $request->customer_anniversary_date);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CustomerAddress  $address
     * @return \Illuminate\Http\Response
     */
     public function address(Request $request, $address)
    {

       try {
        
        $addresses = CustomerAddress::where('customer_id', $address)->get();
        $customer = Customer::where('customer_id', $address)->first();
        // dd($customer);
        return view('address.customerAddress')->with(['address' => $addresses, 'customer' => $customer]);
       } catch (\Throwable $th) {
           dd($th);
       }
    }


     public function order(Request $request, $order)
    {

       try {
        
        $orders = Order::where('customer_id', $order)->get();
        $customer = Customer::where('customer_id', $order)->first();
        // dd($customer);
        return view('order.customerOrder')->with(['orders' => $orders, 'customer' => $customer]);
       } catch (\Throwable $th) {
           dd($th);
       }
    }
}
