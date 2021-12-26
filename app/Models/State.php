<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "countries_states";
    protected $guarded = [];  

    public function country(){
        return $this->belongsTo(Country::class, 'sub_of');
    } 
}
