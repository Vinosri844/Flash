<?php

namespace App\Imports;

use App\Category;
use Maatwebsite\Excel\Concerns\ToModel;

class CategoryImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new Category([
            
                'category_name' => $row[0],
                'category_description' => $row[1],
                'isactive' => $row[2],
                
           
        ]);
    }
}
