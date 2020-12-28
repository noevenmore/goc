@if (count($langs)>0)
    @foreach ($langs as $lg)
        @include('admin._el',[
            'type'=>'text',
            'title'=>'Название ('.$lg->name.'):',
            'name'=>'name_'.$lg->litera,
            'value'=>isset($param['name_'.$lg->litera])?$param['name_'.$lg->litera]:'',
            'placeholder'=>'Введите значение...',
        ])
    @endforeach
@else
    <div class="alert alert-danger text-center">Не добавлен ни 1 язык для заполнения названия</div>
@endif