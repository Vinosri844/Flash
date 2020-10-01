<?php

namespace App\Imports;

use App\SubCategory;
use Maatwebsite\Excel\Concerns\ToModel;

class SubCategoryImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SubCategory([
            'category_id' => $row[0],
            // 'subcategory_name' => $row[1]
        ]);
    }
}
