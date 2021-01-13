<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLinks extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function photo()
    {
        return $this->hasOne('App\Models\Photo','data_id','id')->where('type','social');
    }
}
