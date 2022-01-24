<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyingFrequency extends Model
{
    use HasFactory;
    protected $table = "buying_frequencies";
    protected $guarded = [];
}
