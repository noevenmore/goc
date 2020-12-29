<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Post;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function category_show(Request $request,$id)
    {
        return view('index');
    }

    public function post_show(Request $request,$id)
    {
        $images = Photo::where(['type'=>'post','data_id'=>$id])->orderBy('is_main', 'desc')->get();
        $data = Post::where('id',$id)->with('info')->first();

        return view('post',compact('data','images'));
    }

    public function index(Request $request)
    {
        return view('index');
    }
}
