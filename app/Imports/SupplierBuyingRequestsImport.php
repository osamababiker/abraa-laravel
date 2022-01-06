<?php

namespace App\Imports;

use App\Models\SupplierBuyingRequest;
use Maatwebsite\Excel\Concerns\ToModel;

class SupplierBuyingRequestsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SupplierBuyingRequest([
            //
        ]);
    }
}
