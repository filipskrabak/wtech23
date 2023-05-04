<?php

namespace App\Models;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = array('name', 'description', 'price', 'category_id', 'brand_id', 'image');

    public function images() {
        return $this->hasMany(ProductImage::class);
    }

    public function attribute_values() {
        return $this->belongsToMany(AttributeValue::class);
    }
    public function orders(){
        return $this->belongsToMany(Order::class)->withPivot('pcs', 'size');
    }

    // Get first attribute value by attribute name of the product
    public function getAttributeValueByName($attributeName, $single = true)
    {
        // Retrieve the attribute by its name
        $attribute = Attribute::where('name', $attributeName)->first();

        // Does not exist
        if (!$attribute) {
            return null;
        }

        // Retrieve the attribute value by its attribute id

        if($single)
            $attributeValue = $this->attribute_values()->where('attribute_id', $attribute->id)->first();
        else {
            $attributeValue = $this->attribute_values()->where('attribute_id', $attribute->id)->get();

            // Filter above collection to only contain the attribute value name
            $attributeValue = $attributeValue->map(function ($item) {
                return $item->value;
            });
        }

        // Does not exist
        if (!$attributeValue) {
            return null;
        }

        return $attributeValue;
    }
}
