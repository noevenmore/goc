<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lang;
use App\Models\LangData;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\MyFunctions;
use App\Http\Controllers\PhotoController;
use App\Models\Photo;

class PostController extends Controller
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
        //$event->name = $this->get_param('name','no_name',$request);

        $event->category_id = $this->get_param('category_id',0,$request);
        $event->price = $this->get_param('price',0,$request);
        $event->length = $this->get_param('length',0,$request);
        $event->type = '';//??
        $event->slug = '';
        $event->work_times=MyFunctions::work_days_from_request($request);

        $event->phones = $this->get_param('phones','',$request);
        $event->email = $this->get_param('email','',$request);
        $event->link = $this->get_param('link','',$request);

        $event->start_at = $this->get_param('start_at',null,$request);
        $event->end_at = $this->get_param('end_at',null,$request);
        $event->is_show = $this->get_param('is_show',false,$request);
        $event->is_recomend = $this->get_param('is_recomend',false,$request);

        //seo
        $event->seo_meta_title = $this->get_param('seo_meta_title','',$request);
        $event->seo_meta_description = $this->get_param('seo_meta_description','',$request);
        $event->seo_keywords = $this->get_param('seo_keywords','',$request);
        $event->seo_og_image = $this->get_param('seo_og_image','',$request);
        $event->seo_meta_twitter_image = $this->get_param('seo_meta_twitter_image','',$request);

        $event->save();

        $langs = Lang::get();

        foreach ($langs as $lg)
        {
            $d = LangData::where(['type'=>'post','data_id'=>$event->id,'lang_id'=>$lg->id])->first();
            if (!$d)
            {
                $d = new LangData;
                $d->type='post';
                $d->data_id = $event->id;
                $d->lang_id = $lg->id;
            }

            $d->name = $this->get_param('name_'.$lg->litera,'',$request);
            $d->addr = $this->get_param('addr_'.$lg->litera,'',$request);
            $d->text = $this->get_param('text_'.$lg->litera,'',$request);

            $d->save();
        }


        $dd = LangData::where(['type'=>'post','data_id'=>$event->id])->first();

        if ($dd)
        $event->slug = str_slug($dd->name);
        else $event->slug = '';

        $event->save();

        PhotoController::publish_images($event->id,'post');
    }

    public function show(Request $request)
    {
        $data = Post::with(['info','category'])->paginate(10);

        return view('admin._post_show',compact('data'));
    }

    public function add(Request $request)
    {
        $link=route('admin_post_add_post');
        $categorys = Category::get();
        $langs = Lang::get();

        $photos=Photo::where(['type'=>'post','data_id'=>0])->get();

        $images_list = '';
        foreach ($photos as $ph)
        {
            $images_list = $images_list . $ph->src . ';';
        }

        return view('admin._post',compact('link','categorys','langs','images_list'));
    }

    public function add_post(Request $request)
    {
        $data = new Post;
        $this->save_event_from_request($data,$request);

        return redirect(route('admin_post_show'));
    }

    public function edit(Request $request,$id)
    {
        $data = Post::where('id',$id)->first();

        if (!$data) return abort(404);

        $categorys = Category::get();

        $langs = Lang::get();
        $ld = LangData::with('lang')->where(['type'=>'post','data_id'=>$id])->get();
        $param = [];

        foreach ($ld as $p)
        {
            $param['name_'.$p->lang->litera]=$p->name;
            $param['addr_'.$p->lang->litera]=$p->addr;
            $param['text_'.$p->lang->litera]=$p->text;
        }

        $photos=Photo::where(['type'=>'post','data_id'=>$id])->get();

        $images_list = '';
        foreach ($photos as $ph)
        {
            $images_list = $images_list . $ph->src . ';';
        }

        $link=route('admin_post_edit_post');

        return view('admin._post',compact('data','link','categorys','langs','param','images_list'));
    }

    public function edit_post(Request $request)
    {
        $id = $request->input('id');
        $data = Post::where('id',$id)->first();

        if (!$data) return abort(404);
        $this->save_event_from_request($data,$request);

        return redirect(route('admin_post_show'));
    }

    public function delete_post(Request $request)
    {
        $id = $request->input('id');
        $data = Post::where('id',$id)->first();

        if (!$data) return json_encode(['success'=>false,'message'=>'not found']);
        
        $ld = LangData::where(['type'=>'post','data_id'=>$id])->get();
        foreach ($ld as $l) $l->delete();

        PhotoController::delete_images_with_type_and_id('post',$id);

        $data->delete();

        return json_encode(['success'=>true]);
    }
}
