<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RfqFile extends Model
{
    use HasFactory; 
    protected $table = "buying_request_files";
    protected $guarded = [];

    public function rfq(){
        return $this->belongsTo(Rfq::class,'sub_of');
    }
}
