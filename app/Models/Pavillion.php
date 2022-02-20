<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pavillion extends Model
{
    use HasFactory;
    protected $table = "pavillions";
    protected $guarded = [];  

    public function suppliers(){
        return $this->hasMany(Supplier::class, 'pavillion_id');
    } 
}
