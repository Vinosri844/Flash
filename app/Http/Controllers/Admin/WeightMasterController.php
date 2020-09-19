<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PaymentTypeMaster;
use App\WeightMaster;
use Illuminate\Http\Request;
use App\Category;
use App\Slider;
use CommonLib, CommonHelper, Image, File, Carbon, DB, Validator;

class WeightMasterController extends Controller
{
    public function index()
    {

        $weights = WeightMaster::where('isactive',1)->where('isdelete',0)->get();
        return view('weight.weights')->with('weights', $weights);
    }

    public function weight_create(Request $request){
        try{
            if($request->isMethod('post')){
                DB::beginTransaction();
                $weight_name = strtolower(preg_replace('/\s+/', '', $request->weight));

                $count = WeightMaster::where('weight_display','=',$weight_name)->count();
                if($count == 0){
                    $weights = new WeightMaster();
                    $weights->weight_display = $weight_name;
                    $weights->actual_weight = 1;
                    $weights->isdelete = 0;
                    $weights->unit = ' ';
                    $weights->isactive = isset($request->isactive) ? 1 : 0;
                    $weights->save();
                    DB::commit();
                    flash()->success('Weight Created Successfully!');
                    return redirect()->route('weights');
                }else {
                    flash()->warning('Weight Is Already Created!');
                    return redirect()->route('weights');
                }
            }else{
                return view('weight.weight_create');
            }
        }catch(\Exception $exception){
            dd($exception);
            DB::rollback();
            return redirect()->route('weights')->with('error', $exception->getMessage());
        }
    }


    public function weight_edit(Request $request, $id){
        try{
            if($request->isMethod('post')){
                DB::beginTransaction();
                $weight_name = strtolower(preg_replace('/\s+/', '', $request->weight));
                $count = WeightMaster::where('weight_display','=',$weight_name)->count();
                if($count == 0){
                    $weights = WeightMaster::find($id);
                    $weights->weight_display = $weight_name;
                    $weights->actual_weight = 1;
                    $weights->isdelete = 0;
                    $weights->unit = ' ';
                    $weights->isactive = isset($request->isactive) ? 1 : 0;
                    $weights->save();
                    DB::commit();
                    flash()->success('Weight Updated Successfully!');
                    return redirect()->route('weights');
                }else {
                    flash()->warning('Weight Is Already Exist!');
                    return redirect()->route('weights');
                }


            }else{
                $data['weight'] = WeightMaster::find($id);
                return view('weight.weight_edit', $data ?? NULL);
            }
        }catch(\Exception $exception){
            dd($exception);
            DB::rollback();
            return redirect()->route('weights')->with('error', $exception->getMessage());
        }
    }

    public function weight_delete($id)
    {
        $data = WeightMaster::find($id);
        $data->isdelete = 1;
        if($data->save()){
            flash()->success('Weight Deleted Successfully!');
            return redirect()->route('weights');
        }else{
            flash()->error('Please Try Again!');
            return redirect()->route('weights');
        }


    }
}
