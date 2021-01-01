<?php

namespace App\Http\Controllers;

use App\Models\Lang;
use App\Models\LangData;
use Illuminate\Http\Request;
use App\Http\Controllers\PhotoController;
use App\Models\Photo;
use App\Models\MainPageSlider;

class MainPageSliderController extends Controller
{
    public function __construct()
    {
        // Only admin access
        $this->middleware('auth');
    }

    public function get_param($param,$default,Request $request)
    {
        $d = $request->input($param,$default);
        if (!$d) $d=$default;

        return $d;
    }

    public function save_event_from_request($event,Request $request)
    {
        $event->is_show = $this->get_param('is_show',false,$request);
        $event->save();

        $langs = Lang::get();

        foreach ($langs as $lg)
        {
            $d = LangData::where(['type'=>'mp_slider','data_id'=>$event->id,'lang_id'=>$lg->id])->first();
            if (!$d)
            {
                $d = new LangData;
                $d->type='mp_slider';
                $d->data_id = $event->id;
                $d->lang_id = $lg->id;
            }

            $d->name = $this->get_param('name_'.$lg->litera,'',$request);
            $d->addr = $this->get_param('addr_'.$lg->litera,'',$request);
            $d->text = $this->get_param('text_'.$lg->litera,'',$request);

            $d->save();
        }

        PhotoController::publish_images($event->id,'mp_slider');
    }

    public function show(Request $request)
    {
        $data = MainPageSlider::paginate(10);

        return view('admin._mp_slider_show',compact('data'));
    }

    public function add(Request $request)
    {
        $link=route('admin_mp_slider_add_post');
        $langs = Lang::get();

        $photos=Photo::where(['type'=>'mp_slider','data_id'=>0])->get();

        $images_list = '';
        foreach ($photos as $ph)
        {
            $images_list = $images_list . $ph->src . ';';
        }

        return view('admin._mp_slider',compact('link','langs','images_list'));
    }

    public function add_post(Request $request)
    {
        $data = new MainPageSlider;
        $this->save_event_from_request($data,$request);

        return redirect(route('admin_mp_slider_show'));
    }

    public function edit(Request $request,$id)
    {
        $data = MainPageSlider::where('id',$id)->first();

        if (!$data) return abort(404);

        $langs = Lang::get();
        $ld = LangData::with('lang')->where(['type'=>'mp_slider','data_id'=>$id])->get();
        $param = [];

        foreach ($ld as $p)
        {
            $param['text_'.$p->lang->litera]=$p->text;
        }

        $photos=Photo::where(['type'=>'mp_slider','data_id'=>$id])->get();

        $images_list = '';
        foreach ($photos as $ph)
        {
            $images_list = $images_list . $ph->src . ';';
        }

        $link=route('admin_mp_slider_edit_post');

        return view('admin._mp_slider',compact('data','link','langs','param','images_list'));
    }

    public function edit_post(Request $request)
    {
        $id = $request->input('id');
        $data = MainPageSlider::where('id',$id)->first();

        if (!$data) return abort(404);
        $this->save_event_from_request($data,$request);

        return redirect(route('admin_mp_slider_show'));
    }

    public function delete_post(Request $request)
    {
        $id = $request->input('id');
        $data = MainPageSlider::where('id',$id)->first();

        if (!$data) return json_encode(['success'=>false,'message'=>'not found']);
        
        $ld = LangData::where(['type'=>'mp_slider','data_id'=>$id])->get();
        foreach ($ld as $l) $l->delete();

        PhotoController::delete_images_with_type_and_id('mp_slider',$id);

        $data->delete();

        return json_encode(['success'=>true]);
    }
}
