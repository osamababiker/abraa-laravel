<?php

namespace App\Imports;

use App\Models\Shipping;
use Maatwebsite\Excel\Concerns\ToModel;

class ShippingImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Shipping([
            //
        ]);
    }
}
