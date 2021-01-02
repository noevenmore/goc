<section class="section	section_event">
    <div class="container">
        <div class="row">

            @php
            $count=0;   
            @endphp

            @foreach ($main_page_categorys as $mc)
            @php
            $count++;   
            @endphp
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                    <div class="cart cartz">
                        <div class="cart_img" style="display: none;">
                            @if (isset($mc->photo[0]->src))
                            <img src="/upload/images/{{$mc->photo[0]->src}}" alt="">
                            @else
                            <img src="/img/no-images.png" alt="">
                            @endif
                        </div>
                        <div class="cart_info">
                            <div class="cart_title">
                                {{_lg($mc->info,'name')}} <span>{{$count<10?'0'.$count:$count}}</span>
                            </div>
                            <div class="cart_link" style="background-color: transparent;">
                                <a href="{{route('category',['id'=>$mc->id,'slug'=>$mc->slug])}}">перейти <img src="img/arowg.png" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>