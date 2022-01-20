<?php

namespace App\Exports;

use App\Models\AbandonedRfq;
use Maatwebsite\Excel\Concerns\FromCollection;

class AbandonedRfqsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AbandonedRfq::all();
    }
}
