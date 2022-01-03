<?php

namespace App\Imports;

use App\Models\UserLevel;
use Maatwebsite\Excel\Concerns\ToModel;

class UserLevelImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new UserLevel([
            //
        ]);
    }
}
