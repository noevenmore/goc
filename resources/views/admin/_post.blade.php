@extends('admin.app')
@section('title','Работа с юнитом')

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

    @include('admin._el',[
        'type'=>'check',
        'title'=>'Рекомендуемое',
        'name'=>'is_recomend',
        'value'=>'1',
        'checked'=>isset($data->is_recomend)?$data->is_recomend:true
    ])

    <div class="form-group">
        <label><strong>Категория:</strong></label>
        <select class="form-control" id="category_id" name="category_id" onchange="getCategoryInfo()">
            <option value="">-нет-</option>
            @foreach ($categorys as $el)
                <option value="{{$el->id}}" {{isset($data->category_id)&&$data->category_id==$el->id?'selected':''}}>{{$el->info[0]->name}}</option>
            @endforeach
        </select>
    </div>

    @include('admin._data_all')

    <div class="form-group">
        <label><strong>Изображения:</strong></label>
        <div id="imageloader" data-list="{{isset($images_list)?$images_list:""}}" data-type="post"></div>
    </div>

    <div id="fieldPhones">
    @include('admin._el',[
        'type'=>'text',
        'title'=>'Телефоны:',
        'name'=>'phones',
        'value'=>isset($data->phones)?$data->phones:'',
        'placeholder'=>'Введите значение...',
    ])
    </div>

    <div id="fieldEmail">
    @include('admin._el',[
        'type'=>'text',
        'title'=>'Почта:',
        'name'=>'email',
        'value'=>isset($data->email)?$data->email:'',
        'placeholder'=>'Введите значение...',
    ])
    </div>

    <div id="fieldLink">
    @include('admin._el',[
        'type'=>'text',
        'title'=>'Ссылка:',
        'name'=>'link',
        'value'=>isset($data->link)?$data->link:'',
        'placeholder'=>'Введите значение...',
    ])
    </div>

    <div id="fieldPrice">
    @include('admin._el',[
        'type'=>'number',
        'title'=>'Цена:',
        'name'=>'price',
        'value'=>isset($data->price)?$data->price:'',
        'placeholder'=>'Введите значение...',
    ])
    </div>

    <div id="fieldLength">
    @include('admin._el',[
        'type'=>'number',
        'title'=>'Длительность (мин):',
        'name'=>'length',
        'value'=>isset($data->length)?$data->length:'',
        'placeholder'=>'Введите значение...',
    ])
    </div>

    <div id="fieldWorkTimes">
    <label><strong>Время работы:</strong> (с 00:00 до 00:00 - выходной, с 00:00 до 23:59 - круглосуточно)</label>

    @php
    $daylist = ['Понедельник','Вторник','Среда','Четверг','Пятница','Суббота','Воскресенье'];  
    if (isset($data->work_times))
    {
        $wt = explode("|",$data->work_times);

        for ($i=0;$i<count($wt);$i++)
        {
            $wt0 = explode("-",$wt[$i]);

            $from_d[$i] = $wt0[0];
            $to_d[$i] = $wt0[1];
        }
    }
    @endphp

    @for ($i = 0; $i < 7; $i++)
    <div class="form-group">
            <label>{{$daylist[$i]}}:</label>
            <input placeholder="Время работы с..." class="form-control" type="time" name="from_d{{$i}}" value="{{isset($from_d[$i])?$from_d[$i]:''}}">
            <input placeholder="Время работы до..." class="form-control" type="time" name="to_d{{$i}}" value="{{isset($to_d[$i])?$to_d[$i]:''}}">
    </div>
    @endfor
    </div>

    <div id="fieldTimeBrackets">
        <div class="form-group">
            <label><strong>Дата начала события:</strong></label>
            <input type="text" name="start_at" class="form-control datapicker" placeholder="Выберите дату начала..."  value="{{isset($data->start_at)?$data->start_at:''}}">
        </div>

        <div class="form-group">
            <label><strong>Дата окончания события:</strong></label>
            <input type="text" name="end_at" class="form-control datapicker" placeholder="Выберите дату конца..."  value="{{isset($data->end_at)?$data->end_at:''}}">
        </div>
    </div>

    @include('admin._social')
    @include('admin._seo')

    <button class="btn btn-primary" type="submit">Ок</button>
</form>

@endsection