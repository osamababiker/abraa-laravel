<?php

namespace App\Exports;

use App\Models\HomePageBuyer;
use Maatwebsite\Excel\Concerns\FromCollection;

class HomePageBuyerExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return HomePageBuyer::all();
    }
}
