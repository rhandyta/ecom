@extends('layouts.admin')
@section('title', 'Color')
@section('content')

<div class="row">
    <div class="col-md-12">
       @if (session('message'))
           <h6 class="alert alert-success">{{ session('message') }}</h6>            
       @endif
       <div class="card">
            <div class="card-header">
                <h3 class="">Color Lists <a href="{{ route('color.create') }}" class="btn btn-primary btn-sm float-end">Add Color</a></h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = ($colors->currentPage() - 1) * $colors->perPage() + 1
                            @endphp
                            @foreach ($colors as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('color.edit', $item->id) }}" class="btn btn-success btn-sm">Edit</a>
                                            <form action="{{ route('color.destroy', $item->id) }}" method="post">
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
                        {{ $colors->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
       </div>
   </div>
</div>
</div>
@endsection