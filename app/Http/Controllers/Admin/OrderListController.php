<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\InvoiceDetailsData;
use App\InvoiceMasterData;
use App\LogisticMaster;
use App\LogisticsOrderManagement;
use App\NotificationLogs;
use App\NotificationUsers;
use App\OrderDetails;
use App\TempOrderDetails;
use App\TempOrderMaster;
use App\UserLogs;
use Illuminate\Http\Request;
use App\Order;
use CommonLib, CommonHelper, Image, File, Carbon, DB, Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderListController extends Controller
{
    public function placed_orders()
    {
        $data['orders'] = Order::with('order_status','customer')->where('order_delivery_status_id',1)->orderby('order_id','desc')->get();
        $deliverypersons = LogisticMaster::where('isdelete', 0)->where('isactive',1)->orderBy('logistics_id', 'desc')->get();
        $deliveryboys = array();
        foreach ($deliverypersons as $deliveryperson){
            $person_data = array(
                'id' => $deliveryperson->logistics_id,
                'name' => $deliveryperson->logistics_name,
            );
            array_push($deliveryboys,$person_data);
        }
        $data['deliveryboys'] = $deliveryboys;
        $data['status'] = "Assign Order";
        $data['status_id'] = 2;
        $data['title'] = '';
        return view('order.plased_orders',$data);
    }
    public function assign_orders()
    {
        $orders = Order::with('order_status','delivery_orders')->where('order_delivery_status_id',2)->orderby('order_id','desc')->get();
        foreach ($orders as $order){
            $deliverboy = LogisticMaster::find($order->delivery_orders->assign_to_user_id);
            $order->delivery_person = $deliverboy->logistics_name;
        }
        $data['orders'] = $orders;
        $data['status'] = "Pickup Done";
        $data['status_id'] = 3;
        $data['title'] = 'Are you sure you want to change status of this record?';
        return view('order.assign_orders',$data);
    }
    public function progress_orders()
    {
        $orders = Order::with('order_status','delivery_orders')->where('order_delivery_status_id',3)->orderby('order_id','desc')->get();
        foreach ($orders as $order){
            $deliverboy = LogisticMaster::find($order->delivery_orders->assign_to_user_id);
            $order->delivery_person = $deliverboy->logistics_name;
        }
        $data['orders'] = $orders;
        $data['status'] = "Order Delivered";
        $data['status_id'] = 4;
        $data['title'] = 'Are you sure you want to change status of this record?';
        return view('order.pickup_orders',$data);
    }
    public function delivered_orders()
    {
        $orders = Order::with('order_status','delivery_orders')->where('order_delivery_status_id',4)->orderby('order_id','desc')->get();
        foreach ($orders as $order){
            $deliverboy = LogisticMaster::find($order->delivery_orders->assign_to_user_id);
            $order->delivery_person = $deliverboy->logistics_name;
        }
        $data['orders'] = $orders;
        return view('order.deliver_orders',$data);
    }
    public function cancel_orders()
    {
        $orders = Order::with('order_status','delivery_orders')->where('order_delivery_status_id',6)->orderby('order_id','desc')->get();
        $data['orders'] = $orders;
        return view('order.cancel_orders',$data);
     }


     public function assign_order(Request $request){
        try{
            if($request->isMethod('post')) {

                $user = Auth::user();
                $current_date = date('Y-m-d H:i:s');

              //  dd($request->input());
                DB::beginTransaction();
                $order = Order::with('order_status')->find($request->order_id);
                $order->order_delivery_status_id = 2;
                $order->save();
                //dd($order);
                $logistic_order = new LogisticsOrderManagement();
                $logistic_order->order_id =$order->order_id;
                $logistic_order->assign_by_user_id = isset($user->user_id) ? $user->user_id : 1;
                $logistic_order->assign_to_user_id = $request->dperson_id;
                $logistic_order->save();

                $title ="Order assignment";
                $message ="You have received a new Order ".$order->order_number." and it should be  delivered on".$order->delivery_date." between ".$order->delivery_time_slot;
                $type="5";

                $json_datas= array(
                    "order_id" => isset($user->user_id) ? $user->user_id : 1
                );
                $notificationuser = NotificationUsers::find($request->dperson_id);
                $notificationlog = new NotificationLogs();
                $notificationlog->notification_user_id = $notificationuser->notification_user_id;
                $notificationlog->customer_id = $notificationuser->customer_id;
                $notificationlog->message = $message;
                $notificationlog->title = $title;
                $notificationlog->user_type_id = 1;
                $notificationlog->isactive = 1;
                $notificationlog->save();

                $fields = array(
                    'registration_ids' => array($notificationuser->customer_device_token),
                    'priority'         => "High",
                    'sound'            => "default",
                    'data'             => array(
                        "title" => $request->title,
                        "message" => $request->message,
                        "detail" => $request->message,
                        "body" => $request->message,
                        "android_channel_id" => "flash",
                        "type"=> 'ORDER',
                        "json_data"=>$json_datas
                    ),
                    'notification'          => array(
                        "title" => $request->title,
                        "message" => $request->message,
                        "detail" => $request->message,
                        "body" => $request->message,
                        "android_channel_id" => "flash",
                        "type"=> 'ORDER',
                         "json_data"=>$json_datas
                    )
                );
                $check = \App\Library\CommonLib::send_new_fcm($fields);

                $userlog_description="Insert Order Assign ";
                $userlog = new Userlogs();
                $userlog->form_name = 'Order Assign';
                $userlog->operation_type = 'insert';
                $userlog->user_id = isset($user->user_id) ? $user->user_id : 1;
                $userlog->log_date_time = $current_date;
                $userlog->description = $userlog_description;
                $userlog->OS = $request->os ? $request->os : "windows";
                $userlog->table_name = 'product_master';
                $userlog->reference_id = $order->order_id;
                $userlog->ip_device_id = $request->getHost();
                $userlog->user_type_id = 4;
                $userlog->save();

                $temporder = new TempOrderMaster();
                $temporder->order_id = $order->order_id;
                $temporder->customer_id = $order->customer_id;
                $temporder->payment_type_method = $order->payment_type_method;
                $temporder->payable_amount = $order->payable_amount;
                $temporder->no_of_product = $order->no_of_product;
                $temporder->customer_address_id = $order->customer_address_id;
                $temporder->promocode = $order->promocode;
                $temporder->before_promocode_amount = $order->before_promocode_amount;
                $temporder->after_promocode_amount = $order->after_promocode_amount;
                $temporder->delivery_charge = $order->delivery_charge;
                $temporder->order_date_time = $order->order_date_time;
                $temporder->order_delivery_status_id = $order->order_delivery_status_id;
                $temporder->generate_order_id = $order->generate_order_id;
                $temporder->order_number = $order->order_number;
                $temporder->o_number = $order->o_number;
                $temporder->os = $order->os;
                $temporder->isordercancel = $order->isordercancel;
                $temporder->cancel_date_time = $order->cancel_date_time;
                $temporder->cancel_reason = $order->cancel_reason;
                $temporder->cancel_by_user_id = $order->cancel_by_user_id;
                $temporder->cancel_by_user_type_id = $order->cancel_by_user_type_id;
                $temporder->reveiver_name = $order->reveiver_name;
                $temporder->received_amount = $order->received_amount;
                $temporder->receiver_sign = $order->receiver_sign;
                $temporder->received_date_time = $order->received_date_time;
                $temporder->save();
                $orderdetails = OrderDetails::where('order_id',$order->order_id)->get();
                foreach ($orderdetails as $orderdetail){
                    $orderdetail->order_delivery_status_id =2;
                    $orderdetail->save();
//                    $properties = array_pluck($orderdetail->attributesToArray(), [`order_details_id`, `sub_order_id`, `sub_order_number`,
//                        `order_id`, `product_weight_details_id`, `quantity`, `shopping_cart_id`, `create_date_time`, `update_date_time`,
//                        `order_delivery_status_id`, `isdelete`, `isordercancel`,`cancel_by_user_id`,`cancel_by_user_type_id`,
//                        `cancel_date_time`, `cancel_reason`, `return_date_time`, `no_item_return`, `return_reason`,
//                        `return_by_user_id`,`return_by_user_type_id`]);
//                    $temporderdetails->fill($properties);

                    $temporderdetails = new TempOrderDetails();
                    $temporderdetails->order_details_id = $orderdetail->order_details_id;
                    $temporderdetails->sub_order_id = $orderdetail->sub_order_id;
                    $temporderdetails->sub_order_number = $orderdetail->sub_order_number;
                    $temporderdetails->order_id = $orderdetail->order_id;
                    $temporderdetails->product_weight_details_id = $orderdetail->product_weight_details_id;
                    $temporderdetails->quantity = $orderdetail->quantity;
                    $temporderdetails->order_delivery_status_id = $orderdetail->order_delivery_status_id;
                    $temporderdetails->isdelete = $orderdetail->isdelete;
                    $temporderdetails->isordercancel = $orderdetail->isordercancel;
                    $temporderdetails->cancel_by_user_id = $orderdetail->cancel_by_user_id;
                    $temporderdetails->cancel_by_user_type_id = $orderdetail->cancel_by_user_type_id;
                    $temporderdetails->cancel_date_time = $orderdetail->cancel_date_time;
                    $temporderdetails->cancel_reason = $orderdetail->cancel_reason;
                    $temporderdetails->return_date_time = $orderdetail->return_date_time;
                    $temporderdetails->no_item_return = $orderdetail->no_item_return;
                    $temporderdetails->return_reason = $orderdetail->return_reason;
                    $temporderdetails->return_by_user_id = $orderdetail->return_by_user_id;
                    $temporderdetails->return_by_user_type_id = $orderdetail->return_by_user_type_id;
                    $temporderdetails->save();
                }

                $invoicemaster = InvoiceMasterData::where('order_id',$order->order_id)->first();
                $invoicemaster->order_delivery_status_id = 2;
                $invoicemaster->save();
                $invoicedetails = InvoiceDetailsData::where('invoice_master_id')->get();

                foreach ($invoicedetails as $invoicedetail){
                    $invoicedetail->order_delivery_status_id = 2;
                    $invoicedetail->order_delivery_status_name = $order->order_status->order_delivery_status_name;
                    $invoicedetail->save();
                }
                 DB::commit();
                Session::flash('message', 'Order Status Updated!');
                return redirect()->route('placed_orders');
            }
        }catch (\Exception $e){
           // dd($e);
            DB::rollback();
            return redirect()->route('placed_orders')->with('error', $e->getMessage());
        }
     }


     public function update_status(Request $request){
           try{
               if($request->isMethod('post')){
                   $user = Auth::user();
                   $current_date = date('Y-m-d H:i:s');

                   //  dd($request->input());
                   DB::beginTransaction();
                   $order = Order::with('order_status')->find($request->order_id);
                   $order->order_delivery_status_id = $request->status;
                   $order->save();

                   $orderdetails = OrderDetails::where('order_id',$order->order_id)->get();
                   foreach ($orderdetails as $orderdetail) {
                       $orderdetail->order_delivery_status_id = $request->status;
                       $orderdetail->save();
                   }

                   $invoicemaster = InvoiceMasterData::where('order_id',$order->order_id)->first();
                   $invoicemaster->order_delivery_status_id = $request->status;
                   $invoicemaster->save();
                   $invoicedetails = InvoiceDetailsData::where('invoice_master_id')->get();

                   foreach ($invoicedetails as $invoicedetail){
                       $invoicedetail->order_delivery_status_id = $request->status;
                       $invoicedetail->order_delivery_status_name = $order->order_status->order_delivery_status_name;
                       $invoicedetail->save();
                   }
                   DB::commit();
                  if($request->status == 3){
                      Session::flash('message', 'Order Status Updated!');
                      return redirect()->route('assign_orders');
                  }elseif ($request->status == 4){
                      Session::flash('message', 'Order Status Updated!');
                      return redirect()->route('pickup_orders');
                  }else{
                      Session::flash('message', 'Order Status Updated!');
                      return redirect()->route('placed_orders');
                  }

               }
           }catch(\Exception $e){
              // dd($e);
               DB::rollback();
               return redirect()->route('assign_orders')->with('error', $e->getMessage());
           }
     }
}
