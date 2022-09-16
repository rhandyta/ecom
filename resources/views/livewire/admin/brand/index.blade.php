@section('title', 'Brand')
<div>
    @include('livewire.admin.brand.modal-form')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Brand List <a href="#" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#addBrandModal">Add Brand</a></h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = ($brands->currentPage() - 1) * $brands->perPage() + 1
                                @endphp
                                @forelse ($brands as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @if ($item->category)
                                            {{ $item->category->name }}
                                        @else
                                            No Category
                                        @endif
                                    </td>
                                    <td>{{ $item->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                    <td>
                                        <button wire:click="editBrand({{ $item->id }})" type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editBrandModal">Edit</button>
                                        <button wire:click="deleteBrand({{ $item->id }})" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteBrandModal">
                                                Delete
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Data not found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-2">
                            {{ $brands->links() }}
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $("#addBrandModal").modal('hide')
            $("#editBrandModal").modal('hide')
            $("#deleteBrandModal").modal('hide')
        })
    </script>
@endpush