<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierVerification extends Model
{
    use HasFactory;
    protected $table = "supplier_verification";
    protected $guarded = [];

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'user_id');
    }
}
