<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaboratoriumType;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LaboratoriumTypes\LabTypeStoreRequest;
use App\Http\Requests\LaboratoriumTypes\LabTypeUpdateRequest;

class LaboratoriumTypeController extends Controller
{
    public function index()
    {
        $no = 1;
        $laboratorium_types = LaboratoriumType::all();
        $page = 'Jenis Laboratorium';

        return view('admin.laboratorium-type.index',compact('page', 'laboratorium_types', 'no'));
    }

    public function create()
    {
        $page = "Tambah Jenis Laboratorium";

        return view('admin.laboratorium-type.form-laboratorium-types', [
            'laboratorium_type' => new LaboratoriumType(),
            'page' => $page,
            'page_meta' => [
                'method' => 'POST',
                'url' => route('admin.jenis-laboratorium.create'),
                'button_text' => 'Tambah',
            ]
        ]);
    }

    public function store(LabTypeStoreRequest $request)
    {
        // dd($request->all());

        DB::beginTransaction();
        try {
            LaboratoriumType::create($request->all());

            DB::commit();

            return redirect()->route('admin.jenis-laboratorium')->with('success', 'Jenis Laboratorium berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.jenis-laboratorium')->with('error', 'Jenis Laboratorium gagal ditambahkan');
        }
    }

    public function edit(LaboratoriumType $laboratorium_type)
    {
        $page = "Edit Jenis Laboratorium";

        return view('admin.laboratorium-type.form-laboratorium-types', [
            'laboratorium_type' => $laboratorium_type,
            'page' => $page,
            'page_meta' => [
                'method' => 'PUT',
                'url' => route('admin.jenis-laboratorium.edit', $laboratorium_type),
                'button_text' => 'Edit',
            ]
        ]);
    }

    public function update(LabTypeUpdateRequest $request, LaboratoriumType $laboratorium_type)
    {
        // dd($request->all());

        DB::beginTransaction();
        try {
            $laboratorium_type->update($request->all());

            DB::commit();

            return redirect()->route('admin.jenis-laboratorium')->with('success', 'Jenis Laboratorium berhasil diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.jenis-laboratorium')->with('error', 'Jenis Laboratorium gagal diubah');
        }
    }
} 
