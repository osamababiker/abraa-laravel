<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "users_store";
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(Supplier::class,'sub_of');
    }

    public function items(){
        return $this->hasMany(Item::class, 'user_id');
    }
}
