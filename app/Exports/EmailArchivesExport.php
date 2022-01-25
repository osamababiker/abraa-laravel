<?php

namespace App\Exports;

use App\Models\EmailArchive;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmailArchivesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return EmailArchive::all();
    }
}
