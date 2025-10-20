@extends('layouts.app')
@section('title', 'Create Post')
@section('content')

<form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    {{-- categories --}}    
    <p class="mb-2 fw-bold">Categories<span class="fw-light fs-italic">(up to 3)</span></p>
    <div>
        @forelse($all_categories as $category)
        <div class="form-check form-check-inline">
            <input type="checkbox" name="categories[]" id="cat_{{ $category->name }}"
            value="{{ $category->id }}" class="form-check-input">
            <label for="cat_{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
        </div>
        @empty            
        <span class="fs-italic">No categories. Please add categories before posting</span>

        @endforelse
        </div>
        
        @error('categories')
        <p class="mb-0 text-danger small">{{ $message }}</p>
        @enderror

        {{-- description --}}
        <label for="description" class="form-label fw-bold mt-3">Description</label>
        <textarea name="description" id="description" rows="3" class="form-control" placeholder="What's on your mind?">{{ old('description') }}</textarea>
        @error('description')
        <p class="mb-0 text-danger small">{{ $message }}</p>
        @enderror
    

        {{-- image --}}
        <label for="image" class="form-label fw-bold mt-3">Image</label>
        <input type="file" name="image" id="image" class="form-control">
        <p class="mb-0 form-text">
            Acceptable formats: jpg, jpeg, png, gif<br>
            Max file size is 1048MB
        </p>
        @error('image')
        <p class="mb-0 text-danger small">{{ $message }}</p>
        @enderror
        {{-- submit --}}
        <button type="submit" class="btn btn-primary px-4 mt-3">Post</button>
    </form>

@endsection