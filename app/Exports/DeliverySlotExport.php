<?php

namespace App\Exports;

use App\DeliverySlotMaster;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DeliverySlotExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DeliverySlotMaster::select('delivery_slot_id', 'from_time', 'to_time', 'isActive', 'created_date_time')->get();
    }
    public function headings(): array
    {
        return [
            'Id',
            'From Time',
            'To Time',
            'status',
            'Created at'
        ];
    }
}
