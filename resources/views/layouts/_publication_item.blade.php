@if (isset($is_big) && $is_big)
<div class="col-xl-6 col-lg-6 col-md-12">
    <div class="card card--max">
@else
<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
    <div class="card">
@endif
        <div class="card_img">
            <a href="{{route('post',['id'=>$data->id,'slug'=>$data->slug])}}">
                @if (isset($data->photo[0]->src))
                    <img src="/upload/images/{{$data->photo[0]->src}}" alt="">
                @else
                    <img src="/img/no-images.png" alt="">
                @endif
            </a>
        </div>
        <div class="card_wrapp">
            <a href="{{route('post',['id'=>$data->id,'slug'=>$data->slug])}}" class="card_title">
                {{_lg($data->info,'name')}}
            </a>
            <div class="card_subtitle">
                
            </div>
            <div class="card_date">
                {{date('d.m.Y',strtotime($data->created_at))}}
            </div>
        </div>
    </div>
</div>