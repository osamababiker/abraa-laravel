<?php

namespace App\Imports;

use App\Models\HomeSlider;
use Maatwebsite\Excel\Concerns\ToModel;

class HomeSliderImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new HomeSlider([
            //
        ]);
    }
}
