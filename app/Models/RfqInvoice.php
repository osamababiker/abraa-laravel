<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class RfqInvoice extends Model
{
    use HasFactory; 
    use SoftDeletes;
    protected $table = "buying_request_invoices";
    protected $guarded = []; 

 
    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
 
    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id');
    }

    public function currency(){
        return $this->belongsTo(Currency::class,'currency_id');
    }

    public function buying_request()
    {
        return $this->belongsTo(Rfq::class, 'buying_request_id');
    }

}
