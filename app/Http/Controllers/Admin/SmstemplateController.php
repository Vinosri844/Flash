<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PaymentTypeMaster;
use Illuminate\Http\Request;
use CommonLib, CommonHelper, Image, File, Carbon, DB, Validator;
use App\SmsTemplate;


class SmstemplateController extends Controller
{
    public function index()
    {
        $smstemplates = SmsTemplate::orderby('sms_template_id','desc')->get();
        foreach ($smstemplates as $smstemplate){
            $smstemplate->created_on = date_format(date_create($smstemplate->created_date_time),'d-M-y');
        }
        return view('smstemplate.smstemplates')->with('smstemplates', $smstemplates);
    }

    public function smstemplate_create(Request $request){
        try{
            if($request->isMethod('post')){
                DB::beginTransaction();
                $smstemplate = new SmsTemplate();
                $smstemplate->sms_template_name = $request->sms_template_name;
                $smstemplate->sms_template_data = $request->template_description;
                $smstemplate->save();
                DB::commit();
                flash()->success('Sms Template Created Successfully!');
                return redirect()->route('smstemplates');
            }else{
                return view('smstemplate.smstemplate_create');
            }
        }catch(\Exception $exception){
           // dd($exception);
            DB::rollback();
            return redirect()->route('smstemplates')->with('error', $exception->getMessage());
        }
    }


    public function smstemplate_edit(Request $request, $id){
        try{
            if($request->isMethod('post')){
                DB::beginTransaction();
                $smstemplate = SmsTemplate::find($id);
                $smstemplate->sms_template_name = $request->sms_template_name;
                $smstemplate->sms_template_data = $request->template_description;
                $smstemplate->save();

                DB::commit();
                flash()->success('SmsTemplate Updated Successfully!');
                return redirect()->route('smstemplates');


            }else{
                $data['smstemplate'] = SmsTemplate::find($id);
                return view('smstemplate.smstemplate_edit', $data ?? NULL);
            }
        }catch(\Exception $exception){
           // dd($exception);
            DB::rollback();
            return redirect()->route('smstemplates')->with('error', $exception->getMessage());
        }
    }

    public function smstemplate_delete($id)
    {
        $data = SmsTemplate::find($id);
       // $data->isdelete = 1;
        if($data->delete()){
            flash()->success('Slider Deleted Successfully!');
            return redirect()->route('smstemplates');
        }else{
            flash()->error('Please Try Again!');
            return redirect()->route('smstemplates');
        }


    }
}
