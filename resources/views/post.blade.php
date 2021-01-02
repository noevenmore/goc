@extends('layouts.app')

@section('content')
@include('layouts.header',['show_info'=>true])
<!--
<div class="container">
    <div class="row">
        <div class="col-lg-12 my-5 mx-2">
        -->
            {!! _lg($post->info,'text') !!}
        <!--
        </div>
    </div>
</div>
-->

@include('layouts.footer')
@endsection