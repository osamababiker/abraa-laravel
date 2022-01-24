<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyingRequestOrderItem extends Model
{
    use HasFactory;
    protected $table = "buyrequest_order_items";
    protected $guarded = []; 

    public function buying_request(){
        return $this->belongsTo(Rfq::class, 'buyrequest_id');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }


}
