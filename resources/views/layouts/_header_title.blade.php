<div id="breadcrumbs" class="container">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumb">
                <a href="/" class="main">Головна /</a>
                
                @if (isset($category->parent_id) && $category->parent_id)
                <a href="{{route('category',$category->parent_id)}}" class="main"> {{_lg($category->parent,'name')}} /</a>
                @endif
                
                @if (isset($post->category) && $post->category)
                <a href="{{route('category',$post->category->id)}}" class="main"> {{_lg($post->category->info,'name')}} /</a>
                @endif
                    
                @if (isset($post->info) && $post->info)
                <a href="#" class="haschild">{{_lg($post->info,'name')}}</a>
                @endif

                @if (isset($category->info) && $category->info)
                <a href="#" class="haschild">{{_lg($category->info,'name')}}</a>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="header_slider">
    <div class="banner">
        <div class="item">
            <div class="h1">
                @if (isset($post->info) && $post->info)
                {{_lg($post->info,'name')}}
                @endif
            </div>
        </div>
    </div>
</div>