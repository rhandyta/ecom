<div>
    <!-- Modal -->
<div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Category Delete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form wire:submit.prevent="destroyCategory">
            <div class="modal-body">
                <h6 class="text-danger">Are you sure you want delete this data ?</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Yes, Detele</button>
            </div>
        </form>
      </div>
    </div>
  </div>

    <div class="row">
        <div class="col-md-12">
           @if (session('message'))
               <h6 class="alert alert-success">{{ session('message') }}</h6>            
           @endif
           <div class="card">
                <div class="card-header">
                    <h3 class="">Category <a href="{{ route('category.create') }}" class="btn btn-primary btn-sm float-end">Add Category</a></h3>
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
                                    $i = ($categories->currentpage() - 1) * $categories->perpage() + 1
                                @endphp
                                @foreach ($categories as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                    <td>
                                            <a href="{{ route('category.edit', $item->id) }}" class="btn btn-success btn-sm">Edit</a>
                                            <a wire:click="deleteCategory({{ $item->id }})" href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                Delete
                                            </a>
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2">
                            {{ $categories->links('pagination::bootstrap-5') }}
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
            $("#deleteModal").modal('hide');
        })
    </script>
@endpush