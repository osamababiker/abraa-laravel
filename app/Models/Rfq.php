<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Rfq extends Model
{
    use HasFactory; 
    use SoftDeletes;
    protected $table = "buying_requests";
    protected $guarded = []; 

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
 
    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id');
    }

}
