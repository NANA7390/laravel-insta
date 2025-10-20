<div class="row mb-3 align-items-center">
    <div class="col-auto">
        {{-- heart/like button//  route require $post id --}}
        @if($post->isLiked())
        {{-- unlike --}}
        <form action="{{ route('like.destroy', $post->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn p-0 text-danger">
                <i class="fa-solid fa-heart"></i>
            </button>
        </form>   
        @else
        <form action="{{ route('like.store', $post->id) }}" method="post">
            @csrf
            <button type="submit" class="btn p-0">
                <i class="fa-regular fa-heart"></i>
            </button>
        </form>
        @endif
    </div>
    <div class="col-auto px-0">
 
        {{-- no. of likes --}}
        @if($post->likes->count() > 0)
            <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#likes-post-{{ $post->id }}">
                {{ $post->likes->count() }}
            </button>
            @include('user.posts.modals.likes')
        @else 
            0
        @endif 

    </div>
    <div class="col text-end">
        {{-- categories -- variable post connects with pivot table --}}
        @forelse($post->categoryPosts as $category_post)
        {{-- pivot table belongs to category and get name --}}
        <div class="badge bg-secondary bg-opacity-50">{{ $category_post->category->name }}</div>
        @empty
        <div class="badge bg-dark">Uncategorized</div>         
        @endforelse    
    </div>
</div>

{{-- post owner's name and description --}}
<a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $post->user->name }}</a>
{{-- small space between name and description --}}
&nbsp;

<span class="fw-light">{{ $post->description }}</span>
<p class="text-uppercase text-muted xsmall">{{date('M d, Y', strtotime($post->updated_at))}}</p>