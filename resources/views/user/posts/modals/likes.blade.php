<div class="modal fade" id="likes-post-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header border-0">
                <button class="btn border-0 bg-transparent text-primary ms-auto" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <div class="modal-body px-5">
                @foreach($post->likes as $like)
                    <div class="row align-items-center mb-3 px-5">
                        <div class="col-auto">
                            <a href="{{ route('profile.show', $like->user->id) }}">
                                @if($like->user->avatar)
                                    <img src="{{ $like->user->avatar }}" alt="" class="rounded-circle image-sm">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                @endif
                            </a>
                        </div>
                        <div class="col ps-0 text-truncate">
                            <a href="{{ route('profile.show', $like->user->id) }}" class="text-decoration-none text-dark fw-bold small">{{ $like->user->name }}</a>
                        </div>

                        {{-- follow/unfollow --}}
                        <div class="col-auto">
                            @if($like->user_id != Auth::user()->id)
                                @if($like->user->isFollowed())
                                    <form action="{{ route('follow.destroy', $like->user->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn p-0 text-secondary small">unfollow</button>
                                    </form>
                                @else
                                    <form action="{{ route('follow.store', $like->user->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn p-0 text-primary small">Follow</button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
