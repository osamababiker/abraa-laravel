<?php

namespace App\Exports;

use App\Models\Translation;
use Maatwebsite\Excel\Concerns\FromCollection;

class TranslationExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Translation::all();
    }
}
