<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Hash;
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

    public function loginSubmit(Request $request)
    { 
        try{

            if($request->isMethod('post'))
            {
                $validator = Validator::make($request->input(), [
                    'username' => 'required',
                    'password' => 'required'
                ]);
                
                // if form validation errors
                if ($validator->fails()) {
                    return redirect()->route('login')
                                ->withErrors($validator)
                                ->withInput();
                }
            
                $username = $request->input('username');
                $password = $request->input('password'); 

                $user = DB::table('manager')->Where('manager_emailid', '=', $username)->first(); //dd($user->manager_password);
               
                if(!empty($user))
                { 
                       //dd(Hash::check($password, $user->manager_password));

                        if (!Hash::check($password, $user->manager_password))
                        { 
                            flash()->success('User logged in Successfully!');
                            return redirect()->route('category');
                            
                        }
                        else{
                            flash()->success('Password is incorrect!');
                            return redirect()->route('login');
                        }
                   
                }
                else{
                    flash()->success('Account does not exists!');
                    return redirect()->route('login');
                }
            }
            else{
                flash()->success('Invalid Method!');
                return redirect()->route('login');
            }
        }
        Catch(\Exception $e)
        { dd($e);
            DB::rollback();
            return redirect()->route('login')->with('error', $e->getMessage());
        }

    }


    public function logout(Request $request) {
        if(Auth::check()) {
			$user_data = User::find(Auth::user()->user_id);
			//$user_data->user_last_login_on = 0;
			$user_data->save();
            Session::flush();
            Auth::logout();
        }
        return redirect()->route('login');
    }
}
