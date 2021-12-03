@extends('layouts.main')
@section('content')
    <!-- section -->
    <div class="section">
        <div class="container">
            <h1>Категории</h1>
            <div class="row">
                <div class="col-md-8">
                    <ul>
                        @foreach($categories as $category)
                            <li><a href="{{ route('category.post.index', $category->id) }}" class="cat-1">{{ $category->title }}<span>{{ $category->posts->count() }}</span></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
