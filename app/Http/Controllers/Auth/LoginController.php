<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Hash;
use App\User;
use Validator;
use DB, Auth, Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(){
        return view('login');
    }

    public function login_submit(Request $request)
    { 
        try{
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required'
            ]);
            if($validator->fails()){
                flash()->error('Please fill Username and Password');
                return redirect()->back();
            }
            
            $user = User::where('manager_emailid', $request->username)->first();
                if($user){
                    if(Hash::check($request->password, $user->manager_password)){
                        
                        Auth::login($user);
                        if(Auth::check()){
                            return redirect()->route('category');
                        }
                        
                    }
                    flash()->warning("Incorrect Password");
                    return redirect()->back();
                   
                }
                flash()->warning("User doesn't Exists");
                return redirect()->back();
            }
        Catch(\Exception $e)
        {   flash()->error("Something Went Wrong!");
            DB::rollback();
            return redirect()->route('login')->with('error', $e->getMessage());
        }

    }


    
}
