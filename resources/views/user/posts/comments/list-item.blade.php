{{-- work with show.blade.php --}}
<div class="mt-2">
    <a href="{{ route('profile.show', $comment->user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $comment->user->name }}</a>
    &nbsp; 
    <span class="fw-light">{{$comment->body}}</span>
    <div class="text-muted xsmall">
        {{ date('D, M d Y', strtotime($comment->created_at)) }}
        @if($comment->user_id === Auth::user()->id)
        &middot;
        <form action="{{ route('comment.destroy', $comment) }}" method="post" class="d-inline align-middle">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-transparent border-0 p-0 text-danger xsmall">Delete</button>
        </form>
        @endif
    </div>
</div>