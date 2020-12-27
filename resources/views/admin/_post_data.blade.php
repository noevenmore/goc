@foreach ($langs as $lg)
    @include('admin._el',[
        'type'=>'text',
        'title'=>'Название ('.$lg->name.')',
        'name'=>'name_'.$lg->litera,
        'value'=>isset($param['name_'.$lg->litera])?$param['name_'.$lg->litera]:'',
        'placeholder'=>'Введите значение...',
    ])

    @include('admin._el',[
        'type'=>'text',
        'title'=>'Адресс ('.$lg->name.')',
        'name'=>'addr_'.$lg->litera,
        'value'=>isset($param['addr_'.$lg->litera])?$param['addr_'.$lg->litera]:'',
        'placeholder'=>'Введите значение...',
    ])

    @include('admin._el',[
        'type'=>'stext',
        'title'=>'Текст ('.$lg->name.')',
        'name'=>'text_'.$lg->litera,
        'value'=>isset($param['text_'.$lg->litera])?$param['text_'.$lg->litera]:'',
        'placeholder'=>'Введите значение...',
    ])
@endforeach