<div class="mb-5 row">
    <div class="col-4">
    {{-- icon/avatar --}}
    @if($user->avatar)
    <img src="{{ $user->avatar }}" alt="" class="image-xl rounded-circle d-block mx-auto">
    @else
    <i class="fa-solid fa-circle-user text-secondary icon-xl d-block text-center"></i>
    @endif
    </div>
    <div class="col">
        {{-- user name --}}
        <div class="row mb-3">
            <div class="col-auto">
                <h2 class="display-6 mb-0">{{ $user->name }}</h2> 
            </div>
            <div class="col align-self-end pb-2">
                {{-- button --}}
                @if($user->id === Auth::user()->id)
                {{-- edit profile --}}
                <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-secondary fw-bold">Edit Profile</a>
                @else
                {{-- follow/unfollow --}}
                @if($user->isFollowed())
                {{-- unfollow --}}
                <form action="{{ route('follow.destroy', $user->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-secondary fw-bold">following</button>
                </form>

                @else
                <form action="{{ route('follow.store', $user->id) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-primary fw-bold">follow</button>
                </form>
                @endif
                @endif
            </div>
        </div>
{{-- link /user.php --}}
<div class="row mb-3">
    <div class="col-auto">
        <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark">
          <span class="fw-bold">{{ $user->posts->count() }}</span> {{ $user->posts->count()==1 ? 'post' : 'posts'}}
        </a>                                                      {{-- <if> ? <true> : <false> --}}
        </div>
        <div class="col-auto">
        <a href="{{ route('profile.followers', $user->id) }}" class="text-decoration-none text-dark">
          <span class="fw-bold">{{ $user->followers->count() }} </span>{{ $user->followers->count()==1 ? 'follower' : 'followers' }}
        </a>
        </div>
        <div class="col-auto">
        <a href="{{ route('profile.following', $user->id) }}" class="text-decoration-none text-dark">
          <span class="fw-bold">{{ $user->follows->count() }}</span> {{ $user->follows->count()==1 ? 'following' : 'following' }}
        </a>
        </div>
    </div>

    <p class="fw-bold">{{ $user->introduction }}</p>
</div>
</div>
