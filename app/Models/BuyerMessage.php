<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerMessage extends Model
{
    use HasFactory;
    protected $table = "buyer_messages";
    protected $guarded = [];
}
