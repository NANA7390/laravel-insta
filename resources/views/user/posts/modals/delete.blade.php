{{-- //match with delete area in title --}}
<div class="modal fade" id="delete-post{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h4 text-danger"><i class="fa-regular fa-trash-can"></i> Delete Post</h3>
            </div>

            <div class="modal-body">
                <p>Are you sure you want to delete this post?</p>
                <img src="{{ $post->image }}" alt="" class="image-lg d-block mb-2 delete-image">
                {{-- post description --}}
                {{-- if no description, show 'No description' --}}
                <p class="text-muted">{{ $post->description }}</p>

            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('post.destroy', $post->id) }}" method="post">
                    {{-- CSRF protection --}}
                    @csrf
                    @method('DELETE')
                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal"> Cancel</button>
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>