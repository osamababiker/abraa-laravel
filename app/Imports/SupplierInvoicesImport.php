<?php

namespace App\Imports;

use App\Models\RfqInvoice;
use Maatwebsite\Excel\Concerns\ToModel;

class SupplierInvoicesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new RfqInvoice([
            //
        ]);
    }
}
