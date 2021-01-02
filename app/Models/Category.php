<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function info()
    {
        return $this->hasMany('App\Models\LangData','data_id','id')->where('type','category');
    }

    public function parent()
    {
        return $this->hasOne('App\Models\Category','id','parent_id');
    }

    public function childrens()
    {
        return $this->hasMany('App\Models\Category','parent_id','id');
    }

    public function photo()
    {
        return $this->hasMany('App\Models\Photo','data_id','id')->where('type','category');
    }
}
