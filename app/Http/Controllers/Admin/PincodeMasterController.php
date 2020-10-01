<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PincodeMaster;
use App\WeightMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PaymentTypeMaster;
use App\Category;
use App\Slider;
use CommonLib, CommonHelper, Image, File, Carbon, DB, Validator;

class PincodeMasterController extends Controller
{
    public function sdindex()
    {
        $sdpincodes = PincodeMaster::where('pincode_type',1)->get();
        return view('pincode.sdpincodes')->with('sdpincodes', $sdpincodes);
    }

    public function sdpincode_create(Request $request){
        try{
            if($request->isMethod('post')){
                DB::beginTransaction();
                $count = PincodeMaster::where('pincode','=',$request->pincode)->count();
                $user = Auth::user();
                if($count == 0){
                    $sdpincode = new PincodeMaster();
                    $sdpincode->pincode = $request->pincode;
                    $sdpincode->pincode_type = 1;
                    $sdpincode->delivery_charge = 0;
                    $sdpincode->user_id = isset($user->user_id) ? $user->user_id : 1;
                    $sdpincode->isactive = isset($request->isactive) ? 1 : 0;
                    $sdpincode->save();
                    DB::commit();
                    flash()->success('Pincode Added Successfully!');
                    return redirect()->route('sdpincodes');
                }else {
                    flash()->warning('Weight Is Already Created!');
                    return redirect()->route('sdpincodes');
                }
            }else{
                return view('pincode.sdpincode_create');
            }
        }catch(\Exception $exception){
            // dd($exception);
            DB::rollback();
            return redirect()->route('sdpincodes')->with('error', $exception->getMessage());
        }
    }


    public function sdpincode_edit(Request $request, $id){
        try{
            if($request->isMethod('post')){
                DB::beginTransaction();
                $count = PincodeMaster::where('pincode','=',$request->pincode)->where('pincode_id','!=',$id)->count();
                $user = Auth::user();
                if($count == 0){
                    $sdpincode = PincodeMaster::find($id);
                    $sdpincode->pincode = $request->pincode;
                    $sdpincode->pincode_type = 1;
                    $sdpincode->delivery_charge = 0;
                    $sdpincode->user_id = isset($user->user_id) ? $user->user_id : 1;
                    $sdpincode->isactive = isset($request->isactive) ? 1 : 0;
                    $sdpincode->save();
                    DB::commit();
                    flash()->success('Pincode Updated Successfully!');
                    return redirect()->route('sdpincodes');
                }else {
                    flash()->warning('Pincode Is Already Exist!');
                    return redirect()->route('sdpincodes');
                }
            }else{
                $data['sdpincode'] = PincodeMaster::find($id);
                return view('pincode.sdpincode_edit', $data ?? NULL);
            }
        }catch(\Exception $exception){
            // dd($exception);
            DB::rollback();
            return redirect()->route('sdpincodes')->with('error', $exception->getMessage());
        }
    }

    public function sdpincode_delete($id)
    {
        $data = PincodeMaster::find($id);
        if($data->delete()){
            flash()->success('Standerd Pincode Deleted Successfully!');
            return redirect()->route('sdpincodes');
        }else{
            flash()->error('Please Try Again!');
            return redirect()->route('sdpincodes');
        }


    }

    public function edindex()
    {
        $edpincodes = PincodeMaster::where('pincode_type',2)->get();
        return view('pincode.edpincodes')->with('edpincodes', $edpincodes);
    }

    public function edpincode_create(Request $request){
        try{
            if($request->isMethod('post')){
                DB::beginTransaction();
                $count = PincodeMaster::where('pincode','=',$request->pincode)->count();
                $user = Auth::user();
                if($count == 0){
                    $sdpincode = new PincodeMaster();
                    $sdpincode->pincode = $request->pincode;
                    $sdpincode->pincode_type = 2;
                    $sdpincode->delivery_charge = $request->delivery_charge;
                    $sdpincode->user_id = isset($user->user_id) ? $user->user_id : 1;
                    $sdpincode->isactive = isset($request->isactive) ? 1 : 0;
                    $sdpincode->save();
                    DB::commit();
                    flash()->success('Pincode Added Successfully!');
                    return redirect()->route('edpincodes');
                }else {
                    flash()->warning('Pincode Is Already Created!');
                    return redirect()->route('edpincodes');
                }
            }else{
                return view('pincode.edpincode_create');
            }
        }catch(\Exception $exception){
            // dd($exception);
            DB::rollback();
            return redirect()->route('edpincodes')->with('error', $exception->getMessage());
        }
    }

    public function edpincode_edit(Request $request, $id){
        try{
            if($request->isMethod('post')){
                DB::beginTransaction();
                $count = PincodeMaster::where('pincode','=',$request->pincode)->where('pincode_id','!=',$id)->count();
                $user = Auth::user();
                if($count == 0){
                    $sdpincode = PincodeMaster::find($id);
                    $sdpincode->pincode = $request->pincode;
                    $sdpincode->pincode_type = 2;
                    $sdpincode->delivery_charge = $request->delivery_charge;
                    $sdpincode->user_id = isset($user->user_id) ? $user->user_id : 1;
                    $sdpincode->isactive = isset($request->isactive) ? 1 : 0;
                    $sdpincode->save();
                    DB::commit();
                    flash()->success('Pincode Updated Successfully!');
                    return redirect()->route('edpincodes');
                }else {
                    flash()->warning('Pincode Is Already Exist!');
                    return redirect()->route('edpincodes');
                }
            }else{
                $data['edpincode'] = PincodeMaster::find($id);
                return view('pincode.edpincode_edit', $data ?? NULL);
            }
        }catch(\Exception $exception){
            // dd($exception);
            DB::rollback();
            return redirect()->route('edpincodes')->with('error', $exception->getMessage());
        }
    }
    public function edpincode_delete($id)
    {
        $data = PincodeMaster::find($id);
        if($data->delete()){
            flash()->success('Extended Pincode Deleted Successfully!');
            return redirect()->route('edpincodes');
        }else{
            flash()->error('Please Try Again!');
            return redirect()->route('edpincodes');
        }


    }
}
