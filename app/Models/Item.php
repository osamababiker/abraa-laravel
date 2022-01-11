<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory; 
    use SoftDeletes;
    protected $table = "items";
    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class,'sub_of');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'user_id');
    }
}
