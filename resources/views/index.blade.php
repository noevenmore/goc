@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col-lg-12 text-center">
        <div class="alert alert-info mt-5">Тут будет отображаться сайт</div>

        <a href="{{route('admin_index')}}" class="btn btn-primary">Admin panel</a>
    </div>
</div>
</div>
@endsection