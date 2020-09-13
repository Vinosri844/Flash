<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\OrderDetails;
use App\InvoiceDetailsData;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function selling_report(){
        $orders = InvoiceDetailsData::all();
        return view('report.selling_report')->with('orders', $orders);
    }


    public function selling_invoice(){
        $orders = InvoiceDetailsData::all();
        return view('report.selling_invoice')->with('orders', $orders);
    }


    public function product_price(){
        $orders = InvoiceDetailsData::all();
        return view('report.product_price')->with('orders', $orders);
    }
}
