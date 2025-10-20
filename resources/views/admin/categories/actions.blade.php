{{-- @if(!$category->trashed()) --}}

{{-- <div class="modal fade" id="delete-category{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h4 text-danger"><i class="fa-solid fa-eye-slash"></i> Hide Category</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete {{ $category->name }} category?</p>
                <p class="text-muted">This action will affect all the posts under this category. Posts without a<br>
                category will fall under Uncategorized</p>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.category.destroy', $category->id)}}" method="delete">
                    @csrf 
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>

        </div>
    </div>  
</div> --}}


<div class="modal fade" id="delete-categ{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger text-dark text-start">
            <div class="modal-header border-danger">
                <h3 class="h4 modal-title"><i class="fa-solid fa-trash-can"></i> Delete Category</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <span class="fw-bold">{{ $category->name }}</span> category?</p>
                <p>This action will affect all posts under this category. Posts without a category will fall under Uncategorized.</p>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.category.destroy', $category->id)}}" method="post">
                    @csrf 
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="edit-categ{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-warning text-dark text-start">
            <div class="modal-header border-warning">
                <h3 class="h4 modal-title"><i class="fa-regular fa-pen-to-square"></i> Edit Category</h3>
            </div>
            <form action="{{ route('admin.category.update', $category->id)}}" method="post">
                @csrf 
                @method('PATCH')
                <div class="modal-body">
                    <input type="text" name="categ_name{{ $category->id }}" value="{{ $category->name }}" id="" class="form-control">
                    @error('categ_name'.$category->id)
                        <p class="mb-0 text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-sm btn-outline-warning" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-warning">Update</button>
                </div>
            </form>
           
        </div>
    </div>
</div>


