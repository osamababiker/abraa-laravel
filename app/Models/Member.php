<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory; 
    protected $table = "users";
    protected $guarded = [];

    public function member_country(){
        return $this->belongsTo(Country::class, 'country', 'co_code');
    }
}
