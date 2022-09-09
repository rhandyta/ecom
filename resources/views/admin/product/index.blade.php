@extends('layouts.admin')
@section('title', 'Products')
@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="">Product Lists <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm float-end">Add Product</a></h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered ">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Category</td>
                                <td>Name Product</td>
                                <td>Price</td>
                                <td>Quantity</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = ($products->currentPage() - 1) * $products->perPage() + 1
                            @endphp
                            @forelse ($products as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        @if ($item->category)
                                            {{ $item->category->name }}
                                        @else
                                        No Category
                                        @endif
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->selling_price }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->status == '1' ? "Hidden" : 'Visible' }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('product.edit', $item->id) }}" class="btn btn-success btn-sm">Edit</a>
                                            <form action="{{ route('product.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" onclick="return confirm('are you sure delete ?')" class="btn btn-danger btn-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Products not found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-2">
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection