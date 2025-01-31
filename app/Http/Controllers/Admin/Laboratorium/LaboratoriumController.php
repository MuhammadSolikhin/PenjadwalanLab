<?php

namespace App\Http\Controllers\Admin\Laboratorium;

use App\Models\Lab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Laboratorium\LaboratoriumRequestStore;
use App\Http\Requests\Admin\Laboratorium\LaboratoriumRequestUpdate;

class LaboratoriumController extends Controller
{
    public function index()
    {
        $no = 1;
        $page = 'Laboratorium';
        $laboratoriums = Lab::latest()->select('id', 'name', 'lokasi', 'kapasitas')->get();
        return view('admin.laboratorium.index', compact('laboratoriums', 'page', 'no'));
    }

    public function create()
    {
        $page = "Tambah Laboratorium";

        return view('admin.laboratorium.form', [
            'laboratorium' => new Lab(),
            'page' => $page,
            'page_meta' => [
                'method' => 'POST',
                'url' => route('admin.laboratorium.create'),
                'button_text' => 'Tambah',
            ]
        ]);
    }

    public function store(LaboratoriumRequestStore $request)
    {
        // dd($request->all());

        DB::beginTransaction();
        try {
            $laboratorium = Lab::create($request->all());

            DB::commit();

            return redirect()->route('admin.laboratorium')->with('success', 'Laboratorium berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.laboratorium')->with('error', 'Laboratorium gagal ditambahkan');
        }
    }

    public function edit(Lab $laboratorium)
    {
        $page = "Ubah Laboratorium";

        return view('admin.laboratorium.form', [
            'laboratorium' => $laboratorium,
            'page' => $page,
            'page_meta' => [
                'method' => 'PUT',
                'url' => route('admin.laboratorium.edit', $laboratorium),
                'button_text' => 'Ubah',
            ]
        ]);
    }

    public function update(LaboratoriumRequestUpdate $request, Lab $laboratorium)
    {
        // dd($request->all());

        DB::beginTransaction();
        try {
            $laboratorium->update($request->all());

            DB::commit();

            return redirect()->route('admin.laboratorium')->with('success', 'Laboratorium berhasil diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.laboratorium')->with('error', 'Laboratorium gagal diubah');
        }
    }
}
