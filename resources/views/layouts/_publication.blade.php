<section class="section section_about">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    {{__('Publications')}}
                </div>
            </div>
        </div>
    </div>
    <div class="about">
        <div class="container">
            <div class="row">
                @for ($i = 0; $i < min(count($publications),6); $i++)
                    @include('layouts._publication_item',['data'=>$publications[$i],'is_big'=>($i==2||$i==3)?true:false])
                @endfor

                <div class="col-12">
                    <a href="{{route('category',$category_publication_id)}}" class="float_link">
                        {{__('Show more publications')}}
                        <img src="img/arowg.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>