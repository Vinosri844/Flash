<?php

namespace App\Http\Controllers\Admin;

use App\CategoryOffer;
use App\Category;
use App\Store;
use App\Userlogs;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_offers = CategoryOffer::where('isdelete', 0)->orderBy('created_date_time', 'desc')->get();
        return view('category_offer.categoryOffer')->with('category_offers', $category_offers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stores = Store::where('isdelete', 0)->orderBy('seller_id', 'desc')->get();
        $categories = Category::where('isdelete', 0)->get();
        return view('category_offer.categoryOfferCreate')->with(['stores' => $stores, 'categories' => $categories]);
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
                'title' => 'required',
            'subtitle' => 'required',
            'seller_id' => 'required',
            'category_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'min_discount' => 'required',
            'max_discount' => 'required',
            'offer_image' => 'required|mimes:jpeg,jpg|max:2000'
        ]);
        if($validator->fails()){
            flash()->error('Please fill the required Fields! and Image should be Jpeg or Jpg (Max-Size: 2.5MB)');
            return redirect()->route('category-offer.create');
        }
        $offer_original_path = "imge/o_227/so22072019/OriginalImage/"; // Company Logo Orignal Image
        $store_title = $request->title;
        $file_name = str_replace(" ", "_", strtolower($store_title));
        $file_path = null;
        if($request->hasFile('offer_image')){
           
            if($request->file('offer_image')->isValid())
            {

                $extension = $request->offer_image->extension();
                $saved_name = $file_name.time()."." .$extension;
                $request->offer_image->move(public_path($offer_original_path), $saved_name);
                $file_path = $saved_name;
            }
        }
        $active = 0;
        if($request->isactive != null){
            $active = 1;
        }
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        // dd($start_date, $request->start_date, $end_date, $request->end_date);
        
            $request->merge([
                'isactive' => $active,
                  'user_id' => 1, 
                  'offer_image' => $file_path,
                  'start_date' => $start_date,
                  'end_date' => $end_date,
                ]);
            $member = CategoryOffer::create($request->input());
        
        if($member){

            flash()->success('Category Offer Created Successfully!');
            return redirect()->route('category-offer.index');
        }
        
        } catch (\Throwable $th) {
            // dd($th);
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('category-offer.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CategoryOffer  $categoryOffer
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryOffer $categoryOffer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CategoryOffer  $categoryOffer
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryOffer $categoryOffer)
    {
        try {
                $category_offer = CategoryOffer::findOrFail($categoryOffer->category_offer_id);
            $stores = Store::where('isdelete', 0)->orderBy('seller_id', 'desc')->get();
            $categories = Category::where('isdelete', 0)->get();
            return view('category_offer.categoryOfferEdit')->with(['stores' => $stores, 'categories' => $categories, 'category_offer' => $category_offer]);
    
        } catch (\Throwable $th) {
            // dd($th);
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('category-offer.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CategoryOffer  $categoryOffer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryOffer $categoryOffer)
    {
        try {
           
            $validator = Validator::make($request->all(), [
            'title' => 'required',
            'subtitle' => 'required',
            'seller_id' => 'required',
            'category_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'min_discount' => 'required',
            'max_discount' => 'required',
            'offer_image' => 'mimes:jpeg,jpg|max:2000'
            
        ]);
        if($validator->fails()){
            flash()->error('Please fill the required Fields! and Image should be Jpeg or Jpg (Max-Size: 2.5MB)');
            return redirect()->route('category-offer.edit', $categoryOffer->category_offer_id);
        }
        $offer_original_path = "imge/o_227/so22072019/OriginalImage/"; // Company Logo Orignal Image
        $store_title = $request->title;
        $file_name = str_replace(" ", "_", strtolower($store_title));
        $file_path = null;
        if($request->hasFile('offer_image')){
           
            if($request->file('offer_image')->isValid())
            {

                $extension = $request->offer_image->extension();
                $saved_name = $file_name.time()."." .$extension;
                $request->offer_image->move(public_path($offer_original_path), $saved_name);
                $file_path = $saved_name;
            }
        }
        $active = 0;
        if($request->isactive != null){
            $active = 1;
        }
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        if($file_path != null){
            $request->merge([
                'isactive' => $active,
                'user_id' => 1, 
                'offer_image' => $file_path,
                'start_date' => $start_date,
                'end_date' => $end_date,
            ]);
        }else{
            $request->merge([
                'isactive' => $active,
                'user_id' => 1, 
                'start_date' => $start_date,
                'end_date' => $end_date,
            ]);
        }
        
       
        $member = CategoryOffer::findOrFail($categoryOffer->category_offer_id);
        $member->update($request->input()); 
        
        
        flash()->success('Category Offer Updated Successfully!');
        return redirect()->route('category-offer.index');
        } catch (\Throwable $th) {
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('category-offer.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategoryOffer  $categoryOffer
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryOffer $categoryOffer)
    {
        try {
           $category_offer = CategoryOffer::findOrFail($categoryOffer->category_offer_id);
           $category_offer->isdelete = 1;
           $category_offer->save();
           flash()->info('Category Offer Deleted Successfully!');
           return redirect()->route('category-offer.index');

       } catch (\Throwable $th) {
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('category-offer.index');
       }
    }
}
