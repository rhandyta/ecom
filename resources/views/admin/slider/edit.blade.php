@extends('layouts.admin')
@section('title', 'Edit Slider')
@section('content')
    <div class="row">
       <div class="col-md-12">
           @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
           @endif
           <div class="card">
               <div class="card-header">
                   <h3 class="">Edit Slider <a href="{{ route('slider.index') }}" class="btn btn-primary btn-sm float-end">Back</a></h3>
               </div>
               <div class="card-body">
                    <form action="{{ route('slider.update', $slider->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" value="{{ $slider->title }}">
                                @error('title')
                                    <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="description">Description</label>
                                <textarea type="text" class="form-control" name="description" rows="3">{{ $slider->description }}</textarea>
                                @error('description')
                                    <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="image">Image</label>
                                <img class="img-thumbnail mb-2" src="{{ asset("$slider->image") }}" alt="{{ $slider->title }}" style="width: 200px; height=50px">
                                <input type="file" class="form-control" name="image">
                                @error('image')
                                    <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="status" class="form-check-label">Status</label><br>
                                <input type="checkbox" class="form-check-input" name="status" style="width: 25px; height:25px;" {{ $slider->status == 1 ? 'checked' : '' }}> <p>Checked = Hidden, Un-checked = Visible.</p>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <button  class="btn btn-primary float-end" type="submit">Save</button>
                            </div>
                            
                        </div>
                    </form>
               </div>
           </div>
       </div>
    </div>
@endsection