<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        return view('product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'product_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric|min:1',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $filePath = $request->file('photo')->store('products', 'public'); // Save in 'storage/app/public/products'
            $validate['photo'] = $filePath; // Save the file path in the database
        }

        Product::create($validate);
        return redirect()->route('product.index')->with('success', 'Product Added Successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'product_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric|min:1',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($product->photo && \Storage::disk('public')->exists($product->photo)) {
                \Storage::disk('public')->delete($product->photo);
            }

            $filePath = $request->file('photo')->store('products', 'public');
            $validate['photo'] = $filePath;
        }

        $product->update($validate);
        return redirect()->route('product.index')->with('success', 'Product Updated Successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product Removed Successfuly!');
    }
}
