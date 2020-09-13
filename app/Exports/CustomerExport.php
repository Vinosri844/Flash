<?php

namespace App\Exports;

use App\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customer::select('customer_id', 'customer_name', 'customer_contact_no', 'customer_emailid', 'customer_gender', 'customer_birthdate', 'customer_profession', 'customer_marital_status', 'isactive', 'isverified', 'isdelete', 'create_date_time')->get();
    }
    public function headings(): array
    {
        return [
            'Id',
            'Customer Name',
            'Contact Number',
            'Email Id',
            'Gender',
            'Birth Date',
            'Profession',
            'Marital Status',
            'status',
            'verified',
            'Deleted',
            'Registration Date'
        ];
    }
}
