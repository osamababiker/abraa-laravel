<?php

namespace App\Imports;

use App\Models\HomeBanner;
use Maatwebsite\Excel\Concerns\ToModel;

class HomeBannerImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new HomeBanner([
            //
        ]);
    }
}
