<div class="header_advantages">			
    <div class="container">
        <div class="row">
            <div class="advantages">

                @if ($post->category->is_show_time_brackets)
                    <div class="advantages_item m-2">
                        <div class="advantages_img">
                            <img src="/img/calendar.png" alt="">
                        </div>
                        <div class="advantages_desc">
                            <div class="advantages_title">
                                Дата проведення
                            </div>
                            <div class="advantages_subtitle">
                                @if ($post->start_at && $post->end_at)
                                    {{date('d-m-Y',strtotime($post->start_at))}} - {{date('d-m-Y',strtotime($post->end_at))}}
                                @else
                                    @if ($post->start_at)
                                        С {{date('d-m-Y',strtotime($post->start_at))}}
                                    @else
                                        @if ($post->end_at)
                                            До {{date('d-m-Y',strtotime($post->end_at))}}
                                        @else
                                        Не відомо
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endif


                @if ($post->category->is_show_work_times)
                    <div class="advantages_item m-2">
                        <div class="advantages_img">
                            <img src="/img/clock.png" alt="">
                        </div>
                        <div class="advantages_desc">
                            <div class="advantages_title">
                                Робочі часи
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
                    <div class="advantages_item m-2">
                        <div class="advantages_img">
                            <img src="/img/pin.png" alt="">
                        </div>
                        <div class="advantages_desc">
                            <div class="advantages_title">
                                Адреса
                            </div>
                            <div class="advantages_subtitle">
                                {{_lg($post->info,'addr')}}
                            </div>
                        </div>
                    </div>
                @endif


                @if ($post->category->is_show_price)
                <div class="advantages_item m-2">
                    <div class="advantages_img">
                        <img src="/img/pin.png" alt="">
                    </div>
                    <div class="advantages_desc">
                        <div class="advantages_title">
                            Цена
                        </div>
                        <div class="advantages_subtitle">
                            {{$post->price}}
                        </div>
                    </div>
                </div>
            @endif


            @if ($post->category->is_show_length)
                <div class="advantages_item m-2">
                    <div class="advantages_img">
                        <img src="/img/clock.png" alt="">
                    </div>
                    <div class="advantages_desc">
                        <div class="advantages_title">
                            Длительность
                        </div>
                        <div class="advantages_subtitle">
                            {{$post->length}}
                        </div>
                    </div>
                </div>
            @endif


                @if ($post->category->is_show_phone)
                    <div class="advantages_item m-2">
                        <div class="advantages_img">
                            <img src="/img/clock.png" alt="">
                        </div>
                        <div class="advantages_desc">
                            <div class="advantages_title">
                                Телефони
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

                <div class="advantages_item advantages_item--social">
                    @if ($post->category->is_show_link)
                        <a href="{{$post->link}}">Посилання на сайт</a>
                    @endif

                    <a href="#" class="advantages_img">
                        <img src="/img/insta1.png" alt="">
                    </a>
                    <a href="#" class="advantages_img">
                        <img src="/img/fb1.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>	
</div>