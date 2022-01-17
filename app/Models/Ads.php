<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory; 
    use SoftDeletes;
    protected $table = "ads";
    protected $guarded = [];


    public function category(){
        return $this->belongsTo(AdsCategory::class,'sub_of');
    } 

    public function language(){
        return $this->belongsTo(Language::class,'lang', 'code');
    }

    public function user(){
        return $this->belongsTo(User::class,'added_by');
    }
} 
