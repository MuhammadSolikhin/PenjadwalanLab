<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaboratoriumType;

class LaboratoriumTypeController extends Controller
{
    public function index()
    {
        return view('admin.laboratorium-type.index');
    }

    public function store()
    {
        return view('admin.form-laboratorium-type', [
            'laboratorium_type' => new LaboratoriumType(),
            'page_meta' => [
                'title' => 'Tambah Jenis Laboratorium',
                'url' => route('admin.jenis-laboratorium'),
                'button_text' => 'Tambah',
            ]
        ]);
    }

} 
