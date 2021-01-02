<div class="owl-item">
    <a href="{{route('post',['id'=>$data->id,'slug'=>$data->slug])}}" class="item">
    <div class="allevent_cart allevent_cart-light"

    @if (isset($data->photo) && count($data->photo)>0)
    style="background-image: url(/upload/images/{{$data->photo[0]->src}});background-repeat:no-repeat;background-size:cover;"
    @else
    style="background-image: url(/img/no-images.png);background-repeat:no-repeat;background-size:cover;"
    @endif
    >
        <div class="allevent_img">
            <img src="/img/slider3.png" alt="">
        </div>
        <div class="allevent_description">
            <div class="allevent_wrap">
                <div class="allevent_subtitle">
                    {{_lg($category->info,'name')}}
                </div>
                <div class="allevent_date">
                    @if ($category->is_show_time_brackets)
                        @if ($data->start_at && $data->end_at)
                            @if ($data->start_at == $data->end_at)
                            {{date('d.m.Y',strtotime($data->start_at))}}
                            @else
                            {{date('d.m.Y',strtotime($data->start_at))}} - {{date('d.m.Y',strtotime($data->end_at))}}
                            @endif
                        @else
                            @if ($data->start_at)
                            {{__('From')}} {{date('d.m.Y',strtotime($data->start_at))}}
                            @else
                                @if ($data->end_at)
                                {{__('To')}} {{date('d.m.Y',strtotime($data->end_at))}}
                                @else
                                {{__('Unknown')}}
                                @endif
                            @endif
                        @endif
                    @endif
                </div>
            </div>
            <div class="allevent_title">
                {{_lg($data->info,'name')}}
                @if ($category->is_show_addr)
                    <span>{{_lg($data->info,'addr')}}</span>
                @endif
            </div>
        </div>
    </div>
    </a>
</div>