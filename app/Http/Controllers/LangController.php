<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangController extends Controller
{
    public function test(Request $request)
    {
        return dd($request->all());
    }
}
