<?php

namespace App\Imports;

use App\Models\Pavillion;
use Maatwebsite\Excel\Concerns\ToModel;

class PavillionsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pavillion([
            //
        ]);
    }
}
