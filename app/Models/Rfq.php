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

    public function country(){
        return $this->belongsTo(Country::class,'country_code','co_code');
    }
   
 
    public function buyer(){ 
        return $this->belongsTo(Buyer::class,'buyer_id');
    }

    public function item(){ 
        return $this->belongsTo(Item::class,'item_id');
    }

    public function approved_by_admin(){
        return $this->belongsTo(User::class,'approved_by','id');
    }
 
    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id');
    }

    public function buying_frequency(){
        return $this->belongsTo(BuyingFrequency::class,'buying_frequency_id');
    }

}
