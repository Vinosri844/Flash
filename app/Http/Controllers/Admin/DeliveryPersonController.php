<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\ProductDetails;
use App\ProductImages;
use App\SellerBranch;
use App\SellerBranchProduct;
use App\SubCategory;
use Illuminate\Http\Request;
use App\ProductMaster;
use App\SellerMaster;
use App\Userlogs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\LogisticMaster;
use App\Manager;
use CommonLib, CommonHelper, Image, File, Carbon, DB, Validator;
class DeliveryPersonController extends Controller
{

    public function index()
    {
        $masters = LogisticMaster::where('isdelete', 0)->orderBy('logistics_id', 'desc')->get();

        return view('delivery.list')->with('masters', $masters);
    }


    public function deliveryperson_add(Request $request)
    {
        try{
            if($request->isMethod('post'))
            {
                $validator = Validator::make($request->input(), [
                    'deliveryperson_name' => 'required',
                    'dperson_mobile_number' => 'required',
                    'dperson_email' => 'required',
                    'dperson_password' => 'required',
                    'licence_number' => 'required',
                ]);

                // if form validation errors
                if ($validator->fails()) {
                    flash()->error('Please fill the required fields');
                    return redirect()->back();
                }
                $logistic_password = md5($request->dperson_password.'_$un@k2u@m!s');
                $current_date = date('Y-m-d H:i:s');

                DB::beginTransaction();
               $deliveryperson = new LogisticMaster();
               $deliveryperson->logistics_name = $request->deliveryperson_name;
               $deliveryperson->logistics_driving_licence_number = $request->licence_number;
               $deliveryperson->logistics_password = $logistic_password;
               $deliveryperson->logistics_user_vehicle_number = $request->vehicle_number;
               $deliveryperson->logistics_user_vehicle_name = $request->vehicle_name;
               $deliveryperson->logistics_user_address = $request->dperson_address;
               $deliveryperson->logistics_user_email = $request->dperson_email;
               $deliveryperson->logistics_user_mobile = $request->dperson_mobile_number;
               $deliveryperson->user_type_id = 6;
               $deliveryperson->isactive = $request->is_active ? 1 : 0;
               $deliveryperson->registration_date_time = $current_date;
               $deliveryperson->leaving_date_time = $current_date;
               $deliveryperson->disapprove_date_time = $current_date;

               $deliveryperson->approve_date_time = $request->is_approve ? $current_date : null;
               $deliveryperson->isapprove = $request->is_approve ? 1 : 0;
               $deliveryperson->approve_by = 1;
               if($request->hasFile('dlicenceImage')) {
                   $photo = $request->file('dlicenceImage');

                   if(isset($photo) && !empty($photo) && $photo->isValid()) {
                       $rules = array('photo' => 'required|mimes:png,jpg,jpeg');
                       $validator = Validator::make(array('photo'=> $photo), $rules);
                       if($validator->passes()) {
                           $file_name = preg_replace('/[^a-zA-Z0-9]/', '_', strtolower($request->input('dlicenceImage'))).'_'.time().'.'.$photo->getClientOriginalExtension();
                           $file_path = public_path(config('constants.product_img_path').$file_name);
                           $file_path1 = public_path(config('constants.product_img_path1').$file_name);
                           $file_path2 = public_path(config('constants.product_img_path2').$file_name);

                           $save_photo = Image::make($photo->getRealPath())->save($file_path);
                           $save_photo = Image::make($photo->getRealPath())->save($file_path2);
                           // Resize Image
                           $save_photo = Image::make($photo->getRealPath())->resize(config('constants.image_width'), config('constants.image_height'))->save($file_path1);

                           $deliveryperson->logistics_driving_licence_number_image = $file_name;
                       }
                   }
               }

               if($request->hasFile('dpersonImage')) {
                   $photo = $request->file('dpersonImage');

                   if(isset($photo) && !empty($photo) && $photo->isValid()) {
                       $rules = array('photo' => 'required|mimes:png,jpg,jpeg');
                       $validator = Validator::make(array('photo'=> $photo), $rules);
                       if($validator->passes()) {
                           $file_name = preg_replace('/[^a-zA-Z0-9]/', '_', strtolower($request->input('dpersonImage'))).'_'.time().'.'.$photo->getClientOriginalExtension();
                           $file_path = public_path(config('constants.product_img_path').$file_name);
                           $file_path1 = public_path(config('constants.product_img_path1').$file_name);
                           $file_path2 = public_path(config('constants.product_img_path2').$file_name);

                           $save_photo = Image::make($photo->getRealPath())->save($file_path);
                           $save_photo = Image::make($photo->getRealPath())->save($file_path2);
                           // Resize Image
                           $save_photo = Image::make($photo->getRealPath())->resize(config('constants.image_width'), config('constants.image_height'))->save($file_path1);

                           $deliveryperson->logistics_user_image = $file_name;
                       }
                   }
               }

                 $check = $deliveryperson->save();

                 if($deliveryperson){
                   $userlog_description = "Insert Logistic Name - " . $request->deliveryperson_name;

                   $userlog = new Userlogs();
                   $userlog->form_name = 'Logistic/Delivery Boy';
                   $userlog->operation_type = 'insert';
                   $userlog->user_id = isset($user->user_id) ? $user->user_id : 1;
                   $userlog->log_date_time = $current_date;
                   $userlog->description = $userlog_description;
                   $userlog->OS = $request->os ? $request->os : "windows";
                   $userlog->table_name = 'logistics_master';
                   $userlog->reference_id = $deliveryperson->logistics_id;
                   $userlog->ip_device_id = $request->getHost();
                   $userlog->user_type_id = 6;
                   $userlog->save();

                   $manager = new Manager();
                   $manager->manager_name = $request->deliveryperson_name;
                   $manager->manager_emailid = $request->dperson_email;
                   $manager->manager_password = $logistic_password;
                   $manager->manager_mobileno = $request->dperson_mobile_number;
                   if($deliveryperson->logistics_user_image != null){
                        $manager->manager_image = $deliveryperson->logistics_user_image;
                   }
                   $manager->user_type_id = 6;
                   $manager->user_id = 1;
                   $manager->isactive = $deliveryperson->isactive;
                   $manager->save();

                   if($manager){
                     $userlog_description = "Insert logisticto manager table - " . $request->deliveryperson_name;

                     $userlog = new Userlogs();
                     $userlog->form_name = 'Logistic Master';
                     $userlog->operation_type = 'insert';
                     $userlog->user_id = isset($user->user_id) ? $user->user_id : 1;
                     $userlog->log_date_time = $current_date;
                     $userlog->description = $userlog_description;
                     $userlog->OS = $request->os ? $request->os : "windows";
                     $userlog->table_name = 'manager';
                     $userlog->reference_id = $manager->manager_id;
                     $userlog->ip_device_id = $request->getHost();
                     $userlog->user_type_id = 6;
                     $userlog->save();
                   }


                 }
                if($check) {
                    DB::commit();
                   flash()->success('Product Created Successfully!');
                    return redirect()->route('deliverypersons');
                } else {
                   flash()->error('Please Try Again!');
                    
                    return redirect()->route('deliverypersons');
                }

            }
            else{

                $data['category'] = Category::orderBy('category_id', 'desc')->get();
                $data['subcategory'] = SubCategory::orderBy('subcategory_id', 'desc')->get();
                $data['seller'] = SellerMaster::where('isactive',1)->where('isdelete',0)->get();


                return view('delivery.add', $data ?? NULL);
            }
        }
        Catch(\Exception $e)
        {
            dd($e);
            DB::rollback();
            return redirect()->route('deliverypersons')->with('error', $e->getMessage());
        }

    }

    public function deliveryperson_edit(Request $request, $logistics_id)
    {
        try{
            if($request->isMethod('post'))
            {
                $validator = Validator::make($request->input(), [
                    'deliveryperson_name' => 'required'
                ]);

                // if form validation errors
                if ($validator->fails()) {
                    flash()->error('Please fill the required fields');
                    return redirect()->route('deliverypersons')
                        ->withErrors($validator)
                        ->withInput();
                }
                $logistic_password = md5($request->dperson_password.'_$un@k2u@m!s');
                $current_date = date('Y-m-d H:i:s');


               $deliveryperson = LogisticMaster::find($logistics_id);
               $deliveryperson->logistics_name = $request->deliveryperson_name;
               $deliveryperson->logistics_driving_licence_number = $request->licence_number;
               $deliveryperson->logistics_password = $logistic_password;
               $deliveryperson->logistics_user_vehicle_number = $request->vehicle_number;
               $deliveryperson->logistics_user_vehicle_name = $request->vehicle_name;
               $deliveryperson->logistics_user_address = $request->dperson_address;
               $deliveryperson->logistics_user_email = $request->dperson_email;
               $deliveryperson->logistics_user_mobile = $request->dperson_mobile_number;
               $deliveryperson->user_type_id = 6;
               $deliveryperson->isactive = $request->is_active ? 1 : 0;
               $deliveryperson->registration_date_time = $current_date;
               $deliveryperson->leaving_date_time = $current_date;
               $deliveryperson->disapprove_date_time = $current_date;

               $deliveryperson->approve_date_time = $request->is_approve ? $current_date : null;
               $deliveryperson->isapprove = $request->is_approve ? 1 : 0;
               $deliveryperson->approve_by = 1;
               if($request->hasFile('dlicenceImage')) {
                   $photo = $request->file('dlicenceImage');

                   if(isset($photo) && !empty($photo) && $photo->isValid()) {
                       $rules = array('photo' => 'required|mimes:png,jpg,jpeg');
                       $validator = Validator::make(array('photo'=> $photo), $rules);
                       if($validator->passes()) {
                           $file_name = preg_replace('/[^a-zA-Z0-9]/', '_', strtolower($request->input('dlicenceImage'))).'_'.time().'.'.$photo->getClientOriginalExtension();
                           $file_path = public_path(config('constants.product_img_path').$file_name);
                           $file_path1 = public_path(config('constants.product_img_path1').$file_name);
                           $file_path2 = public_path(config('constants.product_img_path2').$file_name);

                           $save_photo = Image::make($photo->getRealPath())->save($file_path);
                           $save_photo = Image::make($photo->getRealPath())->save($file_path2);
                           // Resize Image
                           $save_photo = Image::make($photo->getRealPath())->resize(config('constants.image_width'), config('constants.image_height'))->save($file_path1);

                           $deliveryperson->logistics_driving_licence_number_image = $file_name;
                       }
                   }
               }

               if($request->hasFile('dpersonImage')) {
                   $photo = $request->file('dpersonImage');

                   if(isset($photo) && !empty($photo) && $photo->isValid()) {
                       $rules = array('photo' => 'required|mimes:png,jpg,jpeg');
                       $validator = Validator::make(array('photo'=> $photo), $rules);
                       if($validator->passes()) {
                           $file_name = preg_replace('/[^a-zA-Z0-9]/', '_', strtolower($request->input('dpersonImage'))).'_'.time().'.'.$photo->getClientOriginalExtension();
                           $file_path = public_path(config('constants.product_img_path').$file_name);
                           $file_path1 = public_path(config('constants.product_img_path1').$file_name);
                           $file_path2 = public_path(config('constants.product_img_path2').$file_name);

                           $save_photo = Image::make($photo->getRealPath())->save($file_path);
                           $save_photo = Image::make($photo->getRealPath())->save($file_path2);
                           // Resize Image
                           $save_photo = Image::make($photo->getRealPath())->resize(config('constants.image_width'), config('constants.image_height'))->save($file_path1);

                           $deliveryperson->logistics_user_image = $file_name;
                       }
                   }
               }

                 $check = $deliveryperson->save();

                 if($deliveryperson){
                   $userlog_description = "update Logistic Name - " . $request->deliveryperson_name;

                   $userlog = new Userlogs();
                   $userlog->form_name = 'Logistic/Delivery Boy';
                   $userlog->operation_type = 'Update';
                   $userlog->user_id = isset($user->user_id) ? $user->user_id : 1;
                   $userlog->log_date_time = $current_date;
                   $userlog->description = $userlog_description;
                   $userlog->OS = $request->os ? $request->os : "windows";
                   $userlog->table_name = 'logistics_master';
                   $userlog->reference_id = $deliveryperson->logistics_id;
                   $userlog->ip_device_id = $request->getHost();
                   $userlog->user_type_id = 6;
                   $userlog->save();

                   $manager = Manager::where('user_id',$deliveryperson->logistics_id)->first();
                   $manager->manager_name = $request->deliveryperson_name;
                   $manager->manager_emailid = $request->dperson_email;
                   $manager->manager_password = $logistic_password;
                   $manager->manager_mobileno = $request->dperson_mobile_number;
                   $manager->manager_image = $deliveryperson->logistics_user_image;
                   $manager->user_type_id = 6;
                   $manager->isactive = $deliveryperson->isactive;
                   $manager->save();

                   if($manager){
                     $userlog_description = "Update logisticto manager table - " . $request->deliveryperson_name;

                     $userlog = new Userlogs();
                     $userlog->form_name = 'Logistic Master';
                     $userlog->operation_type = 'Update';
                     $userlog->user_id = isset($user->user_id) ? $user->user_id : 1;
                     $userlog->log_date_time = $current_date;
                     $userlog->description = $userlog_description;
                     $userlog->OS = $request->os ? $request->os : "windows";
                     $userlog->table_name = 'manager';
                     $userlog->reference_id = $manager->manager_id;
                     $userlog->ip_device_id = $request->getHost();
                     $userlog->user_type_id = 6;
                     $userlog->save();
                   }


                 }
                if($check) {
                    DB::commit();
                   // flash()->success('Product Created Successfully!');
                    Session::flash('message', 'Delivery boy Created Successfully!');
                    return redirect()->route('deliverypersons');
                } else {
                   // flash()->error('Please Try Again!');
                    Session::flash('alert-class', 'Please Try Again!');
                    return redirect()->route('deliverypersons');
                }

            }
            else{

                $data['deliveryperson'] = LogisticMaster::find($logistics_id);
              return view('delivery.edit', $data ?? NULL);
            }
        }
        Catch(\Exception $e)
        {
            // dd($e);
            DB::rollback();
            return redirect()->route('deliverypersons')->with('error', $e->getMessage());
        }

    }


public function deliveryperson_delete($id){
  DB::beginTransaction();

  $deliveryperson->find($id);
  $deliveryperson->isdelete = 1;
  $deliveryperson->save();
  DB::commit();
}


  }
