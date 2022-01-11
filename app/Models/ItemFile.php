<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemFile extends Model
{
    use HasFactory;
    protected $table = "items_files";
    protected $guarded = [];

    public function item(){
        return $this->belongsTo(Item::class,'sub_of');
    }
}
