<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class HomeSlider extends Model
{
    use HasFactory;  
    use SoftDeletes;
    protected $table = "home_sliders";
    protected $guarded = [];

    public function language(){
        return $this->belongsTo(Language::class,'region','code');
    }

    public function user(){
        return $this->belongsTo(User::class,'added_by'); 
    }
}
