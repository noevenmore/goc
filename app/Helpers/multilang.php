<?php

if (!function_exists('_lg'))
{
    function _lg($data,$var)
    {
        if (!$data) return null;

        $find=false;
        foreach ($data as $di)
        {
            if ($di->lang_id == (isset($system_var_lang_id)?$system_var_lang_id:0))
            {
                return $di->{$var};
                $find=true;
            }
        }
        if (!$find) return $data[0]->{$var};
    }
} 