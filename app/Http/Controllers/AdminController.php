<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        // Only admin access
        $this->middleware('not_simple_user');
    }

    public function index(Request $request)
    {
        return view('admin.index');
    }
}
