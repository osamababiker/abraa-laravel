<?php

namespace App\Imports;

use App\Models\PaymentOption;
use Maatwebsite\Excel\Concerns\ToModel;

class PaymentOptionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PaymentOption([
            //
        ]);
    }
}
