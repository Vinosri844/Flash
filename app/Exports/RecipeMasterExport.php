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
        return RecipeMaster::select('recipe_id', 'recipe_name', 'recipe_type', 'isactive', 'isdelete', 'created_date_time')->get();
    }
    public function headings(): array
    {
        return [
            'Recipe Id',
            'Recipe Name',
            'Recipe Type',
            'Status',
            'Deleted',
            'Created at',
        ];
    }
}
