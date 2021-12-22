<?php

namespace App\Imports;

use App\Models\Ads;
use Maatwebsite\Excel\Concerns\ToModel;

class AdsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Ads([
            //
        ]);
    }
}
