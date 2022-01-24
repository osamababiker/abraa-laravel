<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "orders";
    protected $guarded = []; 

    public function currency(){ 
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function status(){
        return $this->belongsTo(OrderStatus::class, 'order_status');
    }

    public function user(){
        return $this->belongsTo(Buyer::class, 'user_id');
    }

    public function getPaymentGeteway($code){
        $result = 'Unknown';
        switch ($code) {
            case 0:
                $result = 'Unknown';
                break;
            case 1:
                $result = 'Credit/Debit Card';
                break;
            case 2:
                $result = 'PayPal';
                break;
            case 3:
                $result = 'Outside UAE';
                break;
            case 4:
                $result = 'Bank Transfer';
                break;
            case 5:
                $result = 'Cash On Delivery';
                break;
        }
        return $result;
    }
}
