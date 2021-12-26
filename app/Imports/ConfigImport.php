<?php

namespace App\Imports;

use App\Models\Config;
use Maatwebsite\Excel\Concerns\ToModel;

class ConfigImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Config([
            //
        ]);
    }
}
