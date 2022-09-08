@extends('layouts.admin')
@section('title', 'Add Product')
@section('content')
        <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="">Edit Product <a href="{{ route('product.index') }}" class="btn btn-primary btn-sm float-end">Back</a></h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach    
                        </div>                        
                    @elseif(session('message'))
                        <div class="alert alert-success">
                                <div>{{ session('message') }}</div>
                        </div>       
                    @endif
                    
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                        </li>
                        <li class="nav-item" role="presentation">
                        <button class="nav-link" id="seotag-tab" data-bs-toggle="tab" data-bs-target="#seotag" type="button" role="tab" aria-controls="seotag" aria-selected="false">SEO Tags</button>
                        </li>
                        <li class="nav-item" role="presentation">
                        <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false">Details</button>
                        </li>
                        <li class="nav-item" role="presentation">
                        <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image" type="button" role="tab" aria-controls="image" aria-selected="false">Image</button>
                        </li>
                    </ul>
                    <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade border p-3 show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="form-group mb-3">
                                    <label for="category">Category</label>
                                    <select name="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="name">Product Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $product->name }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" class="form-control" value="{{ $product->slug }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="brand">Brand</label>
                                    <select name="brand" class="form-control">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->name }}" {{ $product->brand == $brand->name ? 'selected' : '' }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="small_description">Small description max 500 words</label>
                                    <textarea rows="4" name="small_description" class="form-control">{{ $product->small_description }}</textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description">Description</label>
                                    <textarea rows="4" name="description" class="form-control">{{ $product->description }}</textarea>
                                </div>
                                
                            </div>
                            <div class="tab-pane fade border p-3" id="seotag" role="tabpanel" aria-labelledby="seotag-tab">
                                <div class="form-group mb-3">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control" value="{{ $product->meta_title }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="meta_keyword">Meta Keyword</label>
                                    <textarea rows="4" name="meta_keyword" class="form-control">{{ $product->meta_keyword }}</textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea rows="4" name="meta_description" class="form-control">{{ $product->meta_description }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="details" role="tabpanel" aria-labelledby="details-tab">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="original_price">Original Price</label>
                                            <input type="number" max="1000000000"  name="original_price" class="form-control" value="{{ $product->original_price }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="selling_price">Selling Price</label>
                                            <input type="number" max="1000000000"  name="selling_price" class="form-control" value="{{ $product->selling_price }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="quantity">Quantity</label>
                                            <input type="number" max="1000000" name="quantity" class="form-control" value="{{ $product->quantity }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="trending">Trending</label>
                                            <input type="checkbox" name="trending" class="form-check-input" style="width: 50px; height: 50px" {{ $product->trending == '1' ? 'checked' : ''}}>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="status">Status</label>
                                            <input type="checkbox" name="status" class="form-check-input" style="width: 50px; height: 50px" {{ $product->status == '1' ? 'checked' : ''}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="image" role="tabpanel" aria-labelledby="image-tab">
                                <div class="form-group mb-3">
                                    <label for="image">Product Image</label>
                                    <input type="file" name="image[]" class="form-control mb-2" multiple >
                                    @if ($product->ProductImages)
                                    <div class="row">
                                        @foreach ($product->ProductImages as $productImage)
                                        <div class="col-md-2">
                                            <img class="ml-2 border p-2" src="{{ asset($productImage->image) }}" alt="{{ $product->name }}" style="width: 150px; height: 150px;">
                                            <a href="{{ route('product.destroyImage', $productImage->id) }}" class="d-block">Remove</a>
                                        </div>
                                        @endforeach 
                                    </div>
                                    @else
                                        <h5>No Images Added</h5>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection