@foreach($categories as $category)

    @if($category->where('is_published', 1)->count())
        <li>
            <a href="{{ route('category.post.index', $category->id) }}" class="cat-1">{{ $category->title }}</a>
            <span>{{ $category->posts->count() }}</span>
        </li>
    @endif

@endforeach