@extends('cabinet.layouts.cabinet')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $posts->count() }}</h3>
                    <p>Мои записи</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-file-alt"></i>
                </div>
                <a href="{{ route('cabinet.post.index') }}" class="small-box-footer">Смотреть <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>23</h3>

                    <p>Комментарии</p>
                </div>
                <div class="icon">
                    <i class="fas fa-comments"></i>
                </div>
                <a href="{{ route('cabinet.comment') }}" class="small-box-footer">Смотреть <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Редактировать профиль</h3>
                </div>
                <form method="post" action="{{ route('cabinet.user.update', auth()->user()->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ auth()->user()->name }}">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" id="email" value="{{ auth()->user()->email }}">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-25">
                            <img src="{{ asset('uploads/'.auth()->user()->photo) }}" style="width: 100%;" alt="{{ auth()->user()->name }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Изображение</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="photo" type="file" class="custom-file-input" id="image" value="{{ auth()->user()->photo }}">
                                    <label class="custom-file-label" for="image">Выбрать</label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection