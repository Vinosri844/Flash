<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\CategoryImport;
use App\Imports\SubCategoryImport;
use Illuminate\Http\Request;
use Excel;
// use Input;
use App\Category;

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
            $modal_name = $request->name;
            if($modal_name == 'CategoryImport'){
                $import = Excel::import(new CategoryImport, request()->file('category'));
               
            }
            if($modal_name == 'SubCategoryImport'){
                $import = Excel::import(new SubCategoryImport, request()->file('sub_category'));
            }
            flash()->success('Excel Datas Created Successfully !');
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
            flash()->error('Something Went Wrong !');
            return redirect()->back();
        }
    }
}
