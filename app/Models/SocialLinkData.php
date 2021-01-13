<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLinkData extends Model
{
    use HasFactory;

    public function parent()
    {
        return $this->hasOne('App\Models\SocialLinks','id','social_link_id');
    }
}
