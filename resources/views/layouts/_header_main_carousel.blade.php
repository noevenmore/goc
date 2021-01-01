<div class="header_slider">
    <div class="owl-carousel slider main-slider">
        @php
        $slide_id = 0;   
        @endphp

        @foreach ($mp_sliders as $sl)
            <div class="item">
                <div class="h1">
                    {{_lg($sl->info,'text')}}
                </div>

                <img class="slide_img_id{{$slide_id}}" src="{{$sl->photo?"/upload/images/".$sl->photo->src:"/img/slider.jpg"}}" hidden>
                @php
                $slide_id++;   
                @endphp
            </div>
        @endforeach
    </div>
</div>