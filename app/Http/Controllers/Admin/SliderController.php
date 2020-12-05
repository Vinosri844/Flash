<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\ProductMaster;
use App\SellerMaster;
use App\Slider;
use App\Store;
use App\SubCategory;
use CommonLib, CommonHelper, Image, File, Carbon, DB, Validator;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::with('category')->where('isactive', 1)->orderBy('slider_id', 'desc')->get();
        // dd($stores);
        $slider_position = config('constants.slider_position');
        $homeslider_position = config('constants.home_slider_positions');
        foreach ($sliders as $slider){
                $slider->slider_name = $slider_position[$slider->slider_position];
                $slider->homeslider_name = $homeslider_position[$slider->web_home_slider_position];
                $slider->category_name = isset($slider->category[0]) ? $slider->category[0]->category_name : "";
        }
        return view('slider.slider')->with('sliders', $sliders);
    }

    public function slider_create(Request $request){
        try{
            if($request->isMethod('post')){
                DB::beginTransaction();
                $slider = new Slider();
                $slider->OS = $request->os_type;
                $slider->web_home_slider_position = $request->homeslider_position ?? 0;
                $slider->slider_position = $request->slider_position;
                $slider->link = $request->link;
                $slider->category_id = $request->category_id ?? 0;
                $slider->isactive = $request->isactive = 'on' ? 1 : 0;
                if($request->hasFile('slider_image')) {
                    $photo = $request->file('slider_image');
                    if(isset($photo) && !empty($photo) && $photo->isValid()) {
                        $rules = array('photo' => 'required|mimes:png,jpg,jpeg');
                        $validator = Validator::make(array('photo'=> $photo), $rules);
                        if($validator->passes()) {
                            $file_name = preg_replace('/[^a-zA-Z0-9]/', '_', "Slider").'_'.time().'.'.$photo->getClientOriginalExtension();
                            $file_path = (config('constants.product_img_path').$file_name);
                            $file_path1 = (config('constants.product_img_path1').$file_name);
                            $file_path2 = (config('constants.product_img_path2').$file_name);

                            $save_photo = Image::make($photo->getRealPath())->save($file_path);
                            $save_photo = Image::make($photo->getRealPath())->save($file_path2);
                            // Resize Image
                            $save_photo = Image::make($photo->getRealPath())->resize(config('constants.image_width'), config('constants.image_height'))->save($file_path1);

                            $slider->slider_image = $file_name;
                        }
                    }
                }

                $slider->save();
                DB::commit();
                flash()->success('Slider Created Successfully!');
                return redirect()->route('sliders');


            }else{
                $data['category'] = Category::orderBy('category_id', 'desc')->get();
                $data['slider_position'] = config('constants.slider_position');
                $data['homeslider_position'] = config('constants.home_slider_position');
                return view('slider.slider_create', $data ?? NULL);
            }
        }catch(\Exception $exception){
           // dd($exception);
            DB::rollback();
            return redirect()->route('sliders')->with('error', $exception->getMessage());
        }
    }


    public function slider_edit(Request $request, $slider_id){
        try{
           // dd($slider_id);
            if($request->isMethod('post')){
                DB::beginTransaction();
                $slider = Slider::find($slider_id);
               // dd($slider);
                $slider->OS = $request->os_type;
                $slider->web_home_slider_position = $request->homeslider_position ?? $slider->web_home_slider_position;
                $slider->slider_position = $request->slider_position ??  $slider->slider_position;
                $slider->link = $request->link;
                $slider->category_id = $request->category_id ?? 0;
                $slider->isactive = $request->isactive = 'on' ? 1 : 0;
                if($request->hasFile('slider_image')) {
                    $photo = $request->file('slider_image');
                    if(isset($photo) && !empty($photo) && $photo->isValid()) {
                        $rules = array('photo' => 'required|mimes:png,jpg,jpeg');
                        $validator = Validator::make(array('photo'=> $photo), $rules);
                        if($validator->passes()) {
                            $file_name = preg_replace('/[^a-zA-Z0-9]/', '_', "Slider").'_'.time().'.'.$photo->getClientOriginalExtension();
                            $file_path = (config('constants.product_img_path').$file_name);
                            $file_path1 = (config('constants.product_img_path1').$file_name);
                            $file_path2 = (config('constants.product_img_path2').$file_name);

                            $save_photo = Image::make($photo->getRealPath())->save($file_path);
                            $save_photo = Image::make($photo->getRealPath())->save($file_path2);
                            // Resize Image
                            $save_photo = Image::make($photo->getRealPath())->resize(config('constants.image_width'), config('constants.image_height'))->save($file_path1);

                            $slider->slider_image = $file_name;
                        }
                    }
                }

                $slider->save();
                DB::commit();
                flash()->success('Slider Updated Successfully!');
                return redirect()->route('sliders');


            }else{
                $data['category'] = Category::orderBy('category_id', 'desc')->get();
                $data['slider_position'] = config('constants.slider_position');
                $data['homeslider_position'] = config('constants.home_slider_position');
                $data['slider'] = Slider::find($slider_id);
                return view('slider.slider_edit', $data ?? NULL);
            }
        }catch(\Exception $exception){
          //  dd($exception);
            DB::rollback();
            return redirect()->route('sliders')->with('error', $exception->getMessage());
        }
    }

    public function slider_delete($id)
    {
        $data = Slider::find($id);
        if($data->delete()){
            flash()->success('Slider Deleted Successfully!');
            return redirect()->route('sliders');
        }else{
            flash()->error('Please Try Again!');
            return redirect()->route('sliders');
        }


    }
}
