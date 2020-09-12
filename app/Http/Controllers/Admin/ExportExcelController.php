<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Excel;
use App\RecipeMaster;
use App\Exports\RecipeMasterExport;

class ExportExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = new RecipeMasterExport;
        // dd($data);
        return Excel::download(new RecipeMasterExport, 'users.xlsx');
        // return response()->json(["status" => 1]);

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
       try {
        //    dd($request);
        //     $customer_data = DB::table('tbl_customer')->get()->toArray();
            // $customer_array[] = array('Customer Name', 'Address', 'City', 'Postal Code', 'Country');
            // foreach($data as $customer)
            // {
            // $customer_array[] = array(
            // 'Customer Name'  => $customer->CustomerName,
            // 'Address'   => $customer->Address,
            // 'City'    => $customer->City,
            // 'Postal Code'  => $customer->PostalCode,
            // 'Country'   => $customer->Country
            // );
            // }
            // $final_array = $request->data;
            $final_array = RecipeMaster::all();
            // dd($final_array);
            Excel::create('Customer Data', function($excel) use ($final_array){
            $excel->setTitle('Customer Data');
            $excel->sheet('Customer Data', function($sheet) use ($final_array){
            $sheet->fromArray($final_array, null, 'A1', false, false);
            });
            })->download('xlsx');
            return response()->json(["status" => 1]);
       } catch (\Throwable $th) {
           //throw $th;
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
