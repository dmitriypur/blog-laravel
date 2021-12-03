@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Редактировать запись</h3>
                </div>
                <form method="post" action="{{ route('admin.post.update', $post->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Название</label>
                            <input type="text" name="title" class="form-control" id="title" value="{{ $post->title }}">
                            @error('title')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Текст</label>
                            <textarea id="summernote" name="content" class="form-control"
                                      rows="10">{{ $post->content }}</textarea>
                            @error('content')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Категория</label>
                            <select name="category_id" class="form-control">
                                @foreach($categories as $key => $category)
                                    <option
                                            {{ $post->category_id == $key ? 'selected' : '' }}
                                            value="{{ $key }}">{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Multiple</label>
                            <select class="select2" name="tag_ids[]" multiple="multiple" data-placeholder="Выбрать тэги" style="width: 100%;">
                                @foreach($tags as $key => $tag)
                                    <option @if(in_array($key, $post->tags->pluck('id')->all())) selected @endif value="{{ $key }}">{{ $tag }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-25">
                            <img src="{{ $post->getImage() }}" style="width: 100%;"
                                 alt="{{ $post->title }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Изображение</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="image" type="file" class="custom-file-input" id="image"
                                           value="{{ $post->image }}">
                                    <label class="custom-file-label" for="image">Выбрать</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <input id="is_published" {{ $post->is_published ? 'checked' : '' }} class="form-check-input"
                                   type="checkbox" name="is_published">
                            <label for="is_published" class="form-check-label">Опубликовать</label>
                        </div>
                        <div class="form-check">
                            <input id="favorite" {{ $post->favorite ? 'checked' : '' }} class="form-check-input"
                                   type="checkbox" name="favorite">
                            <label for="favorite" class="form-check-label">Вывести на главной</label>
                        </div>
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