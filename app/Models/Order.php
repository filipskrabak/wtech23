<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function products(){
        return $this->hasMany(OrderProducts::class);
    }

    public function postcode() {
        return $this->hasOne(Postcode::class);
    }

    public function street() {
        return $this->hasOne(Street::class);
    }
}
