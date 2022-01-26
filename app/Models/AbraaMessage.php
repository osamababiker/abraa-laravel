<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbraaMessage extends Model
{
    use HasFactory; 
    protected $table = "dlist_messages";
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(Member::class, 'user_id');
    }

    public function sender(){
        return $this->belongsTo(User::class, 'sent_by');
    }
}
