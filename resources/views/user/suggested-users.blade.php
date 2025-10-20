 @extends('layouts.app')

@section('title', 'SuggestedUsers')

@section('content')
 
 
 
 {{-- SUGGESTED USERS --}}
        @if($suggested_users)
        <div class="row mb-3">
            <div class="col">
                <p class="mb-0 text-secondary fw-bold fs-3 mb-3">Suggested</p>
            </div>
            
        </div>

        @foreach($suggested_users as $user)
        <div class="row mb-3 align-items-center w-50">
            <div class="col-auto">
                {{-- icon/avatar --}}
                <a href="{{ route('profile.show', $user->id) }}">
                     @if($user->avatar)
                <img src="{{ $user->avatar }}" alt="" class="image-md rounded-circle ">
                @else
                <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                @endif
                </a>
            </div>
            <div class="col ps-0 text-truncate">
                {{-- user Name --}}
                <a href="{{ route('profile.show', $user->id) }}" 
                    class="text-decoration-none text-dark fw-bold">{{ $user->name }}
                </a>
                <p class="mb-0">{{ $user->email }}</p>lara
                @if($user->isFollowing(Auth::user()->id))
                    <p class="mb-0 text-muted small">Follows you</p>
                @else
                    @if ($user->followers->count() > 0)
                        <p class="mb-0 text-muted small">{{ $user->followers->count() }} followers</p>
                        @else
                        <p class="mb-0 text-muted small">No followers yet</p>
                    @endif
                @endif
            </div>
            <div class="col-auto">
                {{-- follow --}}
                <form action="{{ route('follow.store', $user->id) }}" method="post">
                    @csrf
                    <button type="submit" class="btn p-0 text-primary">Follow</button>
                </form>
            </div>
        </div>
        @endforeach
        @endif

        @endsection