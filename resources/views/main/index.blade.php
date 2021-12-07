@extends('layouts.main')
@section('content')
    <!-- section -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <!-- post -->
                        <div class="col-md-12">
                            <div class="post post-thumb">
                                <a class="post-img" href="{{ route('post.show', $postFavorite->id) }}"><img
                                            src="{{ asset('uploads/' . $postFavorite->image) }}"
                                            alt=""></a>
                                <div class="post-body">
                                    <div class="post-meta">
                                        <a class="post-category cat-3"
                                           href="{{ route('category.post.index', $postFavorite->category->id) }}">{{ $postFavorite->category->title }}</a>
                                        <span class="post-date">{{ $postFavorite->dateAsCarbon->translatedFormat('F d, Y') }}</span>
                                    </div>
                                    <h3 class="post-title"><a
                                                href="{{ route('post.show', $postFavorite->id) }}">{{ $postFavorite->title }}</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!-- /post -->
                    </div>
                </div>

                <div class="col-md-4">

                    <!-- catagories -->
                    <div class="aside-widget">
                        <div class="section-title">
                            <h2>Категории</h2>
                        </div>
                        <div class="category-widget">
                            <ul>
                                @foreach($categories as $category)
                                    <li><a href="{{ route('category.post.index', $category->id) }}"
                                           class="cat-1">{{ $category->title }}
                                            </a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- /catagories -->

                    <!-- tags -->
                    <div class="aside-widget">
                        <div class="tags-widget">
                            <ul>
                                @foreach($tags as $tag)
                                    <li><a href="{{ route('tag.post.index', $tag->id) }}">{{ $tag->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- /tags -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2>Recent Posts</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <a class="post-img" href="{{ route('cabinet.post.create') }}">
                        <div class="post add-post">
                            Добавить пост
                        </div>
                    </a>

                </div>

                @foreach($posts as $post)
                    <div class="col-md-4">
                        <div class="post">
                            <a class="post-img" href="{{ route('post.show', $post->id) }}">
                                <img src="{{ asset('uploads/'. $post->image) }}" alt="">
                            </a>
                            <div class="post-body">
                                <div class="post-meta">
                                    <a class="post-category cat-1" href="category.html">{{ $post->title }}</a>
                                    <span class="post-date">{{ $post->dateAsCarbon->translatedFormat('F d, Y') }}</span>
                                    @auth()
                                        <form class="add-like" action="{{ route('post.like.store', $post->id) }}"
                                              method="post">
                                            @csrf
                                            <button type="submit" class="like-btn text-primary" data-ico="bookmark"
                                                    data-like="0">
                                                @if(auth()->user()->likedPosts->contains($post->id))
                                                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-bookmark-o" aria-hidden="true"></i>
                                                @endif
                                            </button>
                                        </form>
                                    @endauth
                                    @guest()
                                        <div>
                                            <i class="fa fa-bookmark-o" aria-hidden="true"></i>
                                        </div>
                                    @endguest
                                </div>
                                <form class="add-like" action="{{ route('post.like2.store', $post->id) }}"
                                      method="post">
                                    @csrf
                                    <span class="text-primary like-count">{{ $post->likes_count }}</span>
                                    <button type="submit" class="like-btn text-primary" data-ico="heart" data-like="0">
                                        @if($post->likes->contains('user_ip', $post->ipUser()))
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        @else
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        @endif
                                    </button>
                                </form>
                                <span>Количество просмотров: {{$post->view_count}}</span>
                                <h3 class="post-title"><a href="blog-post.html">{{ $post->category->title }}</a></h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
