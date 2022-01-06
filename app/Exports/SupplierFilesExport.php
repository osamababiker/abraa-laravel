<?php

namespace App\Exports;

use App\Models\SupplierFile;
use Maatwebsite\Excel\Concerns\FromCollection;

class SupplierFilesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SupplierFile::all();
    }
}
