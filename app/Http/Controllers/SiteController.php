<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lang;
use App\Models\LangData;
use App\Models\MainPageSlider;
use App\Models\Photo;
use App\Models\Post;
use App\Models\System;
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
        $mp_sliders = MainPageSlider::with('info','photo')->get();
        $event_category_id = SystemController::get_sys('category_event_id')->value;

        $id_list = [];
        if ($event_category_id)
        {
            $id_list[]=intval($event_category_id);
        }

        $categorys = Category::where('id',$event_category_id)->with(['childrens','info','childrens.info'])->first();

        if ($categorys)
        {
            foreach ($categorys->childrens as $cc)
            {
                $id_list[]=$cc->id;
            }

            $events = Post::whereIn('category_id',$id_list)->with(['info','photo','category'])->get();
        } else
        {
            $events = null;
        }

        return view('index',compact('mp_sliders','event_category_id','categorys','events'));
    }

    public function search(Request $request)
    {
        $search = $request->input('t');

        $locale = \App::getlocale();
        $lang_id = Lang::where('litera',$locale)->first();

        if (!$lang_id)
        {
            $lang_id=Lang::first();
        }

        $post=LangData::with(['post','post.category','post.photo'])
        ->where(['type'=>'post','lang_id'=>$lang_id->id])
        ->where(function ($query) use ($search)
        {
            $query->orWhere('name','like','%'.$search.'%')
            ->orWhere('addr','like','%'.$search.'%')
            ->orWhere('text','like','%'.$search.'%');
        });

        

        /*
        if ($filter) $post = $post->orderBy('created_at','asc');
        else $post = $post->orderBy('created_at','desc');
*/

        $post = $post->paginate(12);
        $post=$post->appends(['t'=>$search]);
        //$post = $post->groupBy('data_id');

        //return dd($post);

        return view('search',compact('post','search'));
    }

    public function map(Request $request)
    {
        return view('map');
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
