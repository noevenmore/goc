@extends('admin.app')
@section('title','Работа с местами')

@section('content')

<form action="{{$link}}" method="POST">
    @csrf

    @include('admin._el',[
        'type'=>'id',
        'value'=>isset($data->id)?$data->id:'0'
    ])

    <div class="form-group">
        <label><strong>Категория</strong></label>
        <select class="form-control" name="category_id">
            <option value="">-нет-</option>
            @foreach ($categorys as $el)
                <option value="{{$el->id}}" {{isset($data->category_id)&&$data->category_id==$el->id?'selected':''}}>{{$el->name}}</option>
            @endforeach
        </select>
    </div>

    @if (count($langs)>0)
    @include('admin._post_data')
    @else
    <div class="alert alert-danger text-center">Не добавлен ни 1 язык для заполнения названия, адресса и текста</div>
    @endif

    <div class="form-group">
        <label><strong>Изображения:</strong></label>
        <div id="imageloader" data-list="{{isset($images_list)?$images_list:""}}" data-type="post"></div>
    </div>

    @include('admin._el',[
        'type'=>'text',
        'title'=>'Телефоны',
        'name'=>'phones',
        'value'=>isset($data->phones)?$data->phones:'',
        'placeholder'=>'Введите значение...',
    ])

    @include('admin._el',[
        'type'=>'text',
        'title'=>'Почта',
        'name'=>'email',
        'value'=>isset($data->email)?$data->email:'',
        'placeholder'=>'Введите значение...',
    ])

    @include('admin._el',[
        'type'=>'text',
        'title'=>'Ссылка',
        'name'=>'link',
        'value'=>isset($data->link)?$data->link:'',
        'placeholder'=>'Введите значение...',
    ])

    @include('admin._el',[
        'type'=>'text',
        'title'=>'Цена',
        'name'=>'price',
        'value'=>isset($data->price)?$data->price:'',
        'placeholder'=>'Введите значение...',
    ])

    @include('admin._el',[
        'type'=>'text',
        'title'=>'Длительность',
        'name'=>'length',
        'value'=>isset($data->length)?$data->length:'',
        'placeholder'=>'Введите значение...',
    ])

    <label><strong>Время работы:</strong> (если указано время работы с 0 до 0 то будет написано что выходной)</label>

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

    <button class="btn btn-primary" type="submit">Ок</button>
</form>

@endsection