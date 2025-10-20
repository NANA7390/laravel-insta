<div class="mt-2">
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
 </div>