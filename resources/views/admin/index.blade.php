@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ \App\Models\Category::all()->count() }}</h3>

                    <p>Категории</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-th-list"></i>
                </div>
                <a href="{{ route('admin.category.index') }}" class="small-box-footer">Смотреть <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ \App\Models\Tag::all()->count() }}</h3>

                    <p>Тэги</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tags"></i>
                </div>
                <a href="{{ route('admin.tag.index') }}" class="small-box-footer">Смотреть <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ \App\Models\Post::all()->count() }}</h3>
                    <p>Записи</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-file-alt"></i>
                </div>
                <a href="{{ route('admin.post.index') }}" class="small-box-footer">Смотреть <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ \App\Models\User::all()->count() }}</h3>

                    <p>Пользователи</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('admin.user.index') }}" class="small-box-footer">Смотреть <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
@endsection