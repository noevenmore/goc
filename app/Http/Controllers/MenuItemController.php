<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lang;
use App\Models\LangData;
use App\Models\MenuItem;
use App\Models\Post;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function get_param($param,$default,Request $request)
    {
        $d = $request->input($param,$default);
        if (!$d) $d=$default;

        return $d;
    }

    public function save_event_from_request($event,Request $request)
    {
        //$event->name = $this->get_param('name','no_name',$request);
        $event->type = $this->get_param('type','',$request);
        $event->is_main = $this->get_param('is_main',0,$request);
        $event->parent_id = $this->get_param('parent_id',0,$request);
        $event->category_id = $this->get_param('category_id',0,$request);
        $event->post_id = $this->get_param('post_id',0,$request);
        $event->position = $this->get_param('position',0,$request);
        $event->slug = '';

        $event->save();

        $langs = Lang::get();

        foreach ($langs as $lg)
        {
            $d = LangData::where(['type'=>'menu','data_id'=>$event->id,'lang_id'=>$lg->id])->first();
            if (!$d)
            {
                $d = new LangData;
                $d->type='menu';
                $d->data_id = $event->id;
                $d->lang_id = $lg->id;
            }

            $d->name = $this->get_param('name_'.$lg->litera,'',$request);
            $d->addr = $this->get_param('addr_'.$lg->litera,'',$request);
            $d->text = $this->get_param('text_'.$lg->litera,'',$request);

            $d->save();
        }


        $dd = LangData::where(['type'=>'menu','data_id'=>$event->id])->first();

        if ($dd)
        $event->slug = str_slug($dd->name);
        else $event->slug = '';

        $event->save();
    }

    public function show(Request $request)
    {
        $data = MenuItem::with(['info'])->paginate(10);

        return view('admin._menu_item_show',compact('data'));
    }

    public function add(Request $request)
    {
        $link=route('admin_menu_item_add_post');
        $categorys = Category::get();
        $langs = Lang::get();
        $menus = MenuItem::with('info')->get();
        $posts = Post::get();

        return view('admin._menu_item',compact('link','categorys','langs','menus','posts'));
    }

    public function add_post(Request $request)
    {
        $data = new MenuItem;
        $this->save_event_from_request($data,$request);

        return redirect(route('admin_menu_item_show'));
    }

    public function edit(Request $request,$id)
    {
        $data = MenuItem::where('id',$id)->first();

        if (!$data) return abort(404);

        $menus = MenuItem::with('info')->get();
        $categorys = Category::get();
        $langs = Lang::get();
        $posts = Post::get();
        $ld = LangData::with('lang')->where(['type'=>'menu','data_id'=>$id])->get();
        $param = [];

        foreach ($ld as $p)
        {
            $param['name_'.$p->lang->litera]=$p->name;
            $param['addr_'.$p->lang->litera]=$p->addr;
            $param['text_'.$p->lang->litera]=$p->text;
        }

        $link=route('admin_menu_item_edit_post');

        return view('admin._menu_item',compact('data','link','categorys','langs','param','menus','posts'));
    }

    public function edit_post(Request $request)
    {
        $id = $request->input('id');
        $data = MenuItem::where('id',$id)->first();

        if (!$data) return abort(404);
        $this->save_event_from_request($data,$request);

        return redirect(route('admin_menu_item_show'));
    }

    public function delete_post(Request $request)
    {
        $id = $request->input('id');
        $data = MenuItem::where('id',$id)->first();

        if (!$data) return json_encode(['success'=>false,'message'=>'not found']);
        
        $ld = LangData::where(['type'=>'menu','data_id'=>$id])->get();
        foreach ($ld as $l) $l->delete();

        $data->delete();

        return json_encode(['success'=>true]);
    }
}
