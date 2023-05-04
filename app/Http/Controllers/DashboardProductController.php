<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Attribute;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\AttributeValue;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Collection;

class DashboardProductController extends Controller
{

    // Create new product view
    public function create() {
        // Get the attribute values
        $genders = Attribute::getAttributeValuesBySlug('gender');
        $categories = Attribute::getAttributeValuesBySlug('category');
        $sizes = Attribute::getAttributeValuesBySlug('size');
        $colors = Attribute::getAttributeValuesBySlug('color');


        return view('dashboard.products.create')->with('genders', $genders)->with('categories', $categories)->with('sizes', $sizes)->with('colors', $colors);
    }

    // Store new product
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => ['required', 'max:32', 'min:1'],
            'gender' => ['required'],
            'category' => ['required'],
            'color' => ['required'],
            'size' => ['required', 'array'],
            'slug' => ['required', 'max:32', 'min:1', 'unique:products'],
            'price' => ['required', 'numeric', 'min:0.01', 'max:9999.99'],
            'description' => ['required', 'max:512', 'min:1'],
        ]);

        // Get images from session
        $images = $request->session()->get('images');

        // If image session is empty, return back with error
        if(empty($images)) {
            return back()->withErrors(['image' => 'Please upload at least one image.'])->withInput($request->input());
        }

        $product = new Product;
        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->save();

        // Attach the attribute values
        $allAttributes = array();

        $allAttributes = array_merge($allAttributes, request('size'));
        array_push($allAttributes, request('color'));
        array_push($allAttributes, request('gender'));
        array_push($allAttributes, request('category'));

        $product->attribute_values()->attach($allAttributes);

        // Attach the images
        foreach ($images as $image) {
            $product->images()->create([
                'name' => $image,
                'path' => 'img/upload',
                'alt' => $image
            ]);
        }

        // Clear the session
        $request->session()->forget('images');

        return redirect('/product/' . $product->slug);
    }

    public function update(Request $request, Product $product) {
        $validated = $request->validate([
            'name' => ['required', 'max:32', 'min:1'],
            'gender' => ['required'],
            'category' => ['required'],
            'color' => ['required'],
            'size' => ['required', 'array'],
            'slug' => ['required', 'max:32', 'min:1', Rule::unique('products')->ignore($request->get("slug"),'slug')],
            'price' => ['required', 'numeric', 'min:0.01', 'max:9999.99'],
            'description' => ['required', 'max:512', 'min:1'],
        ]);

        // Delete all attribute values
        $product->attribute_values()->detach();

        // Attach the attribute values
        $allAttributes = array();

        $allAttributes = array_merge($allAttributes, request('size'));
        array_push($allAttributes, request('color'));
        array_push($allAttributes, request('gender'));
        array_push($allAttributes, request('category'));

        $product->attribute_values()->attach($allAttributes);

        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->save();

        return redirect('/product/' . $product->slug);
    }

    public function edit(Product $product) {
        $images = $product->images;

        // Get the attribute values
        $genders = Attribute::getAttributeValuesBySlug('gender');
        $categories = Attribute::getAttributeValuesBySlug('category');
        $sizes = Attribute::getAttributeValuesBySlug('size');
        $colors = Attribute::getAttributeValuesBySlug('color');

        return view('dashboard.products.edit')
            ->with('product', $product)
            ->with('genders', $genders)
            ->with('categories', $categories)
            ->with('sizes', $sizes)
            ->with('colors', $colors)
            ->with('images', $images);
    }

    public function destroy(Product $product) {
        // Delete all images
        $images = $product->images;

        foreach ($images as $image) {
            // delete image from public folder
            File::delete(public_path($image->path . '/' . $image->name));
            $image->delete();
        }

        $product->delete();

        return redirect('/dashboard/products')
            ->with('message','Product has been deleted.');
    }

    public function storeImage(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imageName = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME).'-'.time().'.'.$request->image->extension();

        $request->image->move(public_path('img/upload'), $imageName);

        $request->session()->push('images', $imageName);

        return back()
            ->with('message','Image has been uploaded.');
    }

    public function destroyImage(Request $request) {
        $imageName = $request->input('image');

        $images = $request->session()->get('images');

        // unset by image name in value
        if (($key = array_search($imageName, $images)) !== false) {
            unset($images[$key]);
        }

        $request->session()->put('images', $images); // Set the array again


        // delete image from public folder
        File::delete(public_path('img/upload/' . $imageName));

        return back()
            ->with('message','Image has been deleted.');
    }

    public function storeImageDb(Request $request, Product $product) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imageName = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME).'-'.time().'.'.$request->image->extension();

        $request->image->move(public_path('img/upload'), $imageName);

        $product->images()->create([
            'name' => $imageName,
            'path' => 'img/upload',
            'alt' => $imageName
        ]);

        return back()
            ->with('message','Image has been uploaded.');
    }

    public function destroyImageDb(Request $request, ProductImage $image) {
        // delete image from public folder
        File::delete(public_path('img/upload/' . $image->name));

        $image->delete();

        return back()
            ->with('message','Image has been deleted.');
    }
}
