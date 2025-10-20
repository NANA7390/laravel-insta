@extends('layouts.app')

@section('title','Admin: Users')

@section('content')

<form action="{{ route('admin.user')}}" method="get" class="mb-3">
        <input type="text" name="search" value="{{ $search }}" class="form-control form-control-sm w-auto ms-auto" placeholder="search name">
    </form>



<table class="table table-hover bg-white align-middle text-secondary">
    <thead class="table-success text-secondary small text-uppercase">
        <tr>
            <th></th>
            <th>Name</th>
            <th>Email</th>
            <th>Created_at</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($all_users as $user)
        <tr>
            {{-- avatar/icon --}}
             <td>
                @if($user->avatar)
                   <img src="{{$user->avatar}}" alt="" class="image-md
                 rounded-circle d-block mx-auto">
                @else
                   <i class="fa-solid fa-circle-user text-secondary icon-md d-block text-center"></i>
                @endif
            </td>
            {{-- name --}}
            <td>
            <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark fw-bold">
                {{ $user->name }}
            </a>
            </td>
            {{-- email,created_at --}}
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at }}</td>
            {{-- status --}}
            <td>
                @if($user->trashed())
                <i class="fa-regular fa-circle"></i> Inactive
                @else
                <i class="fa-solid fa-circle text-success"></i> Active
                @endif
            </td>
               {{-- button --}}
            <td>
            @if($user->id !== Auth::user()->id)
            <div class="dropdown">
                <button class="btn btn-sm" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-ellipsis"></i>
                </button>

                <div class="dropdown-menu">
                    @if($user->trashed())
                    {{-- activate --}}
                    <button class="dropdown-item" data-bs-toggle="modal"
                     data-bs-target="#activate-user{{ $user->id }}">
                        <i class="fa-solid fa-user-check"></i>Activate {{$user->name}}
                    </button>
                    @else
                    {{-- deactivate --}}
                    <button class="dropdown-item text-danger" data-bs-toggle="modal" 
                    data-bs-target="#deactivate-user{{ $user->id }}">
                        <i class="fa-solid fa-user-slash"></i>Deactivate {{$user->name}}
                    </button>
                    @endif
               </div>
            </div>

                @include('admin.users.status')
              @endif
            </td>
        </tr>
        @empty
        <tr><td class="text-center" colspan="6">No users found</td></tr>
        @endforelse 
    </tbody>
</table>
{{-- page buttons --}}
{{ $all_users->links() }}


@endsection