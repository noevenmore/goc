@if (count($langs)>0)
    @foreach ($langs as $lg)
        @include('admin._el',[
            'type'=>'mtext',
            'title'=>'Текст ('.$lg->name.'):',
            'name'=>'text_'.$lg->litera,
            'value'=>isset($param['text_'.$lg->litera])?$param['text_'.$lg->litera]:'',
            'placeholder'=>'Введите значение...',
        ])
    @endforeach
@else
    <div class="alert alert-danger text-center">Не добавлен ни 1 язык для заполнения текста</div>
@endif