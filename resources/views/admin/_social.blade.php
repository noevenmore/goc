@if ($social)
<label><strong>Социальные сети:</strong></label>

@foreach ($social as $s)
    @include('admin._el',[
        'type'=>'text',
        'title'=>$s->name.':',
        'name'=>'social_'.$s->id,
        'value'=>isset($param['social_'.$s->id])?$param['social_'.$s->id]:'',
        'placeholder'=>'Введите значение...',
    ])
@endforeach
@endif