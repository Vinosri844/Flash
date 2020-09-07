<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Auth, Session;

class CommonController extends Controller
{
    public function change_status(Request $request){
       
        $customer =  DB::table($request->name)->where($request->column, $request->id)->update([$request->field => $request->status]);
       if($customer){
          return response()->json(['status' => 1, 'message' => 'Success']);
       }
       return response()->json(['status' => 0, 'message' => 'Please Refersh and Try Again!']);
    }
}
