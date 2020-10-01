<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\CategoryImport;
use Illuminate\Http\Request;
use Excel;

class ImportExcelController extends Controller
{
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Import\CategoryImport  $categoryImport
     * @return \Illuminate\Http\Response
     */
    public function excel_import(Request $request)
    {
        try {
           $import = Excel::import(new CategoryImport, request()->file('category'));
        //    dd($import);
            return redirect()->back();
        } catch (\Throwable $th) {
            flash()->error('Something Went Wrong !');
            return redirect()->back();
        }
    }
}
