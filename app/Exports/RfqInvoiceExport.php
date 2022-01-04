<?php

namespace App\Exports;

use App\Models\RfqInvoice;
use Maatwebsite\Excel\Concerns\FromCollection;

class RfqInvoiceExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RfqInvoice::all();
    }
}
