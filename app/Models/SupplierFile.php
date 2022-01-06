<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierFile extends Model
{
    use HasFactory;
    protected $table = "users_files";
    protected $guarded = [];

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'sub_of');
    }
}
