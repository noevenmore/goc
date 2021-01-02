<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\System;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function __construct()
    {
        // Only admin access
        $this->middleware('auth');
    }

    public static function get_sys($name)
    {
        $sv = System::where('name',$name)->first();
        if (!$sv)
        {
            $sv = new System;
            $sv->name = $name;
            $sv->type = 'system';
            $sv->value = 0;
            $sv->save();
        }

        return $sv;
    }

    public static function set_sys($name,$value)
    {
        $sv = System::where('name',$name)->first();
        if (!$sv)
        {
            $sv = new System;
            $sv->name = $name;
            $sv->type = 'system';
        }

        $sv->value = $value;
        $sv->save();

        return $sv;
    }

    public function get_param($param,$default,Request $request)
    {
        $d = $request->input($param,$default);
        if (!$d) $d=$default;

        return $d;
    }

    public function save_event_from_request(Request $request)
    {
        $this->set_sys('category_event_id',$this->get_param('category_event_id',0,$request));
        $this->set_sys('category_publication_id',$this->get_param('category_publication_id',0,$request));
    }

    public function edit(Request $request)
    {
        $categorys = Category::get();

        $category_event_id = $this->get_sys('category_event_id')->value;
        $category_publication_id = $this->get_sys('category_publication_id')->value;

        $link=route('admin_system_config_edit_post');
        
        return view('admin._system_config',compact('link','categorys','category_event_id','category_publication_id'));
    }

    public function edit_post(Request $request)
    {
        $this->save_event_from_request($request);

        return redirect(route('admin_system_config_edit'))->with(['saved'=>true]);
    }
}
