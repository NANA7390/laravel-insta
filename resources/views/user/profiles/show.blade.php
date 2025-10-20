@extends('layouts.app')
@section('title', $user->name)
@section('content')

@include('user.profiles.header')
  
    <div class="row">
    @forelse($user->posts as $post)
    <div class="col-lg-4 col-md-6 mb-4">
        <a href="{{ route('post.show', $post->id) }}">
            <img src="{{ $post->image }}" alt="" class="grid-img">
        </a>
    </div>
    @empty
     <h3 class="h4 text-center text-muted">No Posts Yet</h3>
    @endforelse
    </div>
@endsection