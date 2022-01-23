<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory; 
    use SoftDeletes;
    protected $table = "shippers";
    protected $guarded = [];


    public function shipper() {
        return $this->belongsTo(Shipper::class,'sub_of');
    }

    public function shipping_from_country() {
        return $this->belongsTo(Country::class,'shipping_from', 'co_code');
    }

    public function shipping_to_country() {
        return $this->belongsTo(Country::class,'shipping_to');
    }
}
