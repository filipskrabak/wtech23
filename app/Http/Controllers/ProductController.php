<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Models\AttributeValue;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;

class ProductController extends Controller
{
    // Get and show all products
    public function index(Request $request) {
        $products = Product::with('attribute_values');
        $attrSlugs = Attribute::pluck('id', 'slug');
 
        $data = $request->all();

        foreach ($data as $key => $value) {
            foreach ($attrSlugs as $attrkey => $slug) {
                if($attrkey == $key){
                    $attr = AttributeValue::where('value', $value)->firstOrFail();
                    $attrId = $attr->id;
                    
                    $products = $products->whereHas('attribute_values', function($q) use($attrId) {
                        $q->where('attribute_value_id', $attrId);
                    });
                }
            }
        }

        return view('products.index', [
            'products' => $products->paginate(10)
        ]);
    }

    // Show single product
    public function show(Product $product) {
        $images = $product->images;


        return view('products.show', [
            'product' => $product
        ])->with('images', $images);
    }
}
