<?php

namespace App\Models;

use App\Models\AttributeValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public function images() {
        return $this->hasMany(ProductImage::class);
    }

    public function attribute_values() {
        return $this->belongsToMany(AttributeValue::class);
    }
}
