<?php

namespace App\Exports;

use App\Models\PaymentOption;
use Maatwebsite\Excel\Concerns\FromCollection;

class PaymentOptionExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PaymentOption::all();
    }
}
