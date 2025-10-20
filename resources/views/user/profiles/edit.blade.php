@extends('layouts.app')
@section('title', 'Edit Profile')
@section('content')
<div class="row justify-content-center">
    <div class="col-8">
        <form action="{{ route('profile.update') }}" method="post" class="bg-white rounded-3 shadow p-5" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <h2 class="h4 text-secondary mb-3">Update Profile</h2>
            {{-- avatar --}}
            <div class="row mb-3">
                <div class="col-4">
                    @if(Auth::user()->avatar)
                    <img src="{{ Auth::user()->avatar }}" alt="" class="image-xl rounded-circle d-block mx-auto">
                    @else
                    <i class="fa-solid fa-circle-user text-secondary icon-xl d-block text-center"></i>
                    @endif

                </div>
                <div class="col align-self-end">
                    <input type="file" name="avatar" id="avatar" class="form-control form-control-sm w-auto">
                    <p class="mb-0 form-text">
                        Available formats: jpg, jpeg, png.gif only<br>
                         Max file size is 1048MB.
                    </p>
                    @error('avatar')
                    <p class="mb-0 text-danger small">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- name --}}
            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
            <label for="name" class="form-label fw-bold">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', Auth::user()->name) }}">
            @error('name')
            <p class="mb-0 text-danger small">{{ $message }}</p>
            @enderror


            {{-- email --}}
            <label for="email" class="form-label fw-bold mt-3">E-mail</label>
            <input type="text" name="email" id="email" class="form-control" value="{{ old('email', Auth::user()->email) }}">
            @error('email')
            <p class="mb-0 text-danger small">{{ $message }}</p>
            @enderror

            {{-- introduction --}}
            <label for="intro" class="form-label fw-bold mt-3">Introduction</label>
            <textarea name="introduction" id="intro" rows="3 "class="form-control" rows="3">{{ old('introduction', Auth::user()->introduction) }}</textarea>
            @error('introduction')
            <p class="mb-0 text-danger small">{{ $message }}</p>
            @enderror

            <button type="submit"class="btn btn-warning px-5 mt-3">Save</button>
        </form>

            {{-- UPDATE PASSWORD --}}
            <form action="{{ route('profile.updatePassword') }}" method="post" class="bg-white rounded-3 shadow p-5 mt-5">
                @csrf
                @method('PATCH')

                @if(session('password_success'))
                <p class="mb-3 text-success fw-bold">{{ session('password_success') }}</p>
                @endif

                <h2 class="h4 text-secondary mb-3">Update Password</h2>
                
                {{-- old password /session with profile controller--}}
                <label for="old-password" class="form-label fw-bold">Old Password</label>
                <input type="password" name="old_password" id="old-password" class="form-control">
                @if(session('current_password_error'))
                <p class="mb-0 text-danger small">{{ session('current_password_error') }}</p>
                @endif

                {{-- new password/ session with profile controller --}}
                <label for="new-password" class="form-label fw-bold mt-3">New Password</label>
                <input type="password" name="new_password" id="new-password" class="form-control">
                @if(session('same_password_error'))
                <p class="mb-0 text-danger small">{{ session('same_password_error') }}</p>
                @endif
                @error('new_password')
                <p class="mb-0 text-danger small">{{ $message }}</p>
                @enderror

                {{-- confirm new password --}}
                <label for="confirm-new" class="form-label mt-3">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="confirm-new" class="form-control">

                <button type="submit" class="btn btn-warning px-5 mt-3">Update Password</button>
            </form>
        </div>
    </div>


@endsection