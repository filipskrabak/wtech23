<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    public function attribute_values() {
        return $this->hasMany(AttributeValue::class);
    }

    static public function getAttributeValuesBySlug($attributeSlug)
    {
        // Retrieve the attribute by its slug
        $attribute = Attribute::where('slug', $attributeSlug)->first();

        if (!$attribute) {
            // If the attribute doesn't exist, return an empty array
            return [];
        }

        $attributeValues = $attribute->attribute_values;

        return $attributeValues;
    }
}
