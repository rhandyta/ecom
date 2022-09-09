@extends('layouts.admin')
@section('title', 'Edit Color')
@section('content')
    <div class="row">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header">
                   <h3 class="">Edit Color <a href="{{ route('color.index') }}" class="btn btn-primary btn-sm float-end">Back</a></h3>
               </div>
               <div class="card-body">
                    <form action="{{ route('color.update', $color->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $color->name }}">
                                @error('name')
                                    <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="code">Code</label>
                                <input type="text" class="form-control" name="code" value="{{ $color->code }}">
                                @error('code')
                                    <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="status" class="form-check-label">Status</label><br>
                                <input type="checkbox" class="form-check-input" name="status" style="width: 25px; height:25px;" {{ $color->status == 1 ? 'checked' : '' }}> <p>Checked = Hidden, Un-checked = Visible.</p>
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