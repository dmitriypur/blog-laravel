@extends('layouts.main')
@section('content')
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Post content -->
                <div class="col-md-8">
                    <div class="section-row sticky-container">
                        <div class="main-post">
                            <figure class="figure-img">
                                <img class="img-responsive" src="{{ asset('storage/' . $post->image) }}"
                                     alt="{{ $post->title }}">
                            </figure>
                            <p class="text-danger"><span
                                        class="text-success">{{  $post->dateAsCarbon->translatedFormat('F ') }}</span>{{ $post->dateAsCarbon->format(' d, Y') }}
                            </p>
                            {{ $post->dateAsCarbon->diffForHumans() }}
                            <div>
                                <h3>{{ $post->title }}</h3>
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
                                        <i class="fa fa-heart-o text-primary" aria-hidden="true"></i>
                                    </div>
                                @endguest
                            </div>

                            {!! $post->content !!}
                        </div>
                    </div>

                    <!-- ad -->
                    <div class="section-row text-center">
                        <a href="#" style="display: inline-block;margin: auto;">
                            <img class="img-responsive" src="./img/ad-2.jpg" alt="">
                        </a>
                    </div>
                    <!-- ad -->

                    <!-- author -->
                    <div class="section-row">
                        <div class="post-author">
                            <div class="media">
                                <div class="media-left">
                                    <img class="media-object" src="./img/author.png" alt="">
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <h3>Автор: {{ $post->user->name }}</h3>
                                    </div>
                                    <ul class="author-social">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /author -->

                    <!-- comments -->
                    <div class="section-row">
                        <div class="section-title">
                            <h2>Комментариев: {{ $post->comments->count() }}</h2>
                        </div>

                        <div class="post-comments">
                            <!-- comment -->
                            @foreach($post->comments as $comment)
                                <div class="media">
                                    <div class="media-left">
                                        <img class="media-object" src="./img/avatar.png" alt="">
                                    </div>
                                    <div class="media-body">
                                        <div class="media-heading">
                                            <h4>{{ $comment->user->name  }}</h4>
                                            <span class="time">{{ $comment->created_at }}</span>
                                            <a href="#" class="reply">Ответить</a>
                                        </div>
                                        <p>{{ $comment->message }}</p>
                                    </div>
                                </div>
                        @endforeach
                        <!-- /comment -->
                        </div>
                    </div>
                    <!-- /comments -->

                    <!-- reply -->
                    <div class="section-row">
                        @guest()
                            <div class="section-title">
                                <h2>Зарегистрируйтесь для того чтобы оставить комментарий</h2>
                            </div>
                        @endguest
                        @auth()
                            <div class="section-title">
                                <h2>Оставить комментарий</h2>
                            </div>
                            <form action="{{ route('post.comment.store', $post->id) }}" method="post"
                                  class="post-reply">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="input" name="message" placeholder="Message"></textarea>
                                        </div>
                                        <button class="primary-button">Отправить</button>
                                    </div>
                                </div>
                            </form>
                        @endauth
                    </div>
                    <!-- /reply -->
                </div>
                <!-- /Post content -->

                <!-- aside -->
                <div class="col-md-4">

                    <!-- post widget -->
                    <div class="aside-widget">
                        <div class="section-title">
                            <h2>Популярные</h2>
                        </div>

                        @foreach($likedPosts as $post)
                            <div class="post post-widget">
                                <a class="post-img" href="{{ route('post.show', $post->id) }}"><img
                                            src="{{ asset('storage/'. $post->image) }}" alt="{{ $post->title }}"></a>
                                <div class="post-body">
                                    <h3 class="post-title"><a
                                                href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></h3>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <!-- /post widget -->

                    <!-- post widget -->
                    <div class="aside-widget">
                        <div class="section-title">
                            <h2>Схожие посты</h2>
                        </div>
                        @foreach($relatedPosts as $relatedPost)
                            <div class="post post-thumb">
                                <a class="post-img" href="{{ route('post.show', $relatedPost->id) }}"><img
                                            src="{{ asset('storage/'. $relatedPost->image) }}" alt=""></a>
                                <div class="post-body">
                                    <div class="post-meta">
                                        <a class="post-category cat-3"
                                           href="#">{{ $relatedPost->category['title'] }}</a>
                                        <span class="post-date">{{  $relatedPost->created_at->translatedFormat('F d, Y') }}</span>
                                    </div>
                                    <h3 class="post-title"><a
                                                href="{{ route('post.show', $relatedPost->id) }}">{{ $relatedPost->title }}</a>
                                    </h3>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- /post widget -->

                    <!-- catagories -->
                    <div class="aside-widget">
                        <div class="section-title">
                            <h2>Категории</h2>
                        </div>
                        <div class="category-widget">
                            <ul>
                                @foreach($categories as $category)
                                    <li><a href="#" class="cat-1">{{ $category->title }}<span>4</span></a></li>
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
                                    <li><a href="#">{{ $tag->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- /tags -->

                    <!-- archive -->
                    <div class="aside-widget">
                        <div class="section-title">
                            <h2>Archive</h2>
                        </div>
                        <div class="archive-widget">
                            <ul>
                                <li><a href="#">January 2018</a></li>
                                <li><a href="#">Febuary 2018</a></li>
                                <li><a href="#">March 2018</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /archive -->
                </div>
                <!-- /aside -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
@endsection
