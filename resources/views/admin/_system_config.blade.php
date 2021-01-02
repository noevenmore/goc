@extends('admin.app')
@section('title','Настройка системы')

@section('content')

@if(session()->get('saved'))
    <div class="alert alert-success text-center">Сохранено!</div>
@endif

<form action="{{$link}}" method="POST">
    @csrf

    <div class="form-group">
        <label><strong>Категория событий:</strong></label>
        <select class="form-control" name="category_event_id">
            <option value="0">-нет-</option>
            @foreach ($categorys as $el)
                <option value="{{$el->id}}" {{isset($category_event_id)&&$category_event_id==$el->id?'selected':''}}>{{$el->info[0]->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label><strong>Категория публикаций:</strong></label>
        <select class="form-control" name="category_publication_id">
            <option value="0">-нет-</option>
            @foreach ($categorys as $el)
                <option value="{{$el->id}}" {{isset($category_publication_id)&&$category_publication_id==$el->id?'selected':''}}>{{$el->info[0]->name}}</option>
            @endforeach
        </select>
    </div>


    <button class="btn btn-primary" type="submit">Ок</button>
</form>

@endsection