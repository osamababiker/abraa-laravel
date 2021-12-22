<?php

namespace App\Exports;

use App\Models\AdsCategory;
use Maatwebsite\Excel\Concerns\FromCollection;

class AdsCategoryExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AdsCategory::all();
    }
}
