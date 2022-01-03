<?php

namespace App\Exports;

use App\Models\UserActivity;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserActivityExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UserActivity::all();
    }
}
