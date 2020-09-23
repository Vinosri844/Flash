<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Manager;
use Illuminate\Http\Request;
use Validator;
use Hash, Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $user = Manager::where('manager_id', 1)->first();
            return view('profile.profile')->with('user', $user);
        } catch (\Throwable $th) {
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function show(Manager $manager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function edit(Manager $manager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manager $manager)
    {
        try {
            $validator = Validator::make($request->all(), [
                'manager_name' => 'required',
                'manager_emailid' => 'required',
                'manager_mobileno' => 'required'
            ]);
            if($validator->fails()){
                flash()->error('Please fill the required Fields! and Image should be Jpeg or Jpg (Max-Size: 2.5MB)');
                return redirect()->route('manager.index');
            }

            $product_original_path = "imge/"; 
            $recipe_name = $request->manager_name;
            $file_name = str_replace(" ", "_", strtolower($recipe_name));
            $file_path = null;
            if($request->hasFile('manager_image'))
            {
                if($request->file('manager_image')->isValid())
                {
                    $image = $request->manager_image;
                    $extension = $request->manager_image->extension();
                    $saved_name = $file_name.time()."." .$extension;
                    $path = public_path($product_original_path.$saved_name);
                    $upload = Image::make($image->getRealPath())->save($path);
                    $file_path = $saved_name;
                }
            }
          
            $user = Manager::findOrFail($manager->manager_id);
            $user->manager_name = $request->manager_name;
            $user->manager_emailid = $request->manager_emailid;
            $user->manager_mobileno = $request->manager_mobileno;
            if($request->manager_password != null){
                $user->manager_password = md5($request->manager_password . "_Sun@k2u@m!s");
            }
            if($file_path != null){
                $user->manager_image = $file_path;
            }
            if($user->save()){
                $user = user_logs('Manager', 'Update', "Update Manager - ", 'manager', $user->manager_id);
                if($user){
                    flash()->success('Profile Updated Successfully!');
                    return redirect()->route('manager.index');
                }
            }
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('manager.index');
        } catch (\Throwable $th) {
            dd($th);
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('manager.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manager $manager)
    {
        //
    }
}
