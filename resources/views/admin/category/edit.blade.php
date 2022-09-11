@extends('layouts.admin')
@section('title', 'Edit Category')
@section('content')
    <div class="row">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header">
                   <h3 class="">Edit Category <a href="{{ route('category.index') }}" class="btn btn-primary btn-sm float-end">Back</a></h3>
               </div>
               <div class="card-body">
                    <form action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                                @error('name')
                                    <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control" name="slug" value="{{ $category->slug }}">
                                @error('slug')
                                    <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" rows="3">{{ $category->description }}</textarea>
                                @error('description')
                                    <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" name="image">
                                <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="mt-2" width="150px" height="150px">
                                @error('image')
                                    <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="status" class="form-check-label">Status</label><br>
                                <input type="checkbox" class="form-check-input" name="status" {{ $category->status == '1' ? 'checked' : '' }}>
                            </div>
                            <div class="col-md-12">
                                <h4>SEO Tags</h4>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" class="form-control" name="meta_title" value="{{ $category->meta_title }}">
                                @error('meta_title')
                                    <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label for="meta_keyword">Meta Keyword</label>
                                <input type="text" class="form-control" name="meta_keyword" value="{{ $category->meta_keyword }}">
                                @error('meta_keyword')
                                    <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label for="meta_description">Meta Description</label>
                                <textarea  class="form-control" name="meta_description" rows="3">{{ $category->meta_description }}</textarea>
                                @error('meta_description')
                                    <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <button  class="btn btn-primary float-end" type="submit">Update</button>
                            </div>
                            
                        </div>
                    </form>
               </div>
           </div>
       </div>
    </div>
@endsection