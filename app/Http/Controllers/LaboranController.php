<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaboranController extends Controller
{
    public function dashboard()
    {
        $page = 'Dashboard Laboran';
        return view('laboran.dashboard', compact('page'));
    }
}
