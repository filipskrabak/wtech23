<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Models\AttributeValue;
use App\Http\Controllers\Controller;

class DashboardAttributeValueController extends Controller
{
    public function create() {
        $attributes = Attribute::all();

        return view('dashboard.attribute-values.create')->with('attributes', $attributes);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => ['required', 'max:32', 'min:1'],
            'attribute' => ['required']
        ]);

        $attributeValue = new AttributeValue;
        $attributeValue->value = $request->input('name');
        $attributeValue->attribute_id = $request->input('attribute');
        $attributeValue->save();

        return redirect()->route('dashboard.attribute-values.index')->with('message', 'Attribute value created successfully.');
    }

    public function edit(AttributeValue $attributeValue) {
        return view('dashboard.attribute-values.edit')->with('attribute', $attributeValue);
    }

    public function update(Request $request , AttributeValue $attributeValue) {
        $validated = $request->validate([
            'name' => ['required', 'max:32', 'min:1']
        ]);

        $attributeValue->value = $request->input('name');
        $attributeValue->save();

        return redirect()->route('dashboard.attribute-values.index')->with('message', 'Attribute value updated successfully.');

    }

    public function destroy(AttributeValue $attributeValue) {
        $attributeValue->delete();

        return redirect()->route('dashboard.attribute-values.index')->with('message', 'Attribute value deleted successfully.');
    }
}
