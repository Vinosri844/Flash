<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EventMaster;
use App\Userlogs;
use Validator;
class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masters = EventMaster::where('isdelete', 0)->orderBy('event_id', 'desc')->get();
        
        return view('master.EventMaster')->with('masters', $masters);
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
            'event_name' => 'required' 
        ]);
        if($validator->fails()){
            flash()->error('Please fill the required fields');
            return redirect()->route('event-master.index');
        }
        $active = 0;
        if($request->event_status != null){
            $active = 1;
        }
        $event = new EventMaster;
        $event->isActive = $active;
        $event->user_id = 1;
        $event->event_name = $request->event_name;
        if($event->save()){
            $user = new Userlogs;
            $user->form_name = 'Event';
            $user->operation_type = 'Insert';
            $user->user_id = 1;
            $user->description = "Insert Event Name - ". $request->event_name;
            $user->OS = 'WEB';
            $user->table_name = 'event_master';
            $user->reference_id = $event->event_id;
            $user->ip_device_id = "000:00:00";
            $user->user_type_id = 1;
            $user->save();
            flash()->success('Event Created Successfully!');
            return redirect()->route('event-master.index');
        }
        flash()->error('Please Try Again!');
        return redirect()->route('event-master.index');
        } catch (\Throwable $th) {
            flash()->error('Something Went wrong Please try Again!');
            return redirect()->route('event-master.index');
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
            'event_name' => 'required' 
        ]);
        if($validator->fails()){
            flash()->error('Please fill the required fields');
            return redirect()->route('event-master.index');
        }
        $active = 0;
        // dd($request->event_status);
        if($request->event_status != null){
            $active = 1;
        }
        $event = EventMaster::findOrFail($id);
        $event->event_name = $request->event_name;
        $event->isActive = $active;
        if($event->save()){
            $user = new Userlogs;
            $user->form_name = 'Event';
            $user->operation_type = 'Update';
            $user->user_id = 1;
            $user->description = "Update Event Name - ". $request->event_name;
            $user->OS = 'WEB';
            $user->table_name = 'event_master';
            $user->reference_id = $event->event_id;
            $user->ip_device_id = "000:00:00";
            $user->user_type_id = 1;
            $user->save();
            flash()->success('Event Updated Successfully!');
            return redirect()->route('event-master.index');
            
        }
            flash()->error('Please Try Again!');
            return redirect()->route('event-master.index');
        } catch (\Throwable $th) {
            flash()->error('Something Went wrong Please try Again!');
            return redirect()->route('event-master.index');
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
            $event = EventMaster::findOrFail($id);
            $event->isdelete = 1;
            if($event->save()){
                $user = new Userlogs;
                $user->form_name = 'Event';
                $user->operation_type = 'Trash';
                $user->user_id = 1;
                $user->description = "Delete Event Name - ". $event->event_name;
                $user->OS = 'WEB';
                $user->table_name = 'event_master';
                $user->reference_id = $event->event_id;
                $user->ip_device_id = "000:00:00";
                $user->user_type_id = 1;
                $user->save();
                flash('Event Deleted Successfully!');
                return redirect()->route('event-master.index');
            }
            flash()->error('Please Try Again!');
            return redirect()->route('event-master.index');
        } catch (\Throwable $th) {
            flash()->error('Something Went wrong Please try Again!');
            return redirect()->route('event-master.index');
        }
    }
}
