<?php

use App\Models\Lang;

if (!function_exists('_lg'))
{
    function _lg($data,$var)
    {
        if (!$data) return null;

        $locale = \App::getlocale();
        $lang = Lang::where('litera',$locale)->first();

        if ($lang) $lang_id=$lang->id; else $lang_id=0;

        $find=false;
        foreach ($data as $di)
        {
            if ($di->lang_id == $lang_id)
            {
                return $di->{$var};
                $find=true;
            }
        }
        if (!$find)
        {
            if (isset($data[0]->{$var})) return $data[0]->{$var}; else return '???';
        }
    }
} 