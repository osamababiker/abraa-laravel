<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class MembershipTransaction extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "membership_transactions";
    protected $guarded = []; 

    public function user(){
        return $this->belongsTo(SiteUser::class, 'user_id');
    }

    public function plan(){
        return $this->belongsTo(MembershipPlan::class, 'plan_id', 'code');
    }
}
