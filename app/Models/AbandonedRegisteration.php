<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbandonedRegisteration extends Model
{
    use HasFactory; 
    protected $table = "abandoned_registerations"; 
    protected $guarded = []; 

}
