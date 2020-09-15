<?php

namespace App\Http\Controllers\Admin;

use App\DeliveryChargeMaster;
use App\Http\Controllers\Controller;
use App\SmsTemplate;
use CommonLib, CommonHelper, Image, File, Carbon, DB, Validator;

use Illuminate\Http\Request;

class DeliveryChargeMasterController extends Controller
{
    public function index()
    {
        $deliverycharges = DeliveryChargeMaster::orderby('delivery_charge_id','desc')->get();
        return view('deliverycharge.deliverycharges')->with('deliverycharges', $deliverycharges);
    }

    public function deliverycharge_create(Request $request){
        try{
            if($request->isMethod('post')){
                DB::beginTransaction();
                $deliverycharge = new DeliveryChargeMaster();
                $deliverycharge->start_amount = $request->start_amount;
                $deliverycharge->end_amount = $request->end_amount;
                $deliverycharge->delivery_charge = $request->delivery_charge;
                $deliverycharge->save();
                DB::commit();
                flash()->success('Delivery Charge Created Successfully!');
                return redirect()->route('deliverycharges');
            }else{
                return view('deliverycharge.deliverycharge_create');
            }
        }catch(\Exception $exception){
            // dd($exception);
            DB::rollback();
            return redirect()->route('deliverycharges')->with('error', $exception->getMessage());
        }
    }


    public function deliverycharge_edit(Request $request, $id){
        try{
            if($request->isMethod('post')){
                DB::beginTransaction();
                $deliverycharge = DeliveryChargeMaster::find($id);
                $deliverycharge->start_amount = $request->start_amount;
                $deliverycharge->end_amount = $request->end_amount;
                $deliverycharge->delivery_charge = $request->delivery_charge;
                $deliverycharge->save();

                DB::commit();
                flash()->success('Delivery Charge Updated Successfully!');
                return redirect()->route('deliverycharges');
            }else{
                $data['deliverycharge'] = DeliveryChargeMaster::find($id);
                return view('deliverycharge.deliverycharge_edit', $data ?? NULL);
            }
        }catch(\Exception $exception){
            // dd($exception);
            DB::rollback();
            return redirect()->route('deliverycharges')->with('error', $exception->getMessage());
        }
    }

    public function deliverycharge_delete($id)
    {
        $data = DeliveryChargeMaster::find($id);
        // $data->isdelete = 1;
        if($data->delete()){
            flash()->success('Delivery Charge Successfully!');
            return redirect()->route('deliverycharges');
        }else{
            flash()->error('Please Try Again!');
            return redirect()->route('deliverycharges');
        }


    }
}
