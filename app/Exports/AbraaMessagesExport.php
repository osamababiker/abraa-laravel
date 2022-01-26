<?php

namespace App\Exports;

use App\Models\AbraaMessage;
use Maatwebsite\Excel\Concerns\FromCollection;

class AbraaMessagesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AbraaMessage::all();
    }
}
