@extends('layouts.admin')
@section('title', 'Add Product')
@section('content')
        <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="">Add Product <a href="{{ route('product.index') }}" class="btn btn-primary btn-sm float-end">Back</a></h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach    
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
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color" type="button" role="tab" aria-controls="color" aria-selected="false">Color</button>
                        </li>
                    </ul>
                    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade border p-3 show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="form-group mb-3">
                                    <label for="category">Category</label>
                                    <select name="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="name">Product Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="brand">Brand</label>
                                    <select name="brand" class="form-control">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="small_description">Small description max 500 words</label>
                                    <textarea rows="4" name="small_description" class="form-control"></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description">Description</label>
                                    <textarea rows="4" name="description" class="form-control"></textarea>
                                </div>
                                
                            </div>
                            <div class="tab-pane fade border p-3" id="seotag" role="tabpanel" aria-labelledby="seotag-tab">
                                <div class="form-group mb-3">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="meta_keyword">Meta Keyword</label>
                                    <textarea rows="4" name="meta_keyword" class="form-control"></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea rows="4" name="meta_description" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="details" role="tabpanel" aria-labelledby="details-tab">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="original_price">Original Price</label>
                                            <input type="number" max="1000000000"  name="original_price" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="selling_price">Selling Price</label>
                                            <input type="number" max="1000000000"  name="selling_price" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="quantity">Quantity</label>
                                            <input type="number" max="1000000" name="quantity" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="trending">Trending</label>
                                            <input type="checkbox" name="trending" class="form-check-input" style="width: 50px; height: 50px">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="status">Status</label>
                                            <input type="checkbox" name="status" class="form-check-input" style="width: 50px; height: 50px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="image" role="tabpanel" aria-labelledby="image-tab">
                                <div class="form-group mb-3">
                                    <label for="image">Product Image</label>
                                    <input type="file" name="image[]" class="form-control" multiple >
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="color" role="tabpanel" aria-labelledby="color-tab">
                                <div class="form-group mb-3">
                                    <label for="colors">Select Colors</label>
                                    <div class="row">
                                        @forelse ($colors as $item)
                                        <div class="col-md-3">
                                                <input type="checkbox" name="colors[]" class="form-check-input" value="{{ $item->id }}"> {{ $item->name }}
                                        </div>
                                        @empty
                                            <div class="col-md-12">
                                                <h6>No colors found, <a href="{{ route('color.index') }}" class="link-primary">Add colors</a></h6>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection