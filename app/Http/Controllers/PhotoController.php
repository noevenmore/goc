<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use IImage;

class PhotoController extends Controller
{
    public function load_image(Request $request)
    {
        $request->validate([
            'image'=>'required',
            'image.*'=>'max:6000|image|mimes:jpeg,png,jpg|file|dimensions:max_width=4096,max_height=4096',
            'type'=>'required',
        ]);

        $result_files = [];
        $images_type = $request->input('type');
        $images_tag = $request->input('tag');
        if (!$images_tag) $images_tag='';

        if($request->hasfile('image'))
         {
            foreach($request->file('image') as $image)
            {
                // SAVE IMAGE
                $image_file = $image->store('',['disk' => 'public_upload']);
                $result_files[]=$image_file;

                $img = new Photo;
                $img->type = $images_type;
                $img->data_id = 0;
                $img->src=$image_file;
                $img->tag=$images_tag;
                $img->save();

                // MAKE THUMB
                $thumb = IImage::make($image);
                
                $w = $thumb->width();
                $h = $thumb->height();

                if ($w>$h) $thumb->widen(300); else $thumb->heighten(300);

                $thumb_folder = public_path().'/upload/images/thumbs/';

                if (!is_dir($thumb_folder))
                {
                    mkdir($thumb_folder);
                }

                $thumb->save($thumb_folder.$image_file);
            }
         }

        return json_encode(['success'=>true,'image'=>$result_files]);//back()->with(['success'=>true,'image'=>$image_file]);
    }

    public static function delete_image_from_server($file)
    {
        $image = Photo::where(['src'=>$file])->first();

        if ($image)
        {
            $filename = public_path().'/upload/images/'.$file;
            $filename_thumb = public_path().'/upload/images/thumbs/'.$file;
            
            if (file_exists($filename)) unlink($filename);
            if (file_exists($filename_thumb)) unlink($filename_thumb);

            $image->delete();
    
            return json_encode(['success'=>true]);
        }

        return json_encode(['success'=>false]);
    }

    public static function delete_images_with_type_and_id($type,$data_id)
    {
        $images = Photo::where(['type'=>$type,'data_id'=>$data_id])->get();

        foreach ($images as $i)
        {
            PhotoController::delete_image_from_server($i->src);
        }
    }

    public function delete_image(Request $request)
    {
        $file = $request->input('filename');

        return $this->delete_image_from_server($file);
    }

    public static function publish_images($new_id,$type)
    {
        $images = Photo::where(['data_id'=>0,'type'=>$type])->get();
        $image_count = 0;

        foreach ($images as $img)
        {
            $img->data_id = $new_id;
            $img->save();

            $image_count++;
        }

        return $image_count;
    }

    /*
    public function add_to_gallery(Request $request)
    {
        $photos=Photo::where(['type'=>'gallery','tag'=>''])->get();

        $images_list = '';
        foreach ($photos as $ph)
        {
            $images_list = $images_list . $ph->src . ';';
        }

        return view('admin.photogallery',compact('images_list'));
    }

    public function add_to_gallery_post(Request $request)
    {
        $tag = $request->input('tag');

        $images = Photo::where(['type'=>'gallery','tag'=>''])->get();

        foreach ($images as $img)
        {
            $img->tag = $tag;
            $img->save();
        }

        return redirect(route('admin_add_to_gallery'));
    }

    public function show_gallery(Request $request)
    {
        $photos = Photo::paginate(12);

        return view('admin.photos',compact('photos'));
    }

    public function show_photo(Request $request,$id)
    {
        $photo = Photo::findOrFail($id);

        return view('admin.photo_one',compact('photo'));
    }

    public function photo_edit(Request $request)
    {
        $id = $request->input('id');

        $photo = Photo::findOrFail($id);

        $is_main = $request->input('is_main');
        if ($is_main===null) $is_main=false;

        if ($is_main && $photo->data_id!=0 && $photo->type!='etc' && $photo->type!='gallery')
        {
            $other = Photo::where('data_id',$photo->data_id)->where('id', '<>', $id)->get();

            foreach ($other as $ph)
            {
                $ph->is_main = false;
                $ph->save();
            }
        }

        $photo->is_main = $is_main;
        $photo->save();

        return back();
    }
    */
}
