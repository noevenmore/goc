@php
    $t = 'none';

    if (isset($type)) $t=$type;
    if (isset($item->type)) $t=$item->type;

    switch ($t) {
        case 'gallery':
        echo '/gallery';
        break;
        
        case 'category':
        echo route('category',['id'=>$item->category_id,'slug'=>$item->slug]);
        break;

        case 'search':
        echo '/search';
        break;

        case 'post':
        echo route('post',['id'=>$item->post_id,'slug'=>$item->slug]);
        break;

        default:
        echo '/';
        break;
    }
@endphp