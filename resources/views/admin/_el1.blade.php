<div class="tabs">
    @include('admin._el',[
        'type'=>'type',
        'value'=>'el1',
    ])

@include('admin._el',[
    'type'=>'label',
    'value'=>'Текст по центру',
])

<ul>
      <li><a href="#tabs-1">Русский</a></li>
      <li><a href="#tabs-2">English</a></li>
    </ul>
    <div id="tabs-1">
        @include('admin._el',[
            'type'=>'text',
            'title'=>'Название',
            'name'=>'input_lang1[]',
            'value'=>'',
            'placeholder'=>'Введите заголовок...',
        ])

        @include('admin._el',[
            'type'=>'mtext',
            'title'=>'Текст',
            'name'=>'input_lang1[]',
            'value'=>'',
            'placeholder'=>'Введите текст...',
        ])
    </div>

    <div id="tabs-2">
        @include('admin._el',[
            'type'=>'text',
            'title'=>'Название',
            'name'=>'input_lang2[]',
            'value'=>'',
            'placeholder'=>'Введите заголовок...',
        ])

        @include('admin._el',[
            'type'=>'mtext',
            'title'=>'Текст',
            'name'=>'input_lang2[]',
            'value'=>'',
            'placeholder'=>'Введите текст...',
        ])
    </div>

  </div>