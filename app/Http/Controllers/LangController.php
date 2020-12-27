<?php

namespace App\Http\Controllers;

use App\Models\Lang;
use Illuminate\Http\Request;

class LangController extends Controller
{
    public function get_param($param,$default,Request $request)
    {
        $d = $request->input($param,$default);
        if (!$d) $d=$default;

        return $d;
    }

    public function save_event_from_request($event,Request $request)
    {
        $event->litera = $this->get_param('litera','',$request);
        $event->name = $this->get_param('name','',$request);

        $event->save();
    }

    public function show(Request $request)
    {
        $data = Lang::paginate(10);

        return view('admin._lang_show',compact('data'));
    }

    public function add(Request $request)
    {
        $link=route('admin_lang_add_post');

        return view('admin._lang',compact('link'));
    }

    public function add_post(Request $request)
    {
        $data = new Lang;
        $this->save_event_from_request($data,$request);

        return redirect(route('admin_lang_show'));
    }

    public function edit(Request $request,$id)
    {
        $data = Lang::where('id',$id)->first();

        if (!$data) return abort(404);

        $link=route('admin_lang_edit_post');

        return view('admin._lang',compact('data','link'));
    }

    public function edit_post(Request $request)
    {
        $id = $request->input('id');
        $data = Lang::where('id',$id)->first();

        if (!$data) return abort(404);
        $this->save_event_from_request($data,$request);

        return redirect(route('admin_lang_show'));
    }

    public function delete_post(Request $request)
    {
        $id = $request->input('id');
        $data = Lang::where('id',$id)->first();

        if (!$data) return json_encode(['success'=>false,'message'=>'not found']);
        
        $data->delete();

        return json_encode(['success'=>true]);
    }
}
