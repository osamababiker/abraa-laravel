<?php

namespace App\Exports;

use App\Models\Shipper;
use Maatwebsite\Excel\Concerns\FromCollection;

class ShippersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Shipper::limit(10)->get();
    }
}
