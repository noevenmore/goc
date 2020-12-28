<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function get_param($param,$default,Request $request)
    {
        $d = $request->input($param,$default);
        if (!$d) $d=$default;

        return $d;
    }

    public function save_event_from_request($event,Request $request)
    {
        $event->name = $this->get_param('name','no_name',$request);
        $event->parent_id = $this->get_param('parent_id',0,$request);
        $event->is_show_addr = $this->get_param('is_show_addr',false,$request);
        $event->is_show_phone = $this->get_param('is_show_phone',false,$request);
        $event->is_show_link = $this->get_param('is_show_link',false,$request);
        $event->is_show_email = $this->get_param('is_show_email',false,$request);
        $event->is_show_work_times = $this->get_param('is_show_work_times',false,$request);
        $event->is_show_price = $this->get_param('is_show_price',false,$request);
        $event->is_show_length = $this->get_param('is_show_length',false,$request);
        $event->is_show_time_brackets = $this->get_param('is_show_time_brackets',false,$request);

        $event->save();
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

        return view('admin._category',compact('link','categorys'));
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

        return view('admin._category',compact('data','link','categorys'));
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
