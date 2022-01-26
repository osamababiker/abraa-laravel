<?php

namespace App\Imports;

use App\Models\AbraaMessage;
use Maatwebsite\Excel\Concerns\ToModel;

class AbraaMessagesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AbraaMessage([
            //
        ]);
    }
}
