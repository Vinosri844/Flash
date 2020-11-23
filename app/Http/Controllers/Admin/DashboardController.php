<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OrderDetails;
use App\InvoiceDetailsData;
use DB;
class DashboardController extends Controller
{


    public function index(Request $request, $year){
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
        $data['monthly_sales'] = [];
        for ($month = 1; $month < 13 ; $month++) { 
            $data['monthly'] = DB::table('invoice_details_data')
                                            ->join('order_details', 'order_details.order_details_id', '=', 'invoice_details_data.order_details_id')
                                            ->join('order_master', 'order_master.order_id', '=', 'order_details.order_id')
                                            ->where('order_details.order_delivery_status_id', 4)
                                            ->whereYear('order_details.create_date_time', $year)
                                            ->whereMonth('order_details.create_date_time', $month)
                                            ->pluck('order_master.final_paid_amount')->toArray();
                        array_push($data['monthly_sales'], array_sum($data['monthly']));
        }
        
                                            
        
        // dd($data['monthly_sales']);
        $data['total_customers'] = DB::table('customer_master')->count();
        $data['total_earnings'] = array_sum($data['earnings_delivered']->toArray());
        // dd($grandtotal);
        return view('dashboard.dashboard', $data ?? NULL);

    }
}
