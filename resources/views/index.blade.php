@extends('layouts.app')

@section('content')
@include('layouts.header',['is_main_page'=>true])
@include('layouts._events')
@include('layouts.footer')
@endsection