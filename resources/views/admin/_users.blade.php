@extends('admin.app')
@section('title','Работа с пользователями')

@section('content')

<form action="{{$link}}" method="POST">
    @csrf

    @include('admin._el',[
        'type'=>'id',
        'value'=>isset($data->id)?$data->id:'0'
    ])

    <div class="form-group">
        <label><strong>Тип пользователя:</strong></label>
        <select class="form-control" name="type">
            <option value="user" {{isset($data->type)&&$data->type=='user'?'selected':''}}>Пользователь</option>
            <option value="moder" {{isset($data->type)&&$data->type=='moder'?'selected':''}}>Модератор</option>
            <option value="editor" {{isset($data->type)&&$data->type=='editor'?'selected':''}}>Редактор</option>
            <option value="admin" {{isset($data->type)&&$data->type=='admin'?'selected':''}}>Администратор</option>
            <option value="root" {{isset($data->type)&&$data->type=='root'?'selected':''}}>Супер администратор</option>
        </select>
    </div>

    @include('admin._el',[
        'type'=>'text',
        'title'=>'Логин:',
        'name'=>'name',
        'value'=>isset($data->name)?$data->name:'',
        'placeholder'=>'Введите значение...',
        'readonly'=>true,
    ])

    @include('admin._el',[
        'type'=>'text',
        'title'=>'Почта:',
        'name'=>'email',
        'value'=>isset($data->email)?$data->email:'',
        'placeholder'=>'Введите значение...',
        'readonly'=>true,
    ])

    <button class="btn btn-primary" type="submit">Ок</button>
</form>

@endsection