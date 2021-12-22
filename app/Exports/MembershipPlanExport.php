<?php

namespace App\Exports;

use App\Models\MembershipPlan;
use Maatwebsite\Excel\Concerns\FromCollection;

class MembershipPlanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MembershipPlan::all();
    }
}
