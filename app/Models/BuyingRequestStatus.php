<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyingRequestStatus extends Model
{
    use HasFactory;
    protected $table = "buying_request_statuses";
    protected $guarded = [];

}
