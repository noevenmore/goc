@extends('admin.app')
@section('title','Работа с меню')

@section('content')

<form action="{{$link}}" method="POST">
    @csrf

    @include('admin._el',[
        'type'=>'id',
        'value'=>isset($data->id)?$data->id:'0'
    ])

    <div class="form-group">
        <label><strong>Родительская категория:</strong></label>
        <select class="form-control" name="parent_id">
            <option value="">-нет-</option>
            @foreach ($menus as $el)
                @if (!isset($data->id) || $data->id!=$el->id)
                    <option value="{{$el->id}}" {{isset($data->parent_id)&&$data->parent_id==$el->id?'selected':''}}>{{$el->info[0]->name}}</option>
                @endif
            @endforeach
        </select>
    </div>



    <div class="form-group">
        <label><strong>Ссылается на:</strong></label>
        <select class="form-control" name="type">
            <option value="">-нет-</option>
            
            <option value="category" {{isset($data->type)&&$data->type=="category"?'selected':''}}>Категорию</option>
            <option value="post" {{isset($data->type)&&$data->type=="post"?'selected':''}}>Юнит</option>
            <option value="gallery" {{isset($data->type)&&$data->type=="gallery"?'selected':''}}>Галлерея</option>
            <option value="search" {{isset($data->type)&&$data->type=="search"?'selected':''}}>Поиск</option>
        </select>
    </div>


    <div class="form-group">
        <label><strong>Ссылается на категорию:</strong></label>
        <select class="form-control" name="category_id">
            <option value="0">-нет-</option>
            @foreach ($categorys as $el)
                <option value="{{$el->id}}" {{isset($data->category_id)&&$data->category_id==$el->id?'selected':''}}>{{$el->info[0]->name}}</option>
            @endforeach
        </select>
    </div>


    <div class="form-group">
        <label><strong>Ссылается на юнит:</strong></label>
        <select class="form-control" name="post_id">
            <option value="0">-нет-</option>
            @foreach ($posts as $el)
                <option value="{{$el->id}}" {{isset($data->post_id)&&$data->post_id==$el->id?'selected':''}}>{{$el->info[0]->name}}</option>
            @endforeach
        </select>
    </div>

    @if (count($langs)>0)
        @include('admin._data_name')
    @else
        <div class="alert alert-danger text-center">Не добавлен ни 1 язык для заполнения названия</div>
    @endif

    @include('admin._el',[
        'type'=>'check',
        'title'=>'Выделять как главное меню',
        'name'=>'is_main',
        'value'=>'1',
        'checked'=>isset($data->is_main)?$data->is_main:true
    ])

    @include('admin._el',[
        'type'=>'number',
        'title'=>'Позиция (больше - выше):',
        'name'=>'position',
        'value'=>isset($data->position)?$data->position:'',
        'placeholder'=>'Введите значение...',
    ])

    <button class="btn btn-primary" type="submit">Ок</button>
</form>

@endsection