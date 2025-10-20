{{-- <div class="modal fade" id="#update-categ{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger text-dark text-start">
            <div class="modal-header border-danger">
                <h3 class="h4 modal-title"><i class="fa-solid fa-pencil"></i> Edit Category</h3>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.category.update', $category->id)}}" method="post"> --}}
                    {{-- <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="form-control mb-2"> --}}
                    {{-- @error('category.name.'.$category->name)
                    <p class="mb-0 text-danger small">{{ $message }}</p>
                    @enderror --}}

                    {{-- <div class="modal-footer border-0">
                        @csrf 
                        @method('PATCH')
                        <button type="button" class="btn btn-sm btn-outline-warning" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-warning text-dark">Update</button>
                    </div> --}}
                    {{-- WWW
                </form>
            </div>
        </div>
    </div>
</div> --}}

{{-- <div class="mt-2">
    <form action="{{ route('comment.store', $post->id) }}" method="post">
        @csrf
        <div class="input-group">
            <textarea name="comment_body{{ $post->id }}" row="1" placeholder="comment"
               class="form-control form-control-sm">{{ old('comment_body'.$post->id) }}</textarea>

        <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fa-regular fa-paper-plane"></i></button>
        </div>
        @error('comment_body'.$post->id)
        <p class="mb-0 text-danger small">{{ $message }}</p>
        @enderror
    </form>
 </div> --}}

 
    {{-- //  public function store(Request $request, $post_id)
    // {
    //     $request->validate([
    //         "comment_body$post_id" => 'required|max:150' 
    //     ], [
    //         "comment_body$post_id.required" => "You cannot post an empty comment.",
    //         "comment_body$post_id.max" => "Maximum of 150 characters only."
    //     ]);

    //     $this->comment->body = $request->input("comment_body$post_id"); 
    //     $this->comment->user_id = Auth::id(); 
    //     $this->comment->post_id = $post_id;  


    //     $this->comment->save();

    //     return redirect()->back(); --}}
{{-- 

<div class="modal fade" id="update-categ{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger text-dark text-start">
            <div class="modal-header border-warning">
                <h3 class="h4 modal-title"><i class="fa-solid fa-pen-to-square"></i> Edit Category</h3>
            </div>
            <form action="{{ route('admin.category.update', $category->id)}}" method="post">
                <div class="modal-body">
                    <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="form-control mb-2">
                    @error('name', $category->name)
                    <p class="mb-0 text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <div class="modal-footer border-0">
                    @csrf 
                    @method('PATCH')
                    <button type="button" class="btn btn-sm btn-outline-warning" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-warning">Update</button>
                </div>
            </form>

        </div>
    </div>
</div> --}}

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