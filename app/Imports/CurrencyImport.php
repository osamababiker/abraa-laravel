<?php

namespace App\Imports;

use App\Models\Currency;
use Maatwebsite\Excel\Concerns\ToModel;

class CurrencyImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Currency([
            //
        ]);
    }
}
