@foreach ($langs as $lg)
    @include('admin._el',[
        'type'=>'text',
        'title'=>'Название ('.$lg->name.'):',
        'name'=>'name_'.$lg->litera,
        'value'=>isset($param['name_'.$lg->litera])?$param['name_'.$lg->litera]:'',
        'placeholder'=>'Введите значение...',
    ])
@endforeach