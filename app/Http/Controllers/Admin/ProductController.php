<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.index');
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        $brands = Brand::select('id', 'name')->get();
        return view('admin.product.create', compact('categories', 'brands'));
    }

    public function store(ProductFormRequest $request)
    {
        $validatedData = $request->validated();
        $category = Category::findOrFail($validatedData['category_id']);
        $product = $category->products()->create([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'slug' => $validatedData['slug'],
            'brand' => $validatedData['brand'],
            'small_description' => $validatedData['small_description'],
            'description' => $validatedData['description'],
            'original_price' => $validatedData['original_price'],
            'selling_price' => $validatedData['selling_price'],
            'quantity' => $validatedData['quantity'],
            'trending' => $request->trending == true ? '1' : '0',
            'status' => $request->status == true ? '1' : '0',
            'meta_title' => $validatedData['meta_title'],
            'meta_keyword' => $validatedData['meta_keyword'],
            'meta_description' => $validatedData['meta_description'],
        ]);

        if ($request->hasFile('image')) {
            $path = 'uploads/products/';
            foreach ($request->file('image') as $imageFile) {
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $imageFile->move($path, $filename);
                $finalImagePathName = $path . '' . $filename;
                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName
                ]);
            }
        }

        return redirect()->route('product.index')->with('message', 'Product has been added successfully');
    }
}
