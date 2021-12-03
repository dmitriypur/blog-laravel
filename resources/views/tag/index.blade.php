@extends('layouts.main')
@section('content')
    <!-- section -->
    <div class="section">
        <div class="container">
            <h1>Категории</h1>
            <div class="row">
                <div class="col-md-8">
                    <ul>
                        @foreach($tags as $tag)
                            <li><a href="{{ route('tag.post.index', $tag->id) }}" class="cat-1">{{ $tag->title }}<span>{{ $tag->posts->count() }}</span></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
