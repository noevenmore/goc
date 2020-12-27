<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function info()
    {
        return $this->hasMany('App\Models\LangData','data_id','id')->where('type','post');
    }

    public function category()
    {
        return $this->hasOne('App\Models\Category','id','category_id');
    }
}
