@extends('layouts.app')

@section('content')
<div class="container">

<div class="mainpage">



    <div class="row">
        <div class="col-lg-12">
            
            <div class="row mb-2">
                <div class="col-lg-2 col-md-4">
                    <div id="0" class="draggable ui-state-highlight w-100">Drag me down</div>
                </div>

                <div class="col-lg-2 col-md-4">
                    <div id="1" class="draggable ui-state-highlight w-100">Drag me down</div>
                </div>
            </div>
                

            <div id="sample0" style="display: none;">
                <label>Name</label>
                <input type="text" class="form-control ttest" name="abc" value="test">
            </div>

                <div id="sample1" style="display: none;">
                    @include('admin._el1')
                    </div>
                


                    <!--
<form action="{{route('test')}}" method="POST">
    @csrf
-->
<div class="sortable" style="min-height: 400px">

</div>


<button onclick="sendData()">Send</button>

<!--
<button type="submit">submit</button>
</form>
-->
</div>
</div>
</div>
</div>
  
@endsection