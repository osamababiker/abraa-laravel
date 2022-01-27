<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePageBuyer extends Model
{
    use HasFactory;
    protected $table = "homepage_buyers";
    protected $guarded = [];

    public function added_by_admin(){
        return $this->belongsTo(User::class, 'added_by');
    }
}
