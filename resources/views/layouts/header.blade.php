<nav class="header_nav mobile nav">
    <ul class="header_menu">
        @foreach ($menu_items as $mi)
            <li class="header_menu-item">
                <a href="
                @include('layouts.menu_link',['item'=>$mi])
                " class="header_menu-link">{{_lg($mi->info,'name')}}</a>
            </li>

            @if ($mi->childrens)
                <div class="submenu_wrapp">
                    <ul>
                        @foreach ($mi->childrens as $ch)
                        <li>
                            <a href="
                            @include('layouts.menu_link',['item'=>$ch])
                            ">{{_lg($ch->info,'name')}}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endforeach
    </ul>
</nav>

<header class="header"
@if(isset($images) && count($images)>0)
style="background-image: url(/upload/images/{{$images[0]->src}});"
@else
style="background-image: url(/img/slider.jpg);"
@endif
>
    <div class="header_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-md-8 col-5">
                    <div class="header_logo">
                        <a href="/"><img src="/img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 d-lg-flex d-none">
                    <nav class="nav">
                        <ul class="menu">
                            @foreach ($menu_items as $mi)
                            <li class="menu_item menu_super_item" data-id="{{$mi->id}}"><a href="
                                @include('layouts.menu_link',['item'=>$mi])
                                " class="menu_link">{{_lg($mi->info,'name')}}</a></li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-4 col-7">
                    <div class="header_bar">
                        <div class="header_bar-item">
                            <div class="header_bar-lang">
                                <a href="#">
                                    @foreach ($system_var_langs as $lg)
                                        @if ($lg->id == $system_var_lang_id)    
                                        {{$lg->name}}
                                        @endif
                                    @endforeach
                                    <img src="/img/arrowW.png" alt="">
                                </a>

                                <div class="lang_toggle">
                                    @foreach ($system_var_langs as $lg)
                                        @if ($lg->id != $system_var_lang_id)
                                        <a href="{{route('language',$lg->litera)}}">{{$lg->name}}</a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="header_bar-item">
                            <a class="header_bar-like">
                                <img src="/img/heart.png" alt="">
                            </a>
                        </div>
                        <div class="header_bar-item">
                            <a class="header_bar-search">
                                <img src="/img/search.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="wrap_mnu">
        <div class="toggle_mnu">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="container">
        @isset($is_main_page)
            @include('layouts._header_main_carousel')
        @else
            @include('layouts._header_title',['post'=>isset($post)?$post:null,'category'=>isset($category)?$category:null])
        @endisset
    </div>

    <div class="header_submenu">
        @foreach ($menu_items as $mi)
            @if ($mi->childrens)
            <div class="submenu_wrapp menu_super_item_{{$mi->id}}">
                <ul>
                    @foreach ($mi->childrens as $ch)
                        <li>
                            <a href="
                            @include('layouts.menu_link',['item'=>$ch])
                            ">{{_lg($ch->info,'name')}}</a>
                        </li>
                    @endforeach
                </ul>

                <ul>
                    <li>
                        
                    </li>
                </ul>
            </div>
            @endif
        @endforeach
    </div>
    <input class="search_site" type="text" placeholder="Пошук на сайті">



    @if(isset($post->category) && !isset($category))
        @include('layouts._header_info')
    @endif
</header>