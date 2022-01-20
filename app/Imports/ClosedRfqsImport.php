<?php

namespace App\Imports;

use App\Models\Rfq;
use Maatwebsite\Excel\Concerns\ToModel;

class ClosedRfqsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Rfq([
            //
        ]);
    }
}
