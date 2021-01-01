<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    public function info()
    {
        return $this->hasMany('App\Models\LangData','data_id','id')->where('type','menu');
    }

    public function childrens()
    {
        return $this->hasMany('App\Models\MenuItem','parent_id','id')->orderBy('position', 'desc');
    }

    public function category()
    {
        return $this->hasOne('App\Models\Category','id','category_id');
    }

    public function parent()
    {
        return $this->hasOne('App\Models\MenuItem','id','parent_id');
    }
}
