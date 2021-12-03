@extends('cabinet.layouts.cabinet')

@section('content')
    <a href="{{ route('cabinet.post.create') }}" class="btn btn-primary mb-3">Добавить запись</a>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Записи</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">ID</th>
                            <th>Название</th>
                            <th>Опубликовано</th>
                            <th style="width: 200px">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td class="{{ $post->is_published ? 'text-success' : 'text-danger' }}">{{ $post->is_published ? 'Опубликовано' : 'На модерации' }}</td>
                                <td>
                                    <a href="{{ route('cabinet.post.edit', $post->id) }}" class="btn btn-primary btn-sm mr-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('cabinet.post.delete', $post->id) }}" method="post" style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection