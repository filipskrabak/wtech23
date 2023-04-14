<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Postcode extends Model
{
    use HasFactory;

    public function disctrict(){
        return $this->belongsTo(District::class);
    }
}
