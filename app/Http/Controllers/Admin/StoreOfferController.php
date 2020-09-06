<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\StoreOffer;
use App\Store;
use Illuminate\Http\Request;
use Validator;

class StoreOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store_offers = StoreOffer::where('isdelete', 0)->orderBy('created_date_time', 'desc')->get();
        return view('store_offer.storeOffer')->with('store_offers', $store_offers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stores = Store::where('isdelete', 0)->get();
        return view('store_offer.storeOffer_create')->with('stores', $stores);
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
            'seller_ids' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'min_discount' => 'required',
            'max_discount' => 'required',
            'offer_image' => 'required|mimes:jpeg,jpg|max:2000'
        ]);
        if($validator->fails()){
            flash()->error('Please fill all the Fields! and Image should be Jpeg or Jpg (Max-Size: 2.5MB)');
            return redirect()->route('store-offer.create');
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
        foreach ($request->seller_ids as $key => $seller_id) {
            $request->merge([
                'isactive' => $active,
                 'seller_id' => $seller_id,
                  'user_id' => 1, 
                  'offer_image' => $file_path,
                  'start_date' => $start_date,
                  'end_date' => $end_date,
                ]);
            $member = StoreOffer::create($request->input());
        }
        
        
        flash()->success('Store Offer Created Successfully!');
        return redirect()->route('store-offer.index');
        } catch (\Throwable $th) {
            dd($th);
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('store-offer.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StoreOffer  $storeOffer
     * @return \Illuminate\Http\Response
     */
    public function show(StoreOffer $storeOffer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StoreOffer  $storeOffer
     * @return \Illuminate\Http\Response
     */
    public function edit(StoreOffer $storeOffer)
    {
        $store_offer = StoreOffer::findOrFail($storeOffer->store_offer_id);
        $stores = Store::where('isdelete', 0)->get();
        return view('store_offer.storeOffer_edit')->with(['store_offer' => $store_offer, 'stores' => $stores]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StoreOffer  $storeOffer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StoreOffer $storeOffer)
    {
        try {
            // dd($request);
            $validator = Validator::make($request->all(), [
                'title' => 'required',
            'subtitle' => 'required',
            'seller_ids' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'min_discount' => 'required',
            'max_discount' => 'required',
            'offer_image' => 'mimes:jpeg,jpg|max:2000'
            
        ]);
        if($validator->fails()){
            flash()->error('Please fill the required Fields! and Image should be Jpeg or Jpg (Max-Size: 2.5MB)');
            return redirect()->route('store-offer.edit', $storeOffer->store_offer_id);
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
        
       
        $member = StoreOffer::findOrFail($storeOffer->store_offer_id);
        $member->update($request->input()); 
        
        
        flash()->success('Store Offer Updated Successfully!');
        return redirect()->route('store-offer.index');
        } catch (\Throwable $th) {
            
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('store-offer.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StoreOffer  $storeOffer
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreOffer $storeOffer)
    {
       try {
           $store_offer = StoreOffer::findOrFail($storeOffer->store_offer_id);
           $store_offer->isdelete = 1;
           $store_offer->save();
           flash()->info('Store Offer Deleted Successfully!');
           return redirect()->route('store-offer.index');

       } catch (\Throwable $th) {
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('store-offer.create');
       }
    }
}
