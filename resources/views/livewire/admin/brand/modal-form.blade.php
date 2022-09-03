    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="addBrandModalLabel">Add Brand</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="storeBrand()">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" wire:model.defer="name" class="form-control">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="slug">Slug</label>
                        <input type="text" wire:model.defer="slug" class="form-control">
                        @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Status</label><br>
                        <input type="checkbox" wire:model.defer="status" class="form-check-input">
                        <p class="text-danger">*Checked = Hidden, Un-Checked = Visible</p>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        </div>
    </div>


    <!-- Edit Modal -->
    <div wire:ignore.self class="modal fade" id="editBrandModal" tabindex="-1" aria-labelledby="editBrandModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editBrandModalLabel">Edit Brand</h5>
            <button type="button" class="btn-close" wire:click="resetForm" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div wire:loading class="mx-auto py-4">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="updateBrand">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" wire:model.defer="name" class="form-control">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="slug">Slug</label>
                            <input type="text" wire:model.defer="slug" class="form-control">
                            @error('slug')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Status</label><br>
                            <input type="checkbox" wire:model.defer="status" class="form-check-input">
                            <p class="text-danger">*Checked = Hidden, Un-Checked = Visible</p>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="resetForm" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>


    <!-- remove Modal -->
    <div wire:ignore.self class="modal fade" id="deleteBrandModal" tabindex="-1" aria-labelledby="deleteBrandModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="deleteBrandModalLabel">Edit Brand</h5>
            <button type="button" class="btn-close" wire:click="resetForm" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div wire:loading class="mx-auto py-4">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="destroyBrand">
                    <div class="modal-body">
                       <h4 class="text-danger">Are you sure you want to delete this data ?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="resetForm" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn-primary">Yes, Delete</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>