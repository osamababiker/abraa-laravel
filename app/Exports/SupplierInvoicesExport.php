<?php

namespace App\Exports;

use App\Models\RfqInvoice;
use Maatwebsite\Excel\Concerns\FromCollection;

class SupplierInvoicesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RfqInvoice::all();
    }
}
