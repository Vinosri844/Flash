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
use App\BulkOrder;
use App\BulkOrderUser;
use CommonLib, CommonHelper, Image, File, Carbon, DB, Validator;
class BulkOrderController extends Controller
{
    public function bulkorder(Request $request){
          try{
            if($request->isMethod('post'))
            {
                $validator = Validator::make($request->input(), [
                    'title' => 'required'
                ]);

                // if form validation errors
                if ($validator->fails()) {
                    flash()->error('Please fill the required fields');
                    return redirect()->route('bulkorder')
                        ->withErrors($validator)
                        ->withInput();
                }
                $current_date = date('Y-m-d H:i:s');

            DB::beginTransaction();
            $bulkorder = new BulkOrder();
            $bulkorder->title = $request->title;
            $bulkorder->subtitle = $request->sub_title;
            $bulkorder->contact = $request->mobile_no;
            $bulkorder->button_text = $request->button_text;
            $bulkorder->description = $request->description;
            $bulkorder->userid = isset($user->user_id) ? $user->user_id : 1;
            if($request->hasFile('orderImage')) {
                $photo = $request->file('orderImage');

                if(isset($photo) && !empty($photo) && $photo->isValid()) {
                    $rules = array('photo' => 'required|mimes:png,jpg,jpeg');
                    $validator = Validator::make(array('photo'=> $photo), $rules);
                    if($validator->passes()) {
                        $file_name = preg_replace('/[^a-zA-Z0-9]/', '_', strtolower($request->input('orderImage'))).'_'.time().'.'.$photo->getClientOriginalExtension();
                        $file_path = public_path(config('constants.product_img_path').$file_name);
                        $file_path1 = public_path(config('constants.product_img_path1').$file_name);
                        $file_path2 = public_path(config('constants.product_img_path2').$file_name);

                        $save_photo = Image::make($photo->getRealPath())->save($file_path);
                        $save_photo = Image::make($photo->getRealPath())->save($file_path2);
                        // Resize Image
                        $save_photo = Image::make($photo->getRealPath())->resize(config('constants.image_width'), config('constants.image_height'))->save($file_path1);

                        $bulkorder->banner = $file_name;
                    }
                }
            }

                $check  = $bulkorder->save();

                 if($bulkorder){
                   $userlog_description = "Insert Bulk Order name-" . $bulkorder->title;
                   $userlog = new Userlogs();
                   $userlog->form_name = 'bulkorder_form';
                   $userlog->operation_type = 'insert';
                   $userlog->user_id = isset($user->user_id) ? $user->user_id : 1;
                   $userlog->log_date_time = $current_date;
                   $userlog->description = $userlog_description;
                   $userlog->OS = $request->os ? $request->os : "windows";
                   $userlog->table_name = 'bulk_order';
                   $userlog->ip_device_id = $request->getHost();
                   $userlog->user_type_id = 1;
                   $userlog->save();
                 }
                 if($check) {
                     DB::commit();
                     flash()->success('Bulk Order Created Successfully!');
                     return redirect()->route('bulkorder');
                 } else {
                     flash()->error('Please Try Again!');
                     return view('bulkorder.bulkorder');
                 }
               }else{

                     return view('bulkorder.bulkorder');
               }

          }Catch(Exception $e){
            DB::rollback();
            return redirect()->route('products')->with('error', $e->getMessage());
          }
    }

   public function bulkorderusers(Request $request){
     $masters = BulkOrderUser::with('event')->where('isdelete', 0)->orderBy('id', 'desc')->get();

     return view('bulkorder.bulkorderusers')->with('masters', $masters);
   }

}
