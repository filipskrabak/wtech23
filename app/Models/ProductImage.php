<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductImage extends Model
{
    use HasFactory;

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    protected $fillable = [
        'name',
        'path',
        'alt'
    ];
}
