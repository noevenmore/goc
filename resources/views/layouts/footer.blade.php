<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-12">
                <a class="logo" href="/"><img src="/img/logoF.png" alt=""></a>
            </div>

            @php
                $count = 0;
            @endphp

            <div class="col-lg-2 col-md-4 col-sm-6">
                @foreach ($menu_items as $mi)
                @php
                    $count++;
                @endphp

                @if ($count>12)
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        @php
                            $count = 0;
                        @endphp
                @endif
                
                <ul>
                    <li><a href="
                        @include('layouts.menu_link',['item'=>$mi])
                        " class="title">{{_lg($mi->info,'name')}}</a></li>

                        @foreach ($mi->childrens as $ch)
                            @php
                                $count++;
                            @endphp

                            <li><a href="
                                @include('layouts.menu_link',['item'=>$ch])
                                ">{{_lg($ch->info,'name')}}</a></li>
                        @endforeach
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</footer>
<div class="line">
    <div class="container line">
        <span>© 2020 Офіційний туристичний сайт міста Чернівці</span>
        <div class="social">
            <a href="#"><img src="/img/fb.png" alt=""></a>
            <a href="#"><img src="/img/insta.png" alt=""></a>
        </div>
    </div>
</div>