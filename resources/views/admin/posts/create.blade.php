@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Добавить запись</h3>
                </div>
                <form id="add-post" method="post" action="{{ route('admin.post.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Заголовок" value="{{ old('title') }}">
                            @error('title')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Текст</label>
                            <textarea id="summernote" name="content" class="form-control" rows="3" placeholder="Текст">{{ old('title') }}</textarea>
                            @error('content')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Категория</label>
                            <select name="category_id" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Тэги</label>
                            <select class="select2" name="tag_ids[]" multiple="multiple" data-placeholder="Выбрать тэги" style="width: 100%;">
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Изображение</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="image" type="file" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="image">Выбрать</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <input id="is_published" class="form-check-input" type="checkbox" name="is_published">
                            <label for="is_published" class="form-check-label">Опубликовать</label>
                        </div>
                        <div class="form-check">
                            <input id="favorite" class="form-check-input" type="checkbox" name="favorite">
                            <label for="favorite" class="form-check-label">Вывести на главной</label>
                        </div>
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection