@extends('layouts.app')

@section('title','Admin: Categories')

@section('content')



{{-- ＠methodは編集と削除のフォームに必要で追加は不要 --}}
<form action="{{ route('admin.category.store')}}" method="post" class="row gx-2 mb-3">
        @csrf 
        <div class="col-4">
            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Add a category..." class="form-control">
            @error('name')
                <p class="mb-0 text-danger small">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add</button>
        </div>
    </form>



<table class="table table-hover bg-white align-middle text-secondary">
    <thead class="table-warning text-secondary small text-uppercase">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>COUNT</th>
            <th>LAST UPDATE</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($all_categories as $category)
        <tr>
            {{-- category id --}}
            <td> {{ $category->id }}</td>
            {{-- category name --}}
            <td class="text-dark">{{$category->name}}</td>
            {{-- posts count --}}
            <td>{{ $category->categoryPosts->count() }} </td>
            {{-- last update --}}
            <td>{{ $category->updated_at }}</td>

            {{-- edit --}}
            <td>
                <button class="btn btn-sm btn-outline-warning"  data-bs-toggle="modal" data-bs-target="#update-categ{{ $category->id }}">
                    <i class="fa-solid fa-pencil"></i>
                </button>
                @include('admin.categories.update')
            </td>
            {{-- delete --}}
            <td>
                <button class="btn btn-sm btn-outline-danger ms-1" data-bs-toggle="modal" data-bs-target="#delete-categ{{ $category->id }}">
                    <i class="fa-solid fa-trash-can"></i>
                </button>
                @include('admin.categories.actions')
            </td>
        </tr>
        @empty
        <tr><td class="text-center" colspan="5">No categories found</td></tr>
        @endforelse
        <tr>
            <td>0</td>
            <td>Uncategorized</td>
            <td>{{ $uncategorized_count }}</td>
            <td></td></td></td>
        </tr>

    </tbody>
</table>
{{-- page buttons --}}
{{ $all_categories->links() }}

@endsection
