<?php

namespace App\Exports;

use App\Membership;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MembershipExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Membership::select('membership_id', 'initial_amount', 'current_amount', 'validity', 'order_amount', 'cashback_amount', 'isactive', 'created_date_time')->get();
    }
    public function headings(): array
    {
        return [
            'Id',
            'Initial Amount',
            'Current_Amount',
            'Validity',
            'Min Order Amount',
            'Cashback Amount',
            'Status',
            'Created at'
        ];
    }
}
