<?php

namespace App\Exports;

use App\Models\Shipping;
use Maatwebsite\Excel\Concerns\FromCollection;

class ShippingExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Shipping::all();
    }
}
