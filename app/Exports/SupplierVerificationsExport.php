<?php

namespace App\Exports;

use App\Models\SupplierVerification;
use Maatwebsite\Excel\Concerns\FromCollection;

class SupplierVerificationsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SupplierVerification::all();
    }
}
