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
                            <p>{{ $post->dateAsCarbon->diffForHumans() }}</p>
                            <span>Количество просмотров: {{$post->view_count}}</span>
                            <ul style="display: flex; flex-wrap: wrap;">
                                Тэги:
                                @foreach($post->tags as $tag)
                                    <li>
                                        <a href="{{ route('tag.post.index', $tag->id) }}"
                                           style="padding: 5px; margin-right: 2px; color: dodgerblue;">{{ $tag->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div>
                                <h3>{{ $post->title }}</h3>
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

                        <div class="post-comments">
                            <!-- comment -->
                            @foreach($post->comments as $comment)
                                @if($comment->is_published)
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
                                @endif
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
                                            <textarea class="input" name="message" placeholder="Сообщение"></textarea>
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
                                           href="{{ route('category.post.index', $relatedPost->category->id) }}">{{ $relatedPost->category['title'] }}</a>
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
                                    <li><a href="{{ route('category.post.index', $category->id) }}"
                                           class="cat-1">{{ $category->title }}
                                            <span>{{ $category->posts->count() }}</span></a></li>
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
