@if (count($langs)>0)
<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        @php
            $first = true;
        @endphp

        @foreach ($langs as $lg)
            <a class="nav-item nav-link {{$first?"active":""}}" data-toggle="tab" href="#nav-{{$lg->id}}" role="tab" aria-controls="nav-{{$lg->id}}" aria-selected="{{$first?"true":"false"}}">{{$lg->name}}</a>

            @php
                $first = false;
            @endphp
        @endforeach
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
        @php
            $first = true;
        @endphp

    @foreach ($langs as $lg)
        <div class="tab-pane fade {{$first?"show active":""}}" id="nav-{{$lg->id}}" role="tabpanel">
            @include('admin._el',[
                'type'=>'mtext',
                'title'=>'Текст:',// ('.$lg->name.'):',
                'name'=>'text_'.$lg->litera,
                'value'=>isset($param['text_'.$lg->litera])?$param['text_'.$lg->litera]:'',
                'placeholder'=>'Введите значение...',
            ])
        </div>

        @php
            $first = false;
        @endphp
    @endforeach
</div>
@else
    <div class="alert alert-danger text-center">Не добавлен ни 1 язык для заполнения текста</div>
@endif