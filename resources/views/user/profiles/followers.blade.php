@extends('layouts.app')

@section('title', $user->name . ' Followers')

@section('content')
  @include('user.profiles.header')
{{-- //still use for showing followers list at same time --}}
  {{-- followers --}}
  @if($user->followers->isNotEmpty())
  <div class="row justify-content-center">
    <div class="col-4">
        <h3 class="h4 text-center text-secondary mb-3">Followers</h3>

        @foreach($user->followers as $follow)
        <div class="row mb-3 align-items-center">
            <div class="col-auto">
                {{-- icon/avatar --}}
                <a href="{{ route('profile.show', $follow->follower->id) }}">
                  @if($follow->follower->avatar)
                  <img src="{{$follow->follower->avatar}}" alt="" class="rounded-circle image-sm">
                  @else
                  <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                  @endif
                </a>
                  
                </div>
                <div class="col ps-0 text-truncate">
                    {{-- follower name --}}
                    <a href="{{ route('profile.show', $follow->follower->id) }}" class="text-decoration-none text-dark fw-bold">{{ $follow->follower->name }}</a>
                </div>
                <div class="col-auto">
                    {{-- button --}}
                    @if($follow->follower_id != Auth::user()->id)
                    @if($follow->follower->isFollowed())
                    {{-- unfollow --}}
                    <form action="{{ route('follow.destroy', $follow->follower->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn p-0 text-secondary">Following</button>
                    </form>
                    @else
                    {{-- follow --}}
                    <form action="{{ route('follow.store', $follow->follower->id) }}" method="post">
                      @csrf
                      <button type="submit" class="btn p-0 text-primary">Follow</button>
                    </form>
                    @endif
                    @endif
                </div>
        </div>
        @endforeach
    </div>
  </div>
  @else
  <h3 class="h4 text-center text-muted">No followers</h3>
  @endif
@endsection