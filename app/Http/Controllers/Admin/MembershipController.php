<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Membership;
use App\Userlogs;
use Illuminate\Http\Request;
use Validator;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Membership::where('isdelete', 0)->orderBy('created_date_time', 'desc')->get();
        return view('member.member')->with('members', $members);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member.memberCreate');
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
            'initial_amount' => 'required',
            'current_amount' => 'required',
            'validity' => 'required'
        ]);
        if($validator->fails()){
            flash()->error('Please fill the required Fields!');
            return redirect()->route('membership.create');
        }
        $active = 0;
        if($request->isActive != null){
            $active = 1;
        }
        $request->merge(['isActive' => $active]);
        $member = Membership::create($request->all());
        if($member){
            $user = new Userlogs;
            $user->form_name = 'Membership';
            $user->operation_type = 'Insert';
            $user->user_id = 1;
            $user->description = "Insert Membership - ". $request->initial_amount;
            $user->OS = 'WEB';
            $user->table_name = 'membership';
            $user->reference_id = $member->membership_id;
            $user->ip_device_id = "000:00:00";
            $user->user_type_id = 1;
            $user->save();
            flash()->success('Membership Created Successfully!');
            return redirect()->route('membership.index');
        }
        } catch (\Throwable $th) {
            // dd($th);
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('membership.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function show(Membership $membership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function edit(Membership $membership)
    {
        try {
            // dd($membership);
            $member = Membership::findOrFail($membership->membership_id);
            // dd($member);
            return view('member.memberEdit')->with('member', $member);
        } catch (\Throwable $th) {
            // dd($th);
            flash()->error('Membership Not Available');
            return redirect()->route('membership.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Membership $membership)
    {
        try {
            
            $validator = Validator::make($request->all(), [
            'initial_amount' => 'required',
            'current_amount' => 'required',
            'validity' => 'required'
        ]);
        if($validator->fails()){
            flash()->error('Please fill the required Fields!');
            return redirect()->route('membership.create');
        }
        $active = 0;
        if($request->isActive != null){
            $active = 1;
        }
        $request->merge(['isActive' => $active]);
        $member = Membership::findOrFail($membership->membership_id);
        $member->update($request->all());
        if($member){
            user_logs('Membership', 'Update', "Update Membership - ". $request->initial_amount, 'membership', $member->membership_id);
            flash()->success('Membership Updated Successfully!');
            return redirect()->route('membership.index');
        }
        } catch (\Throwable $th) {
            // dd($th);
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('membership.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membership $membership)
    {
        try {
            $member = Membership::findOrFail($membership->membership_id);
            $member->isdelete = 1;
            if($member->save()){
                $user = new Userlogs;
                $user->form_name = 'Membership';
                $user->operation_type = 'Trash';
                $user->user_id = 1;
                $user->description = "Trash Membership - ";
                $user->OS = 'WEB';
                $user->table_name = 'membership';
                $user->reference_id = $member->membership_id;
                $user->ip_device_id = "000:00:00";
                $user->user_type_id = 1;
                $user->save();
                flash()->info('Membership Deleted Successfully!');
                return redirect()->route('membership.index');
            }
        } catch (\Throwable $th) {
            //throw $th;
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('membership.index');
        }
    }
}
