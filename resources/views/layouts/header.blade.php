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
@isset($images)
style="background-image: url(../upload/images/{{$images[0]->src}});"
@else
style="background-image: url(../img/slider.jpg);"
@endisset
>
    <div class="header_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-md-8 col-5">
                    <div class="header_logo">
                        <a href="#"><img src="img/logo.png" alt=""></a>
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
                                @php
                                $lang_name = _lg($system_var_langs,'name');
                                @endphp
                                <a href="#">{{$lang_name}}<img src="img/arrowW.png" alt=""></a>
                                <div class="lang_toggle">
                                    @foreach ($system_var_langs as $lg)
                                        @if ($lg->name!=$lang_name)
                                        <a href="/lang/{{$lg->litera}}">{{$lg->name}}</a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="header_bar-item">
                            <a class="header_bar-like">
                                <img src="img/heart.png" alt="">
                            </a>
                        </div>
                        <div class="header_bar-item">
                            <a class="header_bar-search">
                                <img src="img/search.png" alt="">
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


        <div class="header_slider">
            <div class="owl-carousel slider">
                <div class="item">
                    <div class="h1">
                        чернівці - це про подорож з друзями 
                    </div>
                </div>
                <div class="item">
                    <div class="h1">
                        &nbsp;&nbsp;чернівці - це про подорож з друзями 1
                    </div>
                </div>
                <div class="item">
                    <div class="h1">
                        &nbsp;&nbsp;чернівці - це про подорож з друзями 2
                    </div>
                </div>
                <div class="item">
                    <div class="h1">
                        &nbsp;&nbsp;чернівці - це про подорож з друзями 3
                    </div>
                </div>
                <div class="item">
                    <div class="h1">
                        &nbsp;&nbsp;чернівці - це про подорож з друзями 4
                    </div>
                </div>
            </div>
        </div>
    </div>


<!--
    <div class="container">
        <div id="breadcrumbs" class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb">
                        <a href="#" class="main">Головна /</a><a href="#" class="main"> Події  /</a><a href="#" class="haschild">Чернівецький музей Володимира Івасюка</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_slider">
            <div class="banner">
                <div class="item">
                    <div class="h1">
                        ЧЕРНІВЕЦЬКИЙ МУЗЕЙ ВОЛОДИМИРА ІВАСЮКА
                    </div>
                </div>
            </div>
        </div>
    </div>
-->

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






<!--
<div class="header_advantages">			
    <div class="container">
        <div class="row">
            <div class="advantages">
                <div class="advantages_item">
                    <div class="advantages_img">
                        <img src="img/calendar.png" alt="">
                    </div>
                    <div class="advantages_desc">
                        <div class="advantages_title">
                            Дата проведення
                        </div>
                        <div class="advantages_subtitle">
                            26 грудня
                        </div>
                    </div>
                </div>
                <div class="advantages_item">
                    <div class="advantages_img">
                        <img src="img/pin.png" alt="">
                    </div>
                    <div class="advantages_desc">
                        <div class="advantages_title">
                            Адреса
                        </div>
                        <div class="advantages_subtitle">
                            {{_lg($ch->info,'addr')}}
                        </div>
                    </div>
                </div>
                <div class="advantages_item">
                    <div class="advantages_img">
                        <img src="img/clock.png" alt="">
                    </div>
                    <div class="advantages_desc">
                        <div class="advantages_title">
                            Часи відвідування
                        </div>
                        <div class="advantages_subtitle">
                            {{_lg($ch->info,'work_times')}}
                        </div>
                    </div>
                </div>
                <div class="advantages_item advantages_item--social">
                    <a href="#">Посилання на booking.com</a>
                    <a href="#" class="advantages_img">
                        <img src="img/insta1.png" alt="">
                    </a>
                    <a href="#" class="advantages_img">
                        <img src="img/fb1.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>	
</div>
-->





</header>