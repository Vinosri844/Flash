<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Slider;
use App\PaymentTypeMaster;
use Illuminate\Http\Request;
use CommonLib, CommonHelper, Image, File, Carbon, DB, Validator;


class PaymentTypeController extends Controller
{
    public function index()
    {

        $payments = PaymentTypeMaster::where('isdelete', 0)->get();
        return view('paymenttype.paymenttypes')->with('payments', $payments);
    }

    public function paymenttype_create(Request $request){
        try{
            if($request->isMethod('post')){
                DB::beginTransaction();
                $payments = new PaymentTypeMaster();
                $payments->payment_name = $request->name;
                $payments->isdelete = 0;
                $payments->isactive = $request->isactive = 'on' ? 1 : 0;

                $payments->save();
                DB::commit();
                flash()->success('PaymentType Created Successfully!');
                return redirect()->route('paymenttypes');
            }else{
                return view('paymenttype.paymenttypes_create');
            }
        }catch(\Exception $exception){
            //  dd($exception);
            DB::rollback();
            return redirect()->route('paymenttypes')->with('error', $exception->getMessage());
        }
    }


    public function paymenttype_edit(Request $request, $id){
        try{
            if($request->isMethod('post')){
                DB::beginTransaction();
                $payment = PaymentTypeMaster::find($id);
                $payment->payment_name = $request->name;
                $payment->isactive = isset($request->isactive) ? 1 : 0;
                $payment->save();

                DB::commit();
                flash()->success('Payment Updated Successfully!');
                return redirect()->route('paymenttypes');


            }else{
                $data['payment'] = PaymentTypeMaster::find($id);
                return view('paymenttype.paymenttypes_edit', $data ?? NULL);
            }
        }catch(\Exception $exception){
            //   dd($exception);
            DB::rollback();
            return redirect()->route('paymenttypes')->with('error', $exception->getMessage());
        }
    }

    public function paymenttype_delete($id)
    {
        $data = PaymentTypeMaster::find($id);
        $data->isdelete = 1;
        if($data->save()){
            flash()->success('Slider Deleted Successfully!');
            return redirect()->route('paymenttypes');
        }else{
            flash()->error('Please Try Again!');
            return redirect()->route('paymenttypes');
        }


    }
}
