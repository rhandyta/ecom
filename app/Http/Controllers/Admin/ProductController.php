<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->orderBy('id', 'DESC')
            ->paginate(50);
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        $brands = Brand::select('id', 'name')->get();
        $colors = Color::where('status', '=', 0)->get();
        return view('admin.product.create', compact('categories', 'brands', 'colors'));
    }

    public function store(ProductFormRequest $request)
    {
        $validatedData = $request->validated();
        $category = Category::findOrFail($validatedData['category_id']);
        $product = $category->products()->create([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'slug' => \Str::slug($validatedData['slug']),
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
                $filename = time() . \Str::random(5) . '.' . $extension;
                $imageFile->move($path, $filename);
                $finalImagePathName = $path . '' . $filename;
                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName
                ]);
            }
        }
        if ($request->colors) {
            foreach ($request->colors as $key => $color) {
                $product->productColors()->create([
                    'product_id' => $product->id,
                    'color_id' => $color,
                    'quantity' => $request->colorquantity[$key] ?? 0
                ]);
            }
        }

        return redirect()->route('product.index')->with('message', 'Product has been added successfully');
    }

    public function edit(int $product_id)
    {
        $product = Product::findOrFail($product_id);
        $categories = Category::all();
        $brands = Brand::all();
        $productColors = $product->ProductColors->pluck('color_id')->toArray();
        $colors = Color::whereNotIn('id', $productColors)->get();
        return view('admin.product.edit', compact('product', 'categories', 'brands', 'colors', 'productColors'));
    }

    public function update(ProductFormRequest $request, $product_id)
    {
        $validatedData = $request->validated();
        $product = Category::findOrFail($validatedData['category_id'])
            ->products()->where('id', $product_id)->first();
        if (!$product) {
            return redirect()->route('message', 'No such product found');
        }
        $product->update([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'slug' => \Str::slug($validatedData['slug']),
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
                $filename = time() . \Str::random(5) . '.' . $extension;
                $imageFile->move($path, $filename);
                $finalImagePathName = $path . '' . $filename;
                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName
                ]);
            }
        }
        if ($request->colors) {
            foreach ($request->colors as $key => $color) {
                $product->productColors()->create([
                    'product_id' => $product->id,
                    'color_id' => $color,
                    'quantity' => $request->colorquantity[$key] ?? 0
                ]);
            }
        }
        return redirect()->route('product.index')->with('message', 'Product has been updated successfully');
    }

    public function destroyImage(int $id)
    {
        $imageProduct = ProductImage::findOrFail($id);
        if (File::exists($imageProduct->image)) {
            File::delete($imageProduct->image);
        }
        $imageProduct->delete();
        return redirect()->back()->with('message', 'Product image has been deleted successfully');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->productImages) {
            foreach ($product->ProductImages as $image) {
                if (File::exists($image->image))
                    File::delete($image->image);
            }
        }
        $product->delete();
        return redirect()->back()->with('message', 'Product has been deleted successfully');
    }

    public function updateProdColorQuantity(Request $request, $prodColorId)
    {
        $productColorData = Product::findOrFail($request->product_id)
            ->productColors()
            ->where('id', '=', $prodColorId)
            ->first();
        $productColorData->update([
            'quantity' => $request->quantity
        ]);
        return response()->json([
            'message' => 'Product colors quantity updated successfully'
        ]);
    }

    public function destroyProdColorQuantity($prodColorId)
    {
        ProductColor::findOrFail($prodColorId)
            ->delete();
        return response()->json([
            'message' => 'Product color has been deleted successfully'
        ]);
    }
}
