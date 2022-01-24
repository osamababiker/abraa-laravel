<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = "order_items";
    protected $guarded = []; 

    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }
}
