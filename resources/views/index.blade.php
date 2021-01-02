@extends('layouts.app')

@section('content')
@include('layouts.header',['is_main_page'=>true])
@include('layouts._categorys')
@include('layouts._events')
@include('layouts._publication')
@include('layouts.footer')
@endsection