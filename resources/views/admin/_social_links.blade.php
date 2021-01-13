@extends('admin.app')
@section('title','Работа с социальными сетями')

@section('content')

<form action="{{$link}}" method="POST">
    @csrf

    @include('admin._el',[
        'type'=>'id',
        'value'=>isset($data->id)?$data->id:'0'
    ])

    @include('admin._el',[
        'type'=>'text',
        'title'=>'Имя:',
        'name'=>'name',
        'value'=>isset($data->name)?$data->name:'',
        'placeholder'=>'Введите значение...',
    ])

    <div class="form-group">
        <label><strong>Изображение:</strong></label>
        <div id="imageloader" data-list="{{isset($images_list)?$images_list:""}}" data-type="social"></div>
    </div>

    <button class="btn btn-primary" type="submit">Ок</button>
</form>

@endsection