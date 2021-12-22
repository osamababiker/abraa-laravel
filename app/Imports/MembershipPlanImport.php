<?php

namespace App\Imports;

use App\Models\MembershipPlan;
use Maatwebsite\Excel\Concerns\ToModel;

class MembershipPlanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new MembershipPlan([
            //
        ]);
    }
}
