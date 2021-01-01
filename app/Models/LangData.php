<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LangData extends Model
{
    use HasFactory;

    public function lang()
    {
        return $this->hasOne('App\Models\Lang','id','lang_id');
    }

    public function post()
    {
        return $this->hasOne('App\Models\Post','id','data_id');
    }
}
