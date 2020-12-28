@if (count($langs)>0)
    @foreach ($langs as $lg)
        @include('admin._el',[
            'type'=>'text',
            'title'=>'Название ('.$lg->name.'):',
            'name'=>'name_'.$lg->litera,
            'value'=>isset($param['name_'.$lg->litera])?$param['name_'.$lg->litera]:'',
            'placeholder'=>'Введите значение...',
        ])

        <div class="adress_field">
        @include('admin._el',[
            'type'=>'text',
            'title'=>'Адресс ('.$lg->name.'):',
            'name'=>'addr_'.$lg->litera,
            'value'=>isset($param['addr_'.$lg->litera])?$param['addr_'.$lg->litera]:'',
            'placeholder'=>'Введите значение...',
        ])
        </div>

        @include('admin._el',[
            'type'=>'stext',
            'title'=>'Текст ('.$lg->name.'):',
            'name'=>'text_'.$lg->litera,
            'value'=>isset($param['text_'.$lg->litera])?$param['text_'.$lg->litera]:'',
            'placeholder'=>'Введите значение...',
        ])
    @endforeach
@else
    <div class="alert alert-danger text-center">Не добавлен ни 1 язык для заполнения названия, адресса и текста</div>
@endif