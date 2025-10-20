@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="row gx-5">
    <div class="col-8">
        {{-- <div class="row gx-5">
            <div class="col-8"> --}}
                {{-- SEARCH LABEL --}}
                @if($search)
                    <h2 class="h5 text-muted mb-3">
                        Search Results for "<span class="fw-bold">{{ $search }}</span>"
                    </h2>
                @endif
            {{-- </div>
        </div> --}}
        {{-- POST --}}
        @forelse($all_posts as $post)
        <div class="card mb-4">
            {{-- folder and file name　has a part of header --}}
            @include('user.posts.contents.title')
            {{-- image --}}
            <div class="container p-0">
                <a href="{{ route('post.show', $post->id) }}">
                <img src="{{$post->image}}" alt="" class="w-100">
                </a>
            </div>
            {{-- body --}}
            <div class="card-body">

                {{-- folder and file name　has a part of header --}}
                @include('user.posts.contents.body')

                {{-- comment --}}
                @if($post->comments->isNotEmpty())
                <hr class="mt-2 mb-1">

                @foreach($post->comments->take(3) as $comment)
                    @include('user.posts.comments.list-item')
                @endforeach
                
                @if($post->comments->count() > 3)
                <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none small mt-2 d-block">
                    View all {{ $post->comments->count() }} comments</a>
                @endif
                @endif
                @include('user.posts.comments.create')
            </div>
        </div>
        @empty
        <div class="text-center">
            <h2>Share Photos</h2>
            <p class="text-muted">When you share photos, they will appear on your profile</p>
            <a href="{{route('post.create')}}" class="text-decoration-none">Share your first photo</a>
        </div>
        @endforelse
    </div>
    <div class="col-4">
        {{-- USER INFO --}}
        <div class="row mb-5 shadow-sm rounded-3 align-items-center">
            <div class="col-auto">
                <a href="{{ route('profile.show', Auth::user()->id) }}">
                     @if(Auth::user()->avatar)
                <img src="{{ Auth::user()->avatar }}" alt="" class="image-sm rounded-circle">
                @else
                <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                @endif
                    
                </a>
        </div>
        <div class="col ps-0">
            <a href="{{ route('profile.show', Auth::user()->id) }}" 
                class="text-decoration-none text-dark fw-bold">{{ Auth::user()->name }}</a>
            <p class="text-muted mb-0 small">{{ Auth::user()->email}}</p>
        </div>
    </div>
        {{-- SUGGESTED USERS --}}
        @if($suggested_users)
        <div class="row mb-3">
            <div class="col">
                <p class="mb-0text-secondary fw-bold">Suggested for you</p>
            </div>
            <div class="col-auto">
                {{-- see all --}}
                <a href="{{ route('user.suggested-users') }}" class="text-decoration-none text-dark fw-bold">See all</a>
            </div>
        </div>

        @foreach($suggested_users as $user)
        <div class="row mb-3 align-items-center">
            <div class="col-auto">
                {{-- icon/avatar --}}
                <a href="{{ route('profile.show', $user->id) }}">
                     @if($user->avatar)
                <img src="{{ $user->avatar }}" alt="" class="image-sm rounded-circle">
                @else
                <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                @endif
                </a>
            </div>
            <div class="col ps-0 text-truncate">
                {{-- user Name --}}
                <a href="{{ route('profile.show', $user->id) }}" 
                    class="text-decoration-none text-dark fw-bold">{{ $user->name }}
                </a>
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
    </div>
</div>
@endsection
    







