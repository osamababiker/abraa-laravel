<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory; 
    protected $table = "user_activity";
    protected $guarded = [];

    public function user_country(){
        return $this->belongsTo(Country::class, 'user_country', 'co_code');
    }

    public function user(){
        return $this->belongsTo(Member::class,'user_id');
    }
} 
