<?php

namespace App\Exports;

use App\Models\SupplierBuyingRequest;
use Maatwebsite\Excel\Concerns\FromCollection;

class SupplierBuyingRequestsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SupplierBuyingRequest::all();
    }
}
