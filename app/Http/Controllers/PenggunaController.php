<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function dashboard()
    {
        $page = 'Dashboard User';
        return view('user.dashboard', compact('page'));
    }
}
