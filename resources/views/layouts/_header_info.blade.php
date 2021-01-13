<div class="header_advantages">			
    <div class="container">
        <div class="row">
            <div class="advantages">

                @if ($post->category->is_show_time_brackets)
                    <div class="advantages_item m-2" style="width: auto;">
                        <div class="advantages_img my-auto">
                            <img src="/img/calendar.png" alt="">
                        </div>
                        <div class="advantages_desc">
                            <div class="advantages_title">
                                {{__('Date of the event')}}:
                            </div>
                            <div class="advantages_subtitle">
                                @if ($post->start_at && $post->end_at)
                                    @if ($post->start_at == $post->end_at)
                                    {{date('d.m.Y',strtotime($post->start_at))}}
                                    @else
                                    {{date('d.m.Y',strtotime($post->start_at))}} - {{date('d.m.Y',strtotime($post->end_at))}}
                                    @endif
                                @else
                                    @if ($post->start_at)
                                    {{__('From')}} {{date('d.m.Y',strtotime($post->start_at))}}
                                    @else
                                        @if ($post->end_at)
                                        {{__('To')}} {{date('d.m.Y',strtotime($post->end_at))}}
                                        @else
                                        {{__('Unknown')}}
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endif


                @if ($post->category->is_show_work_times)
                    <div class="advantages_item m-2" style="width: auto;">
                        <div class="advantages_img my-auto">
                            <img src="/img/clock.png" alt="">
                        </div>
                        <div class="advantages_desc">
                            <div class="advantages_title">
                                {{__('Working time')}}:
                            </div>
                            <div class="advantages_subtitle">
                                @foreach ($work_times as $wt)
                                    <div class="advantages_subtitle">{{$wt}}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                @if ($post->category->is_show_addr)
                    <div class="advantages_item m-2" style="width: auto;">
                        <div class="advantages_img my-auto">
                            <img src="/img/pin.png" alt="">
                        </div>
                        <div class="advantages_desc">
                            <div class="advantages_title">
                                {{__('Address')}}:
                            </div>
                            <div class="advantages_subtitle">
                                {{_lg($post->info,'addr')}}
                            </div>
                        </div>
                    </div>
                @endif


                @if ($post->category->is_show_price)
                <div class="advantages_item m-2" style="width: auto;">
                    <div class="advantages_img my-auto">
                        <img src="/img/pin.png" alt="">
                    </div>
                    <div class="advantages_desc">
                        <div class="advantages_title">
                            {{__('Price')}}:
                        </div>
                        <div class="advantages_subtitle">
                            {{$post->price>0?$post->price.'₴':__('Free')}}
                        </div>
                    </div>
                </div>
            @endif


            @if ($post->category->is_show_length)
                <div class="advantages_item m-2" style="width: auto;">
                    <div class="advantages_img my-auto">
                        <img src="/img/clock.png" alt="">
                    </div>
                    <div class="advantages_desc">
                        <div class="advantages_title">
                            {{__('Duration')}}:
                        </div>
                        <div class="advantages_subtitle">
                            @include('layouts._time',['count'=>$post->length])
                        </div>
                    </div>
                </div>
            @endif


                @if ($post->category->is_show_phone)
                    <div class="advantages_item m-2" style="width: auto;">
                        <div class="advantages_img my-auto">
                            <img src="/img/clock.png" alt="">
                        </div>
                        <div class="advantages_desc">
                            <div class="advantages_title">
                                {{__('Phones')}}:
                            </div>
                            <div class="advantages_subtitle">
                                @php
                                    $phones = explode(';',$post->phones);
                                @endphp

                                @foreach ($phones as $wt)
                                    <div class="advantages_subtitle">{{$wt}}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <div class="advantages_item advantages_item--social" style="width: auto;">
                    @if ($post->category->is_show_link)
                        @php
                            $link_on_booking = stripos($post->link,'booking.');
                        @endphp

                        <a href="{{$post->link}}">{{$link_on_booking?__('Link on booking.com'):__('Link on site')}}</a>
                    @endif

                    @foreach ($social_links as $sl)
                    @if (strlen($sl->url)>0)
                        <a href="{{$sl->url}}" class="advantages_img my-auto">
                            <img src="{{$sl->parent->photo?"/upload/images/".$sl->parent->photo->src:"/img/no-images.png"}}" alt="">
                        </a>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>	
</div>