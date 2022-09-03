<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->category = new Category;
    }

    public function index()
    {
        return view('admin.category.index');
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryFormRequest $request)
    {
        $validateData = $request->validated();

        $this->category->name = $validateData['name'];
        $this->category->slug = \Str::slug($validateData['slug']);
        $this->category->description = $validateData['description'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/category/', $filename);
            $this->category->image = $filename;
        }

        $this->category->meta_title = $validateData['meta_title'];
        $this->category->meta_keyword = $validateData['meta_keyword'];
        $this->category->meta_description = $validateData['meta_description'];
        $this->category->status = $request->status == true ? '1' : '0';
        $this->category->save();

        return redirect()->route('category.index')->with('message', 'Category added successfully');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryFormRequest $request, $category)
    {
        $validateData = $request->validated();
        $category = $this->category->findOrFail($category);
        $category->name = $validateData['name'];
        $category->slug = \Str::slug($validateData['slug']);
        $category->description = $validateData['description'];

        if ($request->hasFile('image')) {
            $path = 'uploads/category/' . $category->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/category/', $filename);
            $category->image = $filename;
        }

        $category->meta_title = $validateData['meta_title'];
        $category->meta_keyword = $validateData['meta_keyword'];
        $category->meta_description = $validateData['meta_description'];
        $category->status = $request->status == true ? '1' : '0';
        $category->update();

        return redirect()->route('category.index')->with('message', 'Category updated successfully');
    }
}
