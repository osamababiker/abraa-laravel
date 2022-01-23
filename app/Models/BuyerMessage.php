<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BuyerMessage extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "buyer_messages";
    protected $guarded = [];

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    } 

    public function buyer(){
        return $this->belongsTo(Buyer::class, 'buyer_id');
    }

    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }
}
