<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\SocialLinkData;
use App\Models\SocialLinks;
use Illuminate\Http\Request;

class SocialLinksController extends Controller
{
    public function get_param($param,$default,Request $request)
    {
        $d = $request->input($param,$default);
        if (!$d) $d=$default;

        return $d;
    }

    public function save_event_from_request($event,Request $request)
    {
        $event->name = $this->get_param('name','',$request);

        $event->save();

        PhotoController::publish_images($event->id,'social');
    }

    public function show(Request $request)
    {
        $data = SocialLinks::paginate(10);

        return view('admin._social_links_show',compact('data'));
    }

    public function add(Request $request)
    {
        $link=route('admin_social_links_add_post');

        $photos=Photo::where(['type'=>'social','data_id'=>0])->get();

        $images_list = '';
        foreach ($photos as $ph)
        {
            $images_list = $images_list . $ph->src . ';';
        }

        return view('admin._social_links',compact('link','images_list'));
    }

    public function add_post(Request $request)
    {
        $data = new SocialLinks;
        $this->save_event_from_request($data,$request);

        return redirect(route('admin_social_links_show'));
    }

    public function edit(Request $request,$id)
    {
        $data = SocialLinks::where('id',$id)->first();

        if (!$data) return abort(404);

        $photos=Photo::where(['type'=>'social','data_id'=>$id])->get();

        $images_list = '';
        foreach ($photos as $ph)
        {
            $images_list = $images_list . $ph->src . ';';
        }

        $link=route('admin_social_links_edit_post');

        return view('admin._social_links',compact('data','link','images_list'));
    }

    public function edit_post(Request $request)
    {
        $id = $request->input('id');
        $data = SocialLinks::where('id',$id)->first();

        if (!$data) return abort(404);
        $this->save_event_from_request($data,$request);

        return redirect(route('admin_social_links_show'));
    }

    public function delete_post(Request $request)
    {
        $id = $request->input('id');
        $data = SocialLinks::where('id',$id)->first();

        if (!$data) return json_encode(['success'=>false,'message'=>'not found']);

        $ld = SocialLinkData::where(['social_link_id'=>$id])->get();
        foreach ($ld as $l) $l->delete();
        
        PhotoController::delete_images_with_type_and_id('social',$id);

        $data->delete();

        return json_encode(['success'=>true]);
    }
}
