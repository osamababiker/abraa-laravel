<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierBuyingRequest extends Model
{
    use HasFactory;
    protected $table = "buying_request_suppliers";
    protected $guarded = [];

    public function supplier() {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }

    public function buying_request() {
        return $this->belongsTo(Rfq::class,'buying_request_id');
    }
}
