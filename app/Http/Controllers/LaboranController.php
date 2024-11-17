<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaboranController extends Controller
{
    public function dashboard()
    {
        return view('laboran.dashboard');
    }
}
