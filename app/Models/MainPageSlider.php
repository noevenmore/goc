<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainPageSlider extends Model
{
    use HasFactory;

    public function info()
    {
        return $this->hasMany('App\Models\LangData','data_id','id')->where('type','mp_slider');
    }

    public function photo()
    {
        return $this->hasOne('App\Models\Photo','data_id','id')->where('type','mp_slider');
    }
}
