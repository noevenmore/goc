@extends('admin.app')
@section('title','Работа с языком')

@section('content')

<form action="{{$link}}" method="POST">
    @csrf

    @include('admin._el',[
        'type'=>'id',
        'value'=>isset($data->id)?$data->id:'0'
    ])

    @include('admin._el',[
        'type'=>'text',
        'title'=>'Обозначение',
        'name'=>'litera',
        'value'=>isset($data->litera)?$data->litera:'',
        'placeholder'=>'Введите значение...',
    ])

    @include('admin._el',[
        'type'=>'text',
        'title'=>'Название',
        'name'=>'name',
        'value'=>isset($data->name)?$data->name:'',
        'placeholder'=>'Введите значение...',
    ])

    <button class="btn btn-primary" type="submit">Ок</button>
</form>

@endsection