<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class AdsCategory extends Model
{
    use HasFactory; 
    use SoftDeletes;
    protected $table = "ads_cat";
    protected $guarded = [];


    public function category(){
        return $this->belongsTo(Category::class,'cat_id');
    }
}
