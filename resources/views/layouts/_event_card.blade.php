<div class="tab_item">
    <div class="owl-carousel allevent owl-loaded owl-drag">
        <div class="owl-stage-outer">
            <div class="owl-stage">
                @foreach ($events as $ev)
                    @if (isset($filter) && $filter==false)
                        @include('layouts._event_item',['data'=>$ev,'category'=>$ev->category])
                    @else
                        @if ($ev->category_id == $filter->id)
                            @include('layouts._event_item',['data'=>$ev,'category'=>$filter])
                        @endif
                    @endif
                @endforeach
            </div>
        </div>

        <div class="owl-nav">
            <button type="button" role="presentation" class="owl-prev disabled">
                <img src="img/arow.png" alt="">
            </button>

            <button type="button" role="presentation" class="owl-next">
                <img src="img/arow.png" alt="">
            </button>
        </div>
    </div>
</div>