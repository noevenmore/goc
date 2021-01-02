@if ($event_category_id)
<section class="section section_events">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3">
                <div class="section_title">
                    {{__('Events')}}
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="events">
                    <div class="wrapper row">
                        <div class="tabs col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                            <div class="tabs_wrapp">
                                <span class="tab active">{{__('All events')}}</span>

                                @foreach ($categorys->childrens as $cc)
                                    <span class="tab active">{{_lg($cc->info,'name')}}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab_content col-xl-8 col-lg-8 col-md-9 col-sm-12 col-12">
                            @include('layouts._event_card',['categorys'=>$categorys,'events'=>$events,'filter'=>false])

                            @foreach ($categorys->childrens as $cc)
                                @include('layouts._event_card',['categorys'=>$categorys,'events'=>$events,'filter'=>$cc])
                            @endforeach
                        </div>



                        <div class="col-12">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <a href="{{route('category',$event_category_id)}}" class="float_link">
                                            {{__('Show all events')}}
                                            <img src="img/arowg.png" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@else
<h2 class="my-5">[-No events category selected-]</h2>
@endif