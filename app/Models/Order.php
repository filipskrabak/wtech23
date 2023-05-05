<?php

namespace App\Models;

use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = array('status', 'name', 'surname', 'email', 'phone', 'street', 'postcode', 'city', 'country', 'price', 'product_id', 'size', 'pcs');

    public function postcode() {
        return $this->hasOne(Postcode::class);
    }

    public function street() {
        return $this->hasOne(Street::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('pcs', 'size');
    }
}
