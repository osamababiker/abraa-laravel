<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "items_cat";
    protected $guarded = [];

    public function parentCategory(){
        return $this->belongsTo(Category::class,'sub_of');
    }
}
