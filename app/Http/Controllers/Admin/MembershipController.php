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
        try {
            $members = Membership::where('isdelete', 0)->orderBy('created_date_time', 'desc')->get();
            return view('member.member')->with('members', $members);
        } catch (\Throwable $th) {
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('membership.create');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('member.memberCreate');
        } catch (\Throwable $th) {
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('membership.create');
        }  
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
                $user = user_logs('Membership', 'Insert', "Insert Membership - ". $request->initial_amount, 'membership', $member->membership_id);
                if($user){
                    flash()->success('Membership Created Successfully!');
                    return redirect()->route('membership.index');
                } 
            }
        } catch (\Throwable $th) {
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
            $member = Membership::findOrFail($membership->membership_id);
            return view('member.memberEdit')->with('member', $member);
        } catch (\Throwable $th) {
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
            $user = user_logs('Membership', 'Update', "Update Membership - ". $request->initial_amount, 'membership', $member->membership_id);
            if($user){
                flash()->success('Membership Updated Successfully!');
                return redirect()->route('membership.index');
            }
        }
        } catch (\Throwable $th) {
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
                $user = user_logs('Membership', 'Trash', "Trash Membership - ", 'membership', $member->membership_id);
                if($user){
                    flash()->info('Membership Deleted Successfully!');
                    return redirect()->route('membership.index');
                }
            }
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('membership.index');
        } catch (\Throwable $th) {
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('membership.index');
        }
    }
}
