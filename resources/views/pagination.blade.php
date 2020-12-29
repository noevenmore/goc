@isset($data)
<div id="pagination" class="container">
    <div class="row">
        <div class="col-12">
            {{$data->links('_pagination')}}
        </div>
    </div>
</div>
@endisset