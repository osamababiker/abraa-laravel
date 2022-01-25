<?php

namespace App\Imports;

use App\Models\EmailArchive;
use Maatwebsite\Excel\Concerns\ToModel;

class EmailArchivesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new EmailArchive([
            //
        ]);
    }
}
