<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class AbandonedRfq extends Model
{
    use HasFactory; 
    use SoftDeletes;
    protected $table = "abandoned_rfq"; 
    protected $guarded = []; 

    public function item(){ 
        return $this->belongsTo(Item::class,'item_id');
    }

    public function buyer(){
        return $this->belongsTo(AbandonedRegisteration::class,'buyer_id');
    }

    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id');
    }

}
