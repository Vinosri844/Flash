<?php

namespace App\Exports;

use App\Store;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StoreExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Store::select('seller_id', 'seller_name', 'seller_service_tax_number', 'seller_gst_tin_number', 'seller_cst_tin_number', 'seller_fssai_number', 'seller_pan_number', 'isactive', 'isdelete', 'registration_date_time')->get();
    }
    public function headings(): array
    {
        return [
            'Id',
            'Store Name',
            'Service Tax Number',
            'GST No',
            'CST No',
            'FSSAI No',
            'PAN No',
            'Status',
            'Deleted',
            'Created at'
    ];
    }
}
