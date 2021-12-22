<?php

namespace App\Exports;

use App\Models\HomeSlider;
use Maatwebsite\Excel\Concerns\FromCollection;

class HomeSliderExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return HomeSlider::all();
    }
}
