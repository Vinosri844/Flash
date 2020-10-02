<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Store;
use App\SellerBranch;
use Illuminate\Http\Request;
use Validator;
use Image;
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
        $stores = Store::where('isdelete', 0)->orderBy('seller_id', 'desc')->get();
        return view('store.store')->with('stores', $stores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            $file_name = str_replace(" ", "_", strtolower($store_name));
            $file_path = null;
            $company_file_path = null;
            if($request->hasFile('store_pan_image')){
                // dd(1);
                if($request->file('store_pan_image')->isValid())
                {

                    $extension = $request->store_pan_image->extension();
                    $saved_name = $file_name.time()."." .$extension;
                    $request->store_pan_image->move(public_path($pancard_original_path), $saved_name);
                    $file_path = $saved_name;
                }
            }
            if($request->hasFile('store_company_logo')){
                if($request->file('store_company_logo')->isValid())
                {
                    $image = $request->store_company_logo;
                    $extension = $request->store_company_logo->extension();
                    $company_saved_name = $file_name.time()."." .$extension;
                    $request->store_company_logo->move(public_path($companylogo_original_path), $company_saved_name);
                    // $request->store_company_logo->move(public_path($companylogo_compress_path), $company_saved_name);
                    // $request->store_company_logo->move(public_path($companylogo_thumbnail_path), $company_saved_name);
                    // $path = public_path($companylogo_thumbnail_path.$company_saved_name);
                    // Image::make($image->getRealPath())->save($path);
                    $company_file_path = $company_saved_name;
                }
            }
            
            $hash_password = md5($request->store_password . '_$un@k2u@m!s');

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
            // $store->disapprove_date_time = '00:00:00';
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
                $branch = new SellerBranch;
                $branch->seller_branch_name = $request->store_branch_name;
                $branch->seller_branch_address = $request->store_short_address;
                $branch->seller_branch_pincode = $request->store_pincode;
                // $branch->seller_branch_state = '';
                // $branch->seller_branch_country ='';
                $branch->seller_branch_city = $request->store_branch_city;
                $branch->seller_branch_contact_no = $request->store_mobile_number;
                $branch->seller_branch_emailid = $request->store_email;
                $branch->seller_id = $store->seller_id;
                $branch->seller_branch_type = $request->store_branch_type;
                $branch->isactive = 1;
                $branch->isdelete = 0;
                if($branch->save()){
                    $user = new Userlogs;
                    $user->form_name = 'Seller Branch';
                    $user->operation_type = 'Insert';
                    $user->user_id = 1;
                    $user->description = "Insert Seller Branch Name - ". $request->store_branch_name;
                    $user->OS = 'WEB';
                    $user->table_name = 'seller_master';
                    $user->reference_id = $branch->seller_branch_id;
                    $user->ip_device_id = "000:00:00";
                    $user->user_type_id = 1;
                    $user->save();
                    flash()->success('Store Created Successfully!');
                    return redirect()->route('store.index');
                }
                
            }
            flash()->error('Please Try Again!');
            return redirect()->route('store.index');
        } catch (\Throwable $th) {
            // dd($th);
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
            $branch = SellerBranch::where('seller_id', $store->seller_id)->first();
            return view('store.store_edit')->with(['store' => $store, 'branch' => $branch]);
        } catch (\Throwable $th) {
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
            $file_name = str_replace(" ", "_", strtolower($store_name));
            $file_path = null;
            $company_file_path = null;
            if($request->hasFile('store_pan_image')){
                // dd(1);
                if($request->file('store_pan_image')->isValid())
                {

                    $extension = $request->store_pan_image->extension();
                    $saved_name = $file_name.time()."." .$extension;
                    $request->store_pan_image->move(public_path($pancard_original_path), $saved_name);
                    $file_path = $saved_name;
                }
            }
            if($request->hasFile('store_company_logo')){
                // dd(1);
                if($request->file('store_company_logo')->isValid())
                {

                    $extension = $request->store_company_logo->extension();
                    $company_saved_name = $file_name.time()."." .$extension;
                    $request->store_company_logo->move(public_path($companylogo_original_path), $company_saved_name);
                    $company_file_path = $company_saved_name;
                }
            }
            

            $store = Store::findOrFail($store->seller_id);
            $store->seller_name = $store_name;
            $store->t_seller_name = $request->store_name_tamil;
            $store->seller_user_name = $request->store_name;
            $store->seller_description = $request->store_description;
            $store->seller_pan_number = $request->store_pan_num;
            if($file_path != null && $company_file_path != null){
            $store->seller_company_image = $company_file_path;
            $store->seller_pan_number_image = $file_path;
            }
            $store->seller_cst_tin_number = $request->store_cst_num;
            $store->seller_gst_tin_number = $request->store_gst_num;
            $store->seller_food_licence_number = null;
            $store->seller_fssai_number = $request->store_fssai_num;
            $store->seller_service_tax_number = $request->store_service_tax_num;
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
                // dd($store->seller_id);   
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
                $branch = SellerBranch::where('seller_id', $store->seller_id)->first();
                
                $branch->seller_branch_name = $request->store_branch_name;
                $branch->seller_branch_address = $request->store_short_address;
                $branch->seller_branch_pincode = $request->store_pincode;
                // $branch->seller_branch_state = '';
                // $branch->seller_branch_country ='';
                $branch->seller_branch_city = $request->store_branch_city;
                $branch->seller_branch_contact_no = $request->store_mobile_number;
                // $branch->seller_branch_emailid = $request->store_email;
                $branch->seller_id = $store->seller_id;
                $branch->seller_branch_type = $request->store_branch_type;
                $branch->isactive = 1;
                $branch->isdelete = 0;
                if($branch->save()){
                    $user = new Userlogs;
                    $user->form_name = 'Seller Branch';
                    $user->operation_type = 'Update';
                    $user->user_id = 1;
                    $user->description = "Update Seller Branch Name - ". $request->store_branch_name;
                    $user->OS = 'WEB';
                    $user->table_name = 'seller_branch';
                    $user->reference_id = $branch->seller_branch_id;
                    $user->ip_device_id = "000:00:00";
                    $user->user_type_id = 1;
                    $user->save();
                    flash()->success('Store Updated Successfully!');
                    return redirect()->route('store.index');
                }
                
            }
            flash()->error('Please Try Again!');
            return redirect()->route('store.index');
        } catch (\Throwable $th) {
            // dd($th);
            flash()->error('Something went Wrong! Please Try Again!');
            return redirect()->route('store.index');
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
}
