<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DeliverySlotMaster;
use App\Userlogs;
use Validator;

class DeliverySlotMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $delivery_slot = DeliverySlotMaster::where('isdelete', 0)->orderBy('delivery_slot_id', 'desc')->get();      
            return view('master.DeliverySlotMaster')->with('masters', $delivery_slot);
        } catch (\Throwable $th) {
            flash()->error('Something Went wrong Please try Again!');
            return redirect()->route('delivery-slot-master.index');
        }
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
        try {
            $validator = Validator::make($request->all(), [
                'deliverySlotFrom' => 'required',
                'deliverySlotTo' => 'required'
            ]);
            if($validator->fails()){
                flash()->error('Please fill the required fields');
                return redirect()->route('delivery-slot-master.index');
            }

            $active = 0;
      
            if($request->deliverySlotStatus != null){
                $active = 1;
            }
            // dd('ok');
            $delivery_slot = new DeliverySlotMaster;
            $delivery_slot->from_time = $request->deliverySlotFrom;
            $delivery_slot->to_time = $request->deliverySlotTo;
            $delivery_slot->isActive = $active;
            $delivery_slot->user_id = 1;
            if($delivery_slot->save()){
                $user = user_logs('Delivery Slot', 'Insert', "Insert delivery Slot - ". $request->deliverySlotFrom. " to ". $request->deliverySlotTo, 'delivery_slot_master', $delivery_slot->delivery_slot_id);
                if($user){
                    flash()->success('Delivery Slot Created Successfully!');
                    return redirect()->route('delivery-slot-master.index');
                }
            }
            flash()->error('Please Try Again!');
            return redirect()->route('delivery-slot-master.index');

        } catch (\Throwable $th) {
            flash()->error('Something Went wrong Please try Again!');
            return redirect()->route('delivery-slot-master.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
            'deliverySlotFromEdit' => 'required' ,
            'deliverySlotToEdit' => 'required' 
        ]);
        if($validator->fails()){
            flash()->error('Please fill the required fields');
            return redirect()->route('delivery-slot-master.index');
        }
        $active = 0;
        // dd($request->event_status);
        if($request->deliverySlotStatusEdit != null){
            $active = 1;
        }
        $delivery_slot = DeliverySlotMaster::findOrFail($id);
        $delivery_slot->from_time = $request->deliverySlotFromEdit;
        $delivery_slot->to_time = $request->deliverySlotToEdit;
        $delivery_slot->isActive = $active;
        if($delivery_slot->save()){
            $user = user_logs('Delivery Slot', 'Update', "Update delivery Slot - ". $request->deliverySlotFrom. " to ". $request->deliverySlotTo, 'delivery_slot_master', $delivery_slot->delivery_slot_id);
                if($user){
                    flash()->success('Delivery Slot Updated Successfully!');
                    return redirect()->route('delivery-slot-master.index');
                }
        }
            flash()->error('Please Try Again!');
            return redirect()->route('delivery-slot-master.index');
        } catch (\Throwable $th) {
            flash()->error('Something Went wrong Please try Again!');
            return redirect()->route('delivery-slot-master.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $delivery_slot = DeliverySlotMaster::findOrFail($id);
            $delivery_slot->isdelete = 1;
            if($delivery_slot->save()){
                $user = user_logs('Delivery Slot', 'Trash', "Delete delivery Slot - ". $delivery_slot->from_time. " to ". $delivery_slot->to_time, 'delivery_slot_master', $delivery_slot->delivery_slot_id);
                if($user){
                    flash()->info('Delivery Slot Deleted Successfully!');
                    return redirect()->route('delivery-slot-master.index');
                } 
            }
            flash()->error('Please Try Again!');
            return redirect()->route('delivery-slot-master.index');
        } catch (\Throwable $th) {
            flash()->error('Something Went wrong Please try Again!');
            return redirect()->route('delivery-slot-master.index');
        }
    }
}
