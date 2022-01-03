<?php

namespace App\Exports;

use App\Models\UserLevel;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserLevelExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UserLevel::all();
    }
}
