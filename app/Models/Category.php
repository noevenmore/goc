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
        return $this->hasMany('App\Models\LangData','id','parent_id')->where('type','category');
    }

    public function childrens()
    {
        return $this->hasMany('App\Models\Category','parent_id','id');
    }
}
