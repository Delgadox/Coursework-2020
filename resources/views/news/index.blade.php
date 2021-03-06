@extends('layouts.admin')

@section('content')
    <div class="row" style="margin-top: 5rem;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Панель Администратора</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('news.create') }}"> Опубликовать новость</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Текст</th>
            <th>Изображение</th>
            <th>Пользователь</th>
            <th>ID сообщения телеграм</th>
            <th width="340px">Действия</th>
        </tr>
        @foreach ($data as $key => $value)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ \Str::limit($value->text, 100) }}</td>
            <td><img src="{{ asset('storage/images/' . $value->file_image) }}" alt="{{$value->name}}" width="250px"></td>
            <td><a href="{{ route('users.show', $users[$value->user_id]->id) }}"> {{ $users[$value->user_id]->name }}</a></td>
            <td>{{ $value->message_id }}</td>
            <td>
                <form action="{{ route('news.destroy',$value->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('news.show',$value->id) }}">Показать</a>
                    <a class="btn btn-primary" href="{{ route('news.edit',$value->id) }}">Изменить</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $data->links() !!}
@endsection
