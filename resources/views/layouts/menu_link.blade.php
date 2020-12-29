@php
    switch ($item->type) {
        case 'gallery':
        echo '/gallery';
        break;
        
        case 'category':
        echo '/category/'.$item->category_id;
        break;

        case 'search':
        echo '/search';
        break;

        case 'post':
        echo '/post'.$item->post_id;
        break;

        default:
        echo '/';
        break;
    }
@endphp