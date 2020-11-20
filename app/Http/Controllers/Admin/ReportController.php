<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\OrderDetails;
use App\InvoiceDetailsData;
use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function selling_report(){
        $data['orders'] = InvoiceDetailsData::all();
        
        $data['total_orders_delivered'] = DB::table('invoice_details_data')
                                            ->join('order_details', 'order_details.order_details_id', '=', 'invoice_details_data.order_details_id')
                                            ->where('order_details.order_delivery_status_id', 4)
                                            ->count();
        $data['total_orders_unassigned'] = DB::table('invoice_details_data')
                                            ->join('order_details', 'order_details.order_details_id', '=', 'invoice_details_data.order_details_id')
                                            ->where('order_details.order_delivery_status_id', 3)
                                            ->count();
        $data['earnings_delivered'] = DB::table('invoice_details_data')
                                            ->join('order_details', 'order_details.order_details_id', '=', 'invoice_details_data.order_details_id')
                                            ->join('order_master', 'order_master.order_id', '=', 'order_details.order_id')
                                            ->where('order_details.order_delivery_status_id', 4)
                                            ->pluck('order_master.final_paid_amount');
                                            // ->get();
                                            // ->toArray();

        $data['total_customers'] = DB::table('customer_master')->count();
        $data['total_earnings'] = array_sum($data['earnings_delivered']->toArray());
        // dd();
        return view('report.selling_report', $data ?? NULL);
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
