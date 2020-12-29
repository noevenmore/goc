<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lang;
use App\Models\Photo;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SiteController extends Controller
{
    public function list($data)
    {

    }

    public function category_show(Request $request,$id)
    {
        $category = Category::where('id',$id)->with(['info','childrens','parent'])->first();

        if (!$category)
        {
            return abort(404);
        }

        $images = Photo::where(['type'=>'category','data_id'=>$id])->orderBy('is_main', 'desc')->get();

        $child_list = Category::where('parent_id',$category->id)->get();

        $list = [];
        
        $list[] = $category->id;

        foreach ($child_list as $ch)
        {
            $list[] = $ch->id;
        }

        $post = Post::whereIn('category_id',$list)->with(['category','category.info','photo'])->paginate(12);
        
        if ($category->parent_id)
        {
            $subcategorys = Category::where('parent_id',$category->parent_id)->with('info')->get();
        } else
        {
            $subcategorys = Category::where('parent_id',$id)->with('info')->get();
        }

        return view('category',compact('category','subcategorys','post','images'));
    }

    public function post_show(Request $request,$id)
    {
        $post = Post::where('id',$id)->with(['info','category'])->first();

        if (!$post)
        {
            return abort(404);
        }

        $images = Photo::where(['type'=>'post','data_id'=>$id])->orderBy('is_main', 'desc')->get();
        $work_times = MyFunctions::work_days_to_string($post->work_times);

        return view('post',compact('post','images','work_times'));
    }

    public function index(Request $request)
    {
        return view('index');
    }

    public function set_language(Request $request,$id)
    {
        $lang = Lang::where('litera',$id)->first();

        if ($lang)
        {
            Cookie::queue(Cookie::make('locale',$lang->litera,3600));
        }

        return back();
    }
}
