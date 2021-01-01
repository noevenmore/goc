@extends('layouts.app')

@section('content')
@include('layouts.header',['simple_header'=>true])

<script src="https://maps.api.2gis.ru/2.0/loader.js?pkg=full"></script>
<script type="text/javascript">
    var map;

    DG.then(function () {
        map = DG.map('map', {
            center: [48.321822, 25.978984],

             
            zoom: 18
        });

        DG.marker([54.98, 82.89]).addTo(map).bindPopup('Вы кликнули по мне!');
        DG.marker([54.99, 82.89]).addTo(map).bindPopup('Я попап!');
    });
</script>

<div id="map" style="width:100%; height:600px;z-index:1;"></div>

<section class="section section_map" style="overflow: hidden;">
    <div class="aside"><!--"container aside" -->
        <div class="aside_wrapp">
            <div class="aside_header">
                <div id="breadcrumbs" class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="breadcrumb">
                                <a href="#" class="main">Головна /</a><a href="#" class="haschild">Визначні місця</a>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="aside_serch" action="{{route('search')}}" method="GET">
                    <input type="text">
                    <img src="img/searchG.png" alt="">
                </form>
                <div class="house owl-carousel owl-loaded owl-drag">
                <div class="owl-stage-outer">
                    <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0.25s ease 0s; width: 767px;"><div class="owl-item active" style="width: 117.75px; margin-right: 10px;">
                        <div class="item">
                        <div class="img">
                            <img src="img/recomend.png" alt="">
                        </div>
                        <div class="title">
                            Рекомендовані
                        </div>
                        </div>
                    </div>
                    
                    <div class="owl-item active" style="width: 117.75px; margin-right: 10px;"><div class="item">
                        <div class="img">
                            <img src="img/recomend2.png" alt="">
                        </div>
                        <div class="title">
                            Музеї
                        </div>
                        </div>
                    </div>
                
                
                </div></div>
                
                <div class="owl-nav"><button type="button" role="presentation" class="owl-prev disabled"><img src="img/arow.png" alt=""></button><button type="button" role="presentation" class="owl-next"><img src="img/arow.png" alt=""></button></div><div class="owl-dots disabled"></div></div>
            </div>

            <div class="aside_wrapper">
                <div class="card">
                    <div class="card_img">
                        <img src="img/cart.jpg" alt="">
                    </div>
                    <div class="card_wrapp">
                        <a href="#" class="card_title">
                            Галерея на Штейнбарга 
                        </a>
                        <div class="card_subtitle">
                            вулиця Штейнбарга, 23
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
@endsection