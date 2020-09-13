<?php

namespace App\Exports;

use App\InvoiceDetailsData;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SellingInvoiceExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return InvoiceDetailsData::select('invoice_details_id', 'sub_order_number', 'seller_name', 'product_name', 'product_weight_display', 'product_qty', 'product_price')->get();
    }
    public function headings(): array
    {
        return [
            'Id',
            'Order Number',
            'Seller Name',
            'Product Name',
            'Unit',
            'Quantity',
            'Amount',

        ];
    }
}
