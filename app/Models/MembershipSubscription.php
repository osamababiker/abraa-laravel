<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class MembershipSubscription extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "membership_subscriptions";
    protected $guarded = [];
}
