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

    public function item_unit(){
        return $this->belongsTo(Unit::class,'unit');
    }

    public function item_currency(){
        return $this->belongsTo(Currency::class,'currency');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'user_id');
    }
}
