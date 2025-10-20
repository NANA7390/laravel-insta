@extends('layouts.app')

@section('title', 'Admin: Posts')

@section('content')

 {{-- <form action="{{ route('admin.post') }}" method="GET" class="d-flex justify-content-end mb-2">
    <input type="text" name="search_description" class="form-control  w-25 mb-2 " placeholder="" value="{{ $search_description ? $search_description : '' }}">
 </form> --}}
 <form action="{{ route('admin.post')}}" method="get" class="mb-3">
        <input type="text" name="search" value="{{ $search }}" class="form-control form-control-sm w-auto ms-auto" placeholder="search for posts">
    </form>

    <table class="table table-hover bg-white align-middle text-secondary">
        <thead class="table-primary text-secondary small text-uppercase">
            <tr>
                <th></th>
                <th></th>
                <th>Category</th>
                <th>Owner</th>
                <th>Created At</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($all_posts as $post)
                <tr>
                    <td class="text-center">{{ $post->id }}</td>
                    {{-- image --}}
                    <td>
                        <a href="{{ route('post.show', $post->id)}}">
                            <img src="{{ $post->image }}" alt="" class="image-lg d-block mx-auto">
                        </a>
                    </td>
                    {{-- category --}}
                    <td>
                        @forelse($post->categoryPosts as $category_post)
                            <div class="badge bg-secondary bg-opacity-50">{{ $category_post->category->name }}</div>
                        @empty 
                            Uncategorized
                        @endforelse 
                    </td>
                    {{-- owner --}}
                    <td>
                        <a href="{{ route('profile.show', $post->user_id)}}" class="text-decoration-none text-dark">{{ $post->user->name }}</a>
                    </td>
                    <td>{{ $post->created_at }}</td>
                    {{-- status --}}
                    <td>
                        @if($post->trashed())
                            <i class="fa-solid fa-circle-minus"></i> Hidden
                        @else
                            <i class="fa-solid fa-circle text-primary"></i> Visible
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>

                            <div class="dropdown-menu">
                                @if($post->trashed())
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unhide-post{{ $post->id }}">
                                        <i class="fa-solid fa-eye"></i> Unhide Post {{ $post->id }}
                                    </button>
                                @else 
                                    <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#hide-post{{ $post->id }}">
                                        <i class="fa-solid fa-eye-slash"></i> Hide Post {{ $post->id }}
                                    </button>
                                @endif
                            </div>
                        </div>

                        @include('admin.posts.status')
                    </td>
                </tr>
            @empty 
                <tr><td class="text-center" colspan="7">No posts found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- {{ $all_posts->links() }} --}}
@endsection