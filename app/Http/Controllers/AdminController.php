<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        // Only admin access
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('admin.index');
    }
}
