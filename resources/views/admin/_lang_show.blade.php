@extends('admin.app')
@section('title','Просмотр языков')

@section('content')
@include('admin._modal_delete')

    @if (!$data->items())
    <div class="alert alert-info text-center">
        Ничего нет
    </div>
    @endif


    <table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Обозначение</th>
        <th scope="col">Название</th>
        <th scope="col">Действия</th>
    </tr>
    </thead>
    <tbody>

    @foreach ($data as $d)
    <tr>
    <th scope="row">{{$d->id}}</th>
    <td>{{$d->litera}}</td>
    <td>{{$d->name}}</td>
    <td><a class="btn btn-sm btn-primary" href="{{route('admin_lang_edit',$d->id)}}">Редактировать</a>
        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ModalDeleteWindow" data-id="{{$d->id}}" data-url="{{route('admin_lang_delete_post')}}">Удалить</button>
    </tr>
    @endforeach

    </tbody>
    </table>

    {{ $data->links() }}
@endsection