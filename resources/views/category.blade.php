@extends('layouts.app')

@section('content')
@include('layouts.header')

<section class="section section_about section_gallery">
    <div class="about">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-12">
                    <div class="navigation">
                        <ul>
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($subcategorys as $sc)

                            @php
                            $count++;

                            if ($count>4)
                            {
                                echo '</ul><ul>';
                                $count=0;
                            }
                            @endphp

                            <li><a class="navigation_link" href="{{route('category',['id'=>$sc->id,'slug'=>$sc->slug])}}">{{_lg($sc->info,'name')}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="sidebar">
                        <ul>
                            <li class="count">
                                2
                            </li>
                            <li class="search">
                                <a href="#" id=""><img src="/img/search.png" alt=""></a>
                            </li>
                            <li class="cancel">
                                <a href="#"><img src="/img/cancel.png" alt=""></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach ($post as $pi)
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        <div class="card" style="min-height:1px;">
                            <div class="card_img">
                                <a href="{{route('post',['id'=>$pi->id,'slug'=>$pi->slug])}}">
                                    @if (isset($pi->photo) && count($pi->photo)>0)
                                    <img src="/upload/images/{{$pi->photo[0]->src}}" alt="">
                                    @else
                                    <img src="/img/no-images.png" alt="">
                                    @endif
                                </a>
                            </div>
                            <div class="card_wrapp">
                                <a href="{{route('post',['id'=>$pi->id,'slug'=>$pi->slug])}}" class="card_title">
                                    {{_lg($pi->info,'name')}}
                                </a>
                                <!--
                                <div class="card_subtitle">
                                    {!!mb_strimwidth(_lg($pi->info,'text'),0,50,'...')!!}
                                </div>
                            -->
                                <div class="card_date" style="position: initial;">
                                    {{_lg($pi->category->info,'name')}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @include('pagination',['data'=>$post])


            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
@endsection
