<?php

namespace App\Exports;

use App\Models\Config;
use Maatwebsite\Excel\Concerns\FromCollection;

class ConfigExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Config::all();
    }
}
