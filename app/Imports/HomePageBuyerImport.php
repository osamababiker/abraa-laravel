<?php

namespace App\Imports;

use App\Models\HomePageBuyer;
use Maatwebsite\Excel\Concerns\ToModel;

class HomePageBuyerImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new HomePageBuyer([
            //
        ]);
    }
}
