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
    public function index(Request $request, $searchProducts = null) {
        $products = $searchProducts == null ? Product::with('attribute_values') : $searchProducts;

        $attrSlugs = Attribute::pluck('id', 'slug');

        $data = $request->all();

        // Map attributes to get parameters
        foreach ($data as $key => $value) {
            foreach ($attrSlugs as $attrkey => $slug) {
                if($attrkey == $key){

                    // Skip non-filtered
                    if($value == "Any") {
                        continue;
                    }

                    $attr = AttributeValue::where('value', $value)->firstOrFail();
                    $attrId = $attr->id;

                    $products = $products->whereHas('attribute_values', function($q) use($attrId) {
                        $q->where('attribute_value_id', $attrId);
                    });
                }
            }
        }

        // Get the attribute values
        $genders = Attribute::getAttributeValuesBySlug('gender');
        $categories = Attribute::getAttributeValuesBySlug('category');
        $sizes = Attribute::getAttributeValuesBySlug('size');
        $colors = Attribute::getAttributeValuesBySlug('color');

        // for "old" to work
        if($request->hasSession())
            $request->flash();

        // Price constraints
        $priceFrom = $request->input('price-from');
        $priceTo = $request->input('price-to');


        if($priceFrom != null) {
            $products = $products->where('price', '>=', $priceFrom);
        }
        if($priceTo != null) {
            $products = $products->where('price', '<=', $priceTo);
        }

        // Ordering

        $order = $request->input('order');

        if($order != null) {
            if($order == "newest") {
                $products = $products->orderBy('created_at', 'desc');
            }
            if($order == "oldest") {
                $products = $products->orderBy('created_at');
            }
            if($order == "lowest-price") {
                $products = $products->orderBy('price');
            }
            if($order == "highest-price") {
                $products = $products->orderBy('price', 'desc');
            }
        }

        return view('products.index', [
            'products' => $products->paginate(10)
        ])->with('genders', $genders)->with('categories', $categories)->with('sizes', $sizes)->with('colors', $colors);
    }

    public function search(Request $request) {
        $search = $request->get('search');

        return $this->index(new Request([]), Product::query()->whereFullText(['name', 'description'], $search));
    }

    // Show single product
    public function show(Product $product) {
        $images = $product->images;
        $allAttributes = $product->attribute_values;

        $sizeAttributes = $allAttributes->filter(function($attribute) {
            return $attribute->attribute->name === 'Size';
        });

        return view('products.show', [
            'product' => $product
        ])->with('images', $images)->with('sizes', $sizeAttributes);
    }
}
