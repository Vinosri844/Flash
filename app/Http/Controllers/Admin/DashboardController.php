<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OrderDetails;
use App\InvoiceDetailsData;
class DashboardController extends Controller
{


    public function index(){
        $grandtotal = NULL;
        $data['delivered_orders'] = OrderDetails::where('order_delivery_status_id', 4)->count();
        $invoice_details = InvoiceDetailsData::where('order_delivery_status_id', 4)->get();
        foreach ($invoice_details as $invoice_detail){
            $invoice_detail->tamt = $invoice_detail->product_qty * $invoice_detail->product_price;
            $invoice_detail->total = $invoice_detail->product_qty * $invoice_detail->product_price + ROUND(
                (
                    ($invoice_detail->product_qty * $invoice_detail->product_price) * $invoice_detail->val_1 / 100),2
                ) + ROUND(
                    (
                        ($invoice_detail->product_qty * $invoice_detail->product_price) * $invoice_detail->val_2 / 100),2
                ) ;
            // $totalqty = $totalqty+$invoice_detail->product_qty;
            // $totalprz = $totalprz+$invoice_detail->tamt;
            $grandtotal += $grandtotal+$invoice_detail->total;
        }
        // dd($grandtotal);
        return view('dashboard.dashboard', $data ?? NULL);

    }
}
