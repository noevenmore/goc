@extends('admin.app')
@section('title','Работа со слайдером')

@section('content')

<form action="{{$link}}" method="POST">
    @csrf

    @include('admin._el',[
        'type'=>'id',
        'value'=>isset($data->id)?$data->id:'0'
    ])

    @include('admin._el',[
        'type'=>'check',
        'title'=>'Показывать на сайте',
        'name'=>'is_show',
        'value'=>'1',
        'checked'=>isset($data->is_show)?$data->is_show:true
    ])

    @include('admin._data_text')

    <div class="form-group">
        <label><strong>Изображения:</strong></label>
        <div id="imageloader" data-list="{{isset($images_list)?$images_list:""}}" data-type="mp_slider"></div>
    </div>

    <button class="btn btn-primary" type="submit">Ок</button>
</form>

@endsection