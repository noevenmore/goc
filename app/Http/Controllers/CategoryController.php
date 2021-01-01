<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lang;
use App\Models\LangData;
use App\Models\Photo;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $event->slug = '';
        $event->parent_id = $this->get_param('parent_id',0,$request);
        $event->is_show_main = $this->get_param('is_show_main',false,$request); 
        $event->is_show_addr = $this->get_param('is_show_addr',false,$request);
        $event->is_show_phone = $this->get_param('is_show_phone',false,$request);
        $event->is_show_link = $this->get_param('is_show_link',false,$request);
        $event->is_show_email = $this->get_param('is_show_email',false,$request);
        $event->is_show_work_times = $this->get_param('is_show_work_times',false,$request);
        $event->is_show_price = $this->get_param('is_show_price',false,$request);
        $event->is_show_length = $this->get_param('is_show_length',false,$request);
        $event->is_show_time_brackets = $this->get_param('is_show_time_brackets',false,$request);

        $event->save();

        $langs = Lang::get();

        foreach ($langs as $lg)
        {
            $d = LangData::where(['type'=>'category','data_id'=>$event->id,'lang_id'=>$lg->id])->first();
            if (!$d)
            {
                $d = new LangData;
                $d->type='category';
                $d->data_id = $event->id;
                $d->lang_id = $lg->id;
            }

            $d->name = $this->get_param('name_'.$lg->litera,'',$request);
            $d->addr = $this->get_param('addr_'.$lg->litera,'',$request);
            $d->text = $this->get_param('text_'.$lg->litera,'',$request);

            $d->save();
        }

        $dd = LangData::where(['type'=>'category','data_id'=>$event->id])->first();

        if ($dd)
        $event->slug = str_slug($dd->name);
        else $event->slug = '';

        $event->save();

        PhotoController::publish_images($event->id,'category');
    }

    public function show(Request $request)
    {
        $data = Category::paginate(10);

        return view('admin._category_show',compact('data'));
    }

    public function add(Request $request)
    {
        $link=route('admin_category_add_post');
        $categorys = Category::get();
        $langs = Lang::get();

        $photos=Photo::where(['type'=>'category','data_id'=>0])->get();

        $images_list = '';
        foreach ($photos as $ph)
        {
            $images_list = $images_list . $ph->src . ';';
        }

        return view('admin._category',compact('link','langs','categorys','images_list'));
    }

    public function add_post(Request $request)
    {
        $data = new Category;
        $this->save_event_from_request($data,$request);

        return redirect(route('admin_category_show'));
    }

    public function edit(Request $request,$id)
    {
        $data = Category::where('id',$id)->first();

        if (!$data) return abort(404);

        $categorys = Category::get();

        $link=route('admin_category_edit_post');

        $langs = Lang::get();
        $ld = LangData::with('lang')->where(['type'=>'category','data_id'=>$id])->get();
        $param = [];

        foreach ($ld as $p)
        {
            $param['name_'.$p->lang->litera]=$p->name;
            $param['addr_'.$p->lang->litera]=$p->addr;
            $param['text_'.$p->lang->litera]=$p->text;
        }

        $photos=Photo::where(['type'=>'category','data_id'=>$id])->get();

        $images_list = '';
        foreach ($photos as $ph)
        {
            $images_list = $images_list . $ph->src . ';';
        }

        return view('admin._category',compact('data','link','categorys','images_list','langs','param'));
    }

    public function edit_post(Request $request)
    {
        $id = $request->input('id');
        $data = Category::where('id',$id)->first();

        if (!$data) return abort(404);
        $this->save_event_from_request($data,$request);

        return redirect(route('admin_category_show'));
    }

    public function delete_post(Request $request)
    {
        $id = $request->input('id');
        $data = Category::where('id',$id)->first();

        if (!$data) return json_encode(['success'=>false,'message'=>'not found']);
        
        PhotoController::delete_images_with_type_and_id('category',$id);

        $ld = LangData::where(['type'=>'category','data_id'=>$id])->get();
        foreach ($ld as $l) $l->delete();

        $data->delete();

        return json_encode(['success'=>true]);
    }

    public function info(Request $request)
    {
        $id = $request->input('id');
        $data = Category::where('id',$id)->first();

        if (!$data) return json_encode(['success'=>false,'message'=>'not found']);

        return json_encode(['success'=>true,'data'=>$data]);
    }
}
