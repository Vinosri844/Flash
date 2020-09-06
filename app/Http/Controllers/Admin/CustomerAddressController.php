<?php

namespace App\Http\Controllers\Admin;

use App\CustomerAddress;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       dd('Okay');
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
     * @param  \App\CustomerAddress  $customerAddress
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerAddress $customerAddress)
    {
        dd($customerAddress);
        $address = CustomerAddress::where('customer_id', $customerAddress->customer_id)->orderBy('create_date_time', 'desc')->get();
        return view('address.customerAddress')->with('address', $address);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CustomerAddress  $customerAddress
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerAddress $customerAddress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CustomerAddress  $customerAddress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerAddress $customerAddress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CustomerAddress  $customerAddress
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerAddress $customerAddress)
    {
        //
    }
}
