<?php

namespace App\Imports;

use App\Models\SupplierVerification;
use Maatwebsite\Excel\Concerns\ToModel;

class SuppliersVerificationImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SupplierVerification([
            //
        ]);
    }
}
