<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function get_param($param,$default,Request $request)
    {
        $d = $request->input($param,$default);
        if (!$d) $d=$default;

        return $d;
    }

    public function save_event_from_request($event,Request $request)
    {
        $event->type = $this->get_param('type','user',$request);
        $event->name = $this->get_param('name','',$request);

        $event->save();
    }

    public function show(Request $request)
    {
        $data = User::paginate(10);

        return view('admin._users_show',compact('data'));
    }

    public function add(Request $request)
    {
        $link=route('admin_users_add_post');

        return view('admin._users',compact('link'));
    }

    public function add_post(Request $request)
    {
        $data = new User;
        $this->save_event_from_request($data,$request);

        return redirect(route('admin_users_show'));
    }

    public function edit(Request $request,$id)
    {
        $data = User::where('id',$id)->first();

        if (!$data) return abort(404);

        $link=route('admin_users_edit_post');

        return view('admin._users',compact('data','link'));
    }

    public function edit_post(Request $request)
    {
        $id = $request->input('id');
        $data = User::where('id',$id)->first();

        if (!$data) return abort(404);
        $this->save_event_from_request($data,$request);

        return redirect(route('admin_users_show'));
    }

    public function delete_post(Request $request)
    {
        $id = $request->input('id');
        $data = User::where('id',$id)->first();

        if (!$data) return json_encode(['success'=>false,'message'=>'not found']);
        
        $data->delete();

        return json_encode(['success'=>true]);
    }
}
