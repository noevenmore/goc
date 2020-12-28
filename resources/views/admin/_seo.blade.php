<label><strong>SEO:</strong></label>

@include('admin._el',[
    'type'=>'text',
    'title'=>'SEO Meta Title:',
    'name'=>'seo_meta_title',
    'value'=>isset($data->seo_meta_title)?$data->seo_meta_title:'',
    'placeholder'=>'Введите значение...',
])

@include('admin._el',[
    'type'=>'text',
    'title'=>'SEO Meta Description:',
    'name'=>'seo_meta_description',
    'value'=>isset($data->seo_meta_description)?$data->seo_meta_description:'',
    'placeholder'=>'Введите значение...',
])

@include('admin._el',[
    'type'=>'text',
    'title'=>'SEO Keywords:',
    'name'=>'seo_keywords',
    'value'=>isset($data->seo_keywords)?$data->seo_keywords:'',
    'placeholder'=>'Введите значение...',
])

@include('admin._el',[
    'type'=>'text',
    'title'=>'SEO OG Image:',
    'name'=>'seo_og_image',
    'value'=>isset($data->seo_og_image)?$data->seo_og_image:'',
    'placeholder'=>'Введите значение...',
])

@include('admin._el',[
    'type'=>'text',
    'title'=>'SEO Meta Twitter Image:',
    'name'=>'seo_meta_twitter_image',
    'value'=>isset($data->seo_meta_twitter_image)?$data->seo_meta_twitter_image:'',
    'placeholder'=>'Введите значение...',
])