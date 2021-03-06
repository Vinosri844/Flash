<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Store;
use App\Setting;
use App\SellerBranch;
use Illuminate\Http\Request;
use Validator;
use Image, DB;
use App\Userlogs;
// use Illuminate\Support\Facades\Session;

class StoreController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::where('isdelete', 0)->orderBy('seller_id', 'desc')->withCount('branches')->get();
        return view('store.store')->with('stores', $stores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            $status = Setting::pluck('multistore')->first();
            if($status == 0){
                flash()->error('Cannot Create Multi Store');
                return redirect()->route('store.index');
            }
        return view('store.store_create');
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
            // dd($request);
            $status = Setting::pluck('multistore')->first();
            if($status == 0){
                flash()->error('Cannot Create Multi Store');
                return redirect()->back();
            }
            $validator = Validator::make($request->all(),[
                'store_name' => 'required',
                'store_email' => 'required',
                'store_password' => 'required',
                'store_pan_image' => 'mimes:jpeg,jpg|max:2000',
                'store_company_logo' => 'required|mimes:jpeg,jpg|max:2000',
            ]);
            
            if($validator->fails()){
                // $error = implode("," ,$validator->errors()->messages());
                flash()->error('Please Fill Images as Jpg or Jpeg ( MAX size : 2.5MB )');
                return redirect()->route('store.create');
            }

            $pancard_original_path = '/image/sellerpancard/OriginalImage/'; // Pan Card Original Image
            $companylogo_compress_path = '/image/sellercompanylogo/CompressImage/'; // Company Logo Compress Image
            $companylogo_original_path = '/image/sellercompanylogo/OriginalImage/'; // Company Logo Orignal Image
            $companylogo_thumbnail_path ='image/sellercompanylogo/ThumbnailImage/'; // Company Logo Thumbnil Image
            $store_name = $request->store_name;
            $file_name = preg_replace('/[^a-zA-Z0-9]/', "_", strtolower($store_name));
            $file_path = null;
            $company_file_path = null;
            if($request->hasFile('store_pan_image')){
                // dd(1);
                if($request->file('store_pan_image')->isValid())
                {

                    $extension = $request->store_pan_image->extension();
                    $saved_name = $file_name.time()."pan." .$extension;
                    $request->store_pan_image->move(($pancard_original_path), $saved_name);
                    $file_path = $saved_name;
                }
            }
            if($request->hasFile('store_company_logo')){
                if($request->file('store_company_logo')->isValid())
                {
                    $image = $request->store_company_logo;
                    $extension = $request->store_company_logo->extension();
                    $company_saved_name = $file_name.time()."com." .$extension;
                    $request->store_company_logo->move(($companylogo_original_path), $company_saved_name);
                    $company_file_path = $company_saved_name;
                }
            }
            
            $hash_password = md5($request->store_password . '_$un@k2u@m!s');
            DB::beginTransaction();
            $store = new Store;
            $store->seller_name = $store_name;
            $store->t_seller_name = $request->store_name_tamil;
            $store->seller_user_name = $request->store_name;
            $store->seller_description = $request->store_description;
            $store->seller_pan_number = $request->store_pan_num;
            $store->seller_pan_number_image = $file_path;
            $store->seller_cst_tin_number = $request->store_cst_num;
            $store->seller_gst_tin_number = $request->store_gst_num;
            $store->seller_food_licence_number = null;
            $store->seller_fssai_number = $request->store_fssai_num;
            $store->seller_service_tax_number = $request->store_service_tax_num;
            $store->seller_company_image = $company_file_path;
            $store->seller_password = $hash_password;
            $store->vat_1 = $request->store_val_1;
            $store->vat_2 = $request->store_val_2;
            $store->isactive = $request->store_active == null ? 0 : 1;
            $store->isapprove = $request->store_approve == null ? 0 : 1;
            $store->approve_by = 1;
            // $store->disapprove_by = '';
            // $store->category_id = '';
            // $store->leaving_date_time = '00:00:00';
            $store->t_seller_name = $request->store_mobile_number;
            $store->seller_food_licence_number = 'Undefined';
            $store->user_id = 1;
            $store->seller_errand = $request->store_errand;
            $store->seller_emailid = $request->store_email;
            $store->seller_cart_value = $request->store_min_value;
            if($store->save()){
                $user = new Userlogs;
                $user->form_name = 'Seller';
                $user->operation_type = 'Insert';
                $user->user_id = 1;
                $user->description = "Insert Seller Name - ". $request->store_name;
                $user->OS = 'WEB';
                $user->table_name = 'seller_master';
                $user->reference_id = $store->seller_id;
                $user->ip_device_id = "000:00:00";
                $user->user_type_id = 1;
                $user->save();
                $seller_id = $store->seller_id;
        //         if($request->branches[0]['store_branch_name'] != null){
        //         foreach ($request->branches as $key => $value) {
        //             // dd($value);
        //         $branch = new SellerBranch;
        //         $branch->seller_branch_name = $value['store_branch_name'];
        //         $branch->seller_branch_address = $value['store_short_address'];
        //         $branch->seller_branch_pincode = $value['store_pincode'];
        //         // $branch->seller_branch_state = '';
        //         // $branch->seller_branch_country ='';
        //         $branch->seller_branch_city = $value['store_branch_city'];
        //         $branch->seller_branch_contact_no = $request->store_mobile_number;
        //         $branch->seller_branch_emailid = $request->store_email;
        //         $branch->seller_id = $seller_id;
        //         $branch->seller_branch_type = $value['store_branch_type'];
        //         $branch->isactive = 1;
        //         $branch->isdelete = 0;
        //         if($branch->save()){
        //             $user = new Userlogs;
        //             $user->form_name = 'Seller Branch';
        //             $user->operation_type = 'Insert';
        //             $user->user_id = 1;
        //             $user->description = "Insert Seller Branch Name - ". $value['store_branch_name'];
        //             $user->OS = 'WEB';
        //             $user->table_name = 'seller_master';
        //             $user->reference_id = $branch->seller_branch_id;
        //             $user->ip_device_id = "000:00:00";
        //             $user->user_type_id = 1;
        //             $user->save();
        //         }
        //     }
        // }
            DB::commit();
                flash()->success('Store Created Successfully!');
                return redirect()->route('store.index');
                
            }
            flash()->error('Please Try Again!');
            return redirect()->route('store.index');
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            flash()->error('Something went Wrong! Please Try Again!');
            return redirect()->route('store.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        try {
            
            $store = Store::findOrFail($store->seller_id);
            $branches = SellerBranch::where('seller_id', $store->seller_id)->where('isdelete', 0)->get();
            return view('store.store_edit')->with(['store' => $store, 'branches' => $branches]);
        } catch (\Throwable $th) {
            dd($th);
            flash()->error('Something went Wrong! Please Try Again!');
            return redirect()->route('store.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        try {
            // dd($request);
            $validator = Validator::make($request->all(),[
                'store_name' => 'required',
                'store_pan_image' => 'mimes:jpeg,jpg|max:2000',
                'store_company_logo' => 'mimes:jpeg,jpg|max:2000',
                
            ]);
            // dd($request);
            if($validator->fails()){
                flash()->error('Please Fill the required fields!');
                return redirect()->route('store.index');
            }

            $pancard_original_path = '/image/sellerpancard/OriginalImage/'; // Pan Card Original Image
            $companylogo_compress_path = '/image/sellercompanylogo/CompressImage/'; // Company Logo Compress Image
            $companylogo_original_path = '/image/sellercompanylogo/OriginalImage/'; // Company Logo Orignal Image
            $companylogo_thumbnail_path ='/image/sellercompanylogo/ThumbnailImage/'; // Company Logo Thumbnil Image
            $store_name = $request->store_name;
            $file_name = preg_replace('/[^a-zA-Z0-9]/', "_", strtolower($store_name));
            $file_path = null;
            $company_file_path = null;
            if($request->hasFile('store_pan_image')){
                // dd(1);
                if($request->file('store_pan_image')->isValid())
                {

                    $extension = $request->store_pan_image->extension();
                    $saved_name = $file_name.time()."pan." .$extension;
                    $request->store_pan_image->move(($pancard_original_path), $saved_name);
                    $file_path = $saved_name;
                }
            }
            if($request->hasFile('store_company_logo')){
                // dd(1);
                if($request->file('store_company_logo')->isValid())
                {

                    $extension = $request->store_company_logo->extension();
                    $company_saved_name = $file_name.time()."com." .$extension;
                    $request->store_company_logo->move(($companylogo_original_path), $company_saved_name);
                    $company_file_path = $company_saved_name;
                }
            }
            
            DB::beginTransaction();
            $store = Store::findOrFail($store->seller_id);
            $store->seller_name = $store_name;
            $store->t_seller_name = $request->store_name_tamil;
            $store->seller_user_name = $request->store_name;
            $store->seller_description = $request->store_description;
            $store->seller_pan_number = $request->store_pan_num;
            if($file_path != null || $request->remove != null){
                $store->seller_pan_number_image = $file_path;
            }
            if($company_file_path != null){
                $store->seller_company_image = $company_file_path;
            }
            $store->seller_cst_tin_number = $request->store_cst_num;
            $store->seller_gst_tin_number = $request->store_gst_num;
            $store->seller_food_licence_number = null;
            $store->seller_fssai_number = $request->store_fssai_num;
            $store->seller_service_tax_number = $request->store_service_tax_num;
            $store->t_seller_name = $request->store_mobile_number;
            if($request->store_password != null){
                $store->seller_password = $request->store_password;
            }
            
            $store->vat_1 = $request->store_val_1;
            $store->vat_2 = $request->store_val_2;
            $store->isactive = $request->store_active == null ? 0 : 1;
            $store->isapprove = $request->store_approve == null ? 0 : 1;
            $store->approve_by = 1;
            // $store->disapprove_by = '';
            // $store->category_id = '';
            // $store->leaving_date_time = '00:00:00';
            // $store->disapprove_date_time = '00:00:00';
            $store->seller_food_licence_number = 'Undefined';
            $store->user_id = 1;
            $store->seller_errand = $request->store_errand;
            // $store->seller_emailid = $request->store_email;
            $store->seller_cart_value = $request->store_min_value;
            if($store->save()){
                $seller_id = $store->seller_id;   
                $user = new Userlogs;
                $user->form_name = 'Seller';
                $user->operation_type = 'Update';
                $user->user_id = 1;
                $user->description = "Update Seller Name - ". $request->store_name;
                $user->OS = 'WEB';
                $user->table_name = 'seller_master';
                $user->reference_id = $store->seller_id;
                $user->ip_device_id = "000:00:00";
                $user->user_type_id = 1;
                $user->save();
        //         if($request->branches[0]['store_branch_name'] != null){
        //         foreach ($request->branches as $key => $value) {
                    
                
        //         $branch = SellerBranch::findOrFail($value['seller_branch_id']);
                
        //         $branch->seller_branch_name = $value['store_branch_name'];
        //         $branch->seller_branch_address = $value['store_short_address'];
        //         $branch->seller_branch_pincode = $value['store_pincode'];
        //         // $branch->seller_branch_state = '';
        //         // $branch->seller_branch_country ='';
        //         $branch->seller_branch_city = $value['store_branch_city'];
        //         $branch->seller_branch_contact_no = $request->store_mobile_number;
        //         // $branch->seller_branch_emailid = $request->store_email;
        //         $branch->seller_id = $seller_id;
        //         $branch->seller_branch_type = $value['store_branch_type'];
        //         $branch->isactive = 1;
        //         $branch->isdelete = 0;
        //         if($branch->save()){
        //             $user = new Userlogs;
        //             $user->form_name = 'Seller Branch';
        //             $user->operation_type = 'Update';
        //             $user->user_id = 1;
        //             $user->description = "Update Seller Branch Name - ". $value['store_branch_name'];
        //             $user->OS = 'WEB';
        //             $user->table_name = 'seller_branch';
        //             $user->reference_id = $branch->seller_branch_id;
        //             $user->ip_device_id = "000:00:00";
        //             $user->user_type_id = 1;
        //             $user->save();
        //         }
        //     }
        // }
            DB::commit();
            flash()->success('Store Updated Successfully!');
            return redirect()->back();
                
            }
            flash()->error('Please Try Again!');
            return redirect()->route('store.index');
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            flash()->error('Something went Wrong! Please Try Again!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        try {
            $store = Store::findOrFail($store->seller_id);
            $store->isdelete = 1;
            if($store->save()){
                flash()->info("Store Deleted Successfully!");
                return redirect()->route('store.index');
            }
            flash()->error('Please Try Again!');
            return redirect()->route('store.index');
        } catch (\Throwable $th) {
            //throw $th;
            flash()->error('Something went Wrong! Please Try Again!');
            return redirect()->route('store.index');
        }
    }

    public function branch_add(Request $request){
        try {
            $validator = Validator::make($request->all(),[
                'store_branch_name' => 'required'
            ]);
            if($validator->fails()){
                flash()->error('Please Fill the required fields!');
                return redirect()->back();
            }
            $branch = new SellerBranch;
            $branch->seller_branch_name = $request->store_branch_name;
            $branch->seller_branch_address = $request->store_short_address;
            $branch->seller_branch_pincode = $request->store_pincode;
            // $branch->seller_branch_state = '';
            // $branch->seller_branch_country ='';
            $branch->seller_branch_city = $request->store_branch_city;
            $branch->seller_branch_contact_no = $request->store_mobile_number;
            // $branch->seller_branch_emailid = $request->store_email;
            $branch->seller_id = $request->seller_id;
            $branch->seller_branch_type = $request->store_branch_type;
            $branch->save();
            flash()->success('Branch added successfully!');
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
            flash()->error('Something went Wrong! Please Try Again!');
            return redirect()->back();
        }
    }

    public function branch_delete(Request $request, $id){
        try {
            $branch = SellerBranch::findOrFail($id)->update(['isdelete' => 1]);
            flash("Branch deleted successfully!");
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
            flash()->error('Something went Wrong! Please Try Again!');
            return redirect()->back();
        }
    }
}
