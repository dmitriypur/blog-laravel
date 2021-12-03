@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Редактировать запись</h3>
                </div>
                <form method="post" action="{{ route('admin.comment.update', $comment->id) }}"enctype="multipart/form-data" >
                    @csrf
                    @method('patch')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Текст</label>
                            <textarea id="summernote" name="message" class="form-control" rows="10">{{ $comment->message }}</textarea>
                            @error('content')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-check">
                            <input id="is_published" {{ $comment->is_published ? 'checked' : '' }} class="form-check-input" type="checkbox" name="is_published">
                            <label for="is_published" class="form-check-label">Опубликовать</label>
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