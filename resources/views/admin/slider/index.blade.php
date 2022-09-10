@extends('layouts.admin')
@section('title', 'Slider')
@section('content')

<div class="row">
    <div class="col-md-12">
       @if (session('message'))
           <h6 class="alert alert-success">{{ session('message') }}</h6>            
       @endif
       <div class="card">
            <div class="card-header">
                <h3 class="">Slider Lists <a href="{{ route('slider.create') }}" class="btn btn-primary btn-sm float-end">Add Slider</a></h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = ($sliders->currentPage() - 1) * $sliders->perPage() + 1
                            @endphp
                            @foreach ($sliders as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        <img src="{{ asset("$item->image") }}" alt="{{ $item->title }}" style="width: 70px; height:50px">
                                    </td>
                                    <td>{{ $item->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('slider.edit', $item->id) }}" class="btn btn-success btn-sm">Edit</a>
                                            <form action="{{ route('slider.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" onclick="return confirm('are you sure delete ?')" class="btn btn-danger btn-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-2">
                        {{ $sliders->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
       </div>
   </div>
</div>
@endsection