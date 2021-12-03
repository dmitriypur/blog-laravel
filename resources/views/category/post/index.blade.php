@extends('layouts.main')
@section('content')
    <!-- section -->
    <div class="section">
        <div class="container">
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-4">
                        <div class="post">
                            <a class="post-img" href="{{ route('post.show', $post->id) }}">
                                <img src="{{ asset('storage/'. $post->image) }}" alt="">
                            </a>
                            <div class="post-body">
                                <div class="post-meta">
                                    <a class="post-category cat-1" href="category.html">{{ $post->title }}</a>
                                    <span class="post-date">{{ $post->dateAsCarbon->translatedFormat('F d, Y') }}</span>
                                    @auth()
                                        <form action="{{ route('post.like.store', $post->id) }}" method="post">
                                            @csrf
                                            <span class="text-primary">{{ $post->liked_users_count }}</span>
                                            <button type="submit" class="like-btn text-primary">
                                                @if(auth()->user()->likedPosts->contains($post->id))
                                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                @endif
                                            </button>
                                        </form>
                                    @endauth
                                    @guest()
                                        <div>
                                            <span class="text-primary">{{ $post->liked_users_count }}</span>
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        </div>
                                    @endguest
                                </div>

                                <h3 class="post-title"><a href="blog-post.html">{{ $post->category->title }}</a></h3>
                                <ul style="display: flex; flex-wrap: wrap;">
                                    @foreach($post->tags as $tag)
                                        <li>
                                            <a href="blog-post.html"
                                               style="padding: 5px; margin-right: 2px;">{{ $tag->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
