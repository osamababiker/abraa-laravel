<?php

namespace App\Exports;

use App\Models\Pavillion;
use Maatwebsite\Excel\Concerns\FromCollection;

class PavillionsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pavillion::all();
    }
}
