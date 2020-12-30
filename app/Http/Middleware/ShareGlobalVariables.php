<?php

namespace App\Http\Middleware;

use App\Models\Lang;
use App\Models\MenuItem;
use Closure;
use Illuminate\Http\Request;

class ShareGlobalVariables
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $menu_items = MenuItem::where('parent_id',0)->orderBy('position', 'desc')->with('info','childrens')->get();
        view()->share('menu_items',$menu_items);

        $locale = \App::getlocale();
        view()->share('system_var_lang',$locale);

        $langs = Lang::get();
        view()->share('system_var_langs',$langs);

        $lang_id = Lang::where('litera',$locale)->first();

        if (!$lang_id)
        {
            $lang_id=Lang::first();
        }

        if ($lang_id) view()->share('system_var_lang_id',$lang_id->id);
        else view()->share('system_var_lang_id',0);

        return $next($request);
    }
}
