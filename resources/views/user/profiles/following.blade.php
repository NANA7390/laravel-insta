@extends('layouts.app')

@section('title', $user->name . ' Following')

@section('content')
  @include('user.profiles.header')
{{-- //still use for showing followers list at same time --}}
  {{-- followers --}}
  @if($user->follows->isNotEmpty())
  <div class="row justify-content-center">
    <div class="col-4">
        <h3 class="h4 text-center text-secondary mb-3">Following</h3>

        @foreach($user->follows as $follow)
        <div class="row mb-3 align-items-center">
            <div class="col-auto">
                {{-- icon/avatar --}}
                <a href="{{ route('profile.show', $follow->following->id) }}">
                  @if($follow->following->avatar)
                  <img src="{{$follow->following->avatar}}" alt="" class="rounded-circle image-sm">
                  @else
                  <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                  @endif
                </a>
              </div>
              <div class="col ps-0 text-truncate">
                  {{-- follower name --}}
                  <a href="{{ route('profile.show', $follow->following->id) }}" class="text-decoration-none text-dark fw-bold">{{ $follow->following->name }}</a>
                </div>
                <div class="col-auto">
                    {{-- button --}}
                    @if($follow->following_id != Auth::user()->id)
                    @if($follow->following->isFollowed())
                    {{-- unfollow --}}
                    <form action="{{ route('follow.destroy', $follow->following->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn p-0 text-primary">Follow</button>
                    </form>
                    @else
                    {{-- follow --}}
                    <form action="{{ route('follow.store', $follow->following->id) }}" method="post">
                      @csrf
                      <button type="submit" class="btn p-0 text-secondary">Following</button>
                    </form>
                    @endif
                    @endif
                </div>
        </div>
        @endforeach
    </div>
  </div>
  @else
  <h3 class="h4 text-center text-muted">No following anyone yet.</h3>
  @endif
@endsection