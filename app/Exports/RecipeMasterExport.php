<?php

namespace App\Exports;

use App\RecipeMaster;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RecipeMasterExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RecipeMaster::all();
    }
    public function headings(): array
    {
        return [
            'Recipe Id',
            'Description',
            'Pos',
            'Mod A',
            'Mod B',
            'Charge',
        ];
    }
}
