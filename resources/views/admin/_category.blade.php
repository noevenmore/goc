@extends('admin.app')
@section('title','Работа с категориями')

@section('content')

<form action="{{$link}}" method="POST">
    @csrf

    @include('admin._el',[
        'type'=>'id',
        'value'=>isset($data->id)?$data->id:'0'
    ])

    <div class="form-group">
        <label><strong>Родительская категория</strong></label>
        <select class="form-control" name="parent_id">
            <option value="">-нет-</option>
            @foreach ($categorys as $el)
                @if (!isset($data->id) || $data->id!=$el->id)
                    <option value="{{$el->id}}" {{isset($data->parent_id)&&$data->parent_id==$el->id?'selected':''}}>{{$el->info[0]->name}}</option>
                @endif
            @endforeach
        </select>
    </div>

    @include('admin._data_name')

    <div class="form-group">
        <label><strong>Изображения:</strong></label>
        <div id="imageloader" data-list="{{isset($images_list)?$images_list:""}}" data-type="category"></div>
    </div>

    @include('admin._el',[
        'type'=>'check',
        'title'=>'Показывать на главной странице',
        'name'=>'is_show_main',
        'value'=>'1',
        'checked'=>isset($data->is_show_main)?$data->is_show_main:true
    ])

    @include('admin._el',[
        'type'=>'check',
        'title'=>'Показывать адресс',
        'name'=>'is_show_addr',
        'value'=>'1',
        'checked'=>isset($data->is_show_addr)?$data->is_show_addr:true
    ])

    @include('admin._el',[
        'type'=>'check',
        'title'=>'Показывать телефоны',
        'name'=>'is_show_phone',
        'value'=>'1',
        'checked'=>isset($data->is_show_phone)?$data->is_show_phone:true
    ])

    @include('admin._el',[
        'type'=>'check',
        'title'=>'Показывать ссылку',
        'name'=>'is_show_link',
        'value'=>'1',
        'checked'=>isset($data->is_show_link)?$data->is_show_link:true
    ])

    @include('admin._el',[
        'type'=>'check',
        'title'=>'Показывать почту',
        'name'=>'is_show_email',
        'value'=>'1',
        'checked'=>isset($data->is_show_email)?$data->is_show_email:true
    ])



    @include('admin._el',[
        'type'=>'check',
        'title'=>'Показывать время работы',
        'name'=>'is_show_work_times',
        'value'=>'1',
        'checked'=>isset($data->is_show_work_times)?$data->is_show_work_times:true
    ])

    @include('admin._el',[
        'type'=>'check',
        'title'=>'Показывать цену',
        'name'=>'is_show_price',
        'value'=>'1',
        'checked'=>isset($data->is_show_price)?$data->is_show_price:true
    ])

    @include('admin._el',[
        'type'=>'check',
        'title'=>'Показывать дату начала-конца',
        'name'=>'is_show_time_brackets',
        'value'=>'1',
        'checked'=>isset($data->is_show_time_brackets)?$data->is_show_time_brackets:true
    ])

    @include('admin._el',[
        'type'=>'check',
        'title'=>'Показывать длительность проведения',
        'name'=>'is_show_length',
        'value'=>'1',
        'checked'=>isset($data->is_show_length)?$data->is_show_length:true
    ])

    <button class="btn btn-primary" type="submit">Ок</button>
</form>

@endsection