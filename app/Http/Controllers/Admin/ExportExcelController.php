<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Excel;
use App\RecipeMaster;
use App\Exports\RecipeMasterExport;
use App\Exports\DeliverySlotExport;
use App\Exports\MembershipExport;
use App\Exports\StoreExport;
use App\Exports\ProductPriceExport;
use App\Exports\SellingReportExport;
use App\Exports\SellingInvoiceExport;
use App\Exports\CustomerExport;

class ExportExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function excel_download(Request $request)
    {
        try {
            $model_name = $request->name;
            if($model_name === 'DeliverySlotExport'){
                return Excel::download(new DeliverySlotExport, $request->name.'.xlsx');
            }
            if($model_name === 'MembershipExport'){
                return Excel::download(new MembershipExport, $request->name.'.xlsx');
            }
            if($model_name === 'StoreExport'){
                return Excel::download(new StoreExport, $request->name.'.xlsx');
            }
            if($model_name === 'ProductPriceExport'){
                return Excel::download(new ProductPriceExport, $request->name.'.xlsx');
            }
            if($model_name === 'SellingReportExport'){
                return Excel::download(new SellingReportExport, $request->name.'.xlsx');
            }
            if($model_name === 'SellingInvoiceExport'){
                return Excel::download(new SellingInvoiceExport, $request->name.'.xlsx');
            }
            if($model_name === 'RecipeMasterExport'){
                return Excel::download(new RecipeMasterExport, $request->name.'.xlsx');
            }
            if($model_name === 'CustomerExport'){
                return Excel::download(new CustomerExport, $request->name.'.xlsx');
            }else{
                flash()->error('Something Went Wrong! Please Try Again!');
                return redirect()->route('store.index');
            }
            
        } catch (\Throwable $th) {
            flash()->error('Something Went Wrong! Please Try Again!');
            return redirect()->route('store.index');
        }
       
        

    }

}
