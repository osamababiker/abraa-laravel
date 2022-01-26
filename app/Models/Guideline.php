<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guideline extends Model
{
    use HasFactory;
    protected $table = "guidelines";
    protected $guarded = []; 

    public function type(){
        return $this->belongsTo(GuidelineType::class, 'guideline_type');
    }
}
