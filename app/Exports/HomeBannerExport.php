<?php

namespace App\Exports;

use App\Models\HomeBanner;
use Maatwebsite\Excel\Concerns\FromCollection;

class HomeBannerExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return HomeBanner::all();
    }
}
