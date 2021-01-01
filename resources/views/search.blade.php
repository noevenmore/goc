@extends('layouts.app')

@section('content')
@include('layouts.header',['ex_page_text'=>__('Search on the site'),'ex_page_link'=>route('search')])

<section class="section section_about section_gallery">
    <div class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 section_map mb-5">
                    <div style="box-shadow: 1px 0 3px 3px rgba(0,0,0,.15);">
                    <form class="aside_serch" action="{{route('search')}}" method="GET">
                        <input name="t" type="text" value="{{isset($search)?$search:''}}">
                        <img src="img/searchG.png" alt="">
                    </form>
                </div>
                </div>
            </div>

            <div class="row">
                @foreach ($post->items() as $pi)
                @if ($pi->post)
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        <div class="card" style="min-height:1px;">
                            <div class="card_img">
                                <a href="{{route('post',['id'=>$pi->post->id,'slug'=>$pi->post->slug])}}">
                                    @if (isset($pi->post->photo) && count($pi->post->photo)>0)
                                    <img src="/upload/images/{{$pi->post->photo[0]->src}}" alt="">
                                    @else
                                    <img src="/img/no-images.png" alt="">
                                    @endif
                                </a>
                            </div>
                            <div class="card_wrapp">
                                <a href="{{route('post',['id'=>$pi->post->id,'slug'=>$pi->post->slug])}}" class="card_title">
                                    {{$pi->name}}
                                </a>

                                <div class="card_date" style="position: initial;">
                                    {{_lg($pi->post->category->info,'name')}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
                

                @include('pagination',['data'=>$post])
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
@endsection
