<?php

namespace App\Http\Controllers\Admin\Meja;

use App\Models\Meja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Meja\MejaRequestStore;
use App\Http\Requests\Admin\Meja\MejaRequestUpdate;

class MejaController extends Controller
{
    public function index()
    {
        $no = 1;
        $page = 'Meja';
        $mejas = Meja::latest()->select('id', 'no')->get();
        return view('admin.meja.index', compact('no', 'page', 'mejas'));
    }

    public function create()
    {
        $page = 'Tambah Meja';

        return view('admin.meja.form', [
            'meja' => new Meja(),
            'page' => $page,
            'page_meta' => [
                'method' => 'POST',
                'url' => route('admin.meja.create'),
                'button_text' => 'Tambah',
            ]
        ]);
    }

    public function store(MejaRequestStore $request)
    {
        // dd($request->all());

        DB::beginTransaction();
        try {
            $meja = Meja::create($request->all());

            DB::commit();

            return redirect()->route('admin.meja')->with('success', 'Meja berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.meja')->with('error', 'Meja gagal ditambahkan');
        }
    }

    public function edit(Meja $meja)
    {
        $page = 'Ubah Meja';

        return view('admin.meja.form', [
            'meja' => $meja,
            'page' => $page,
            'page_meta' => [
                'method' => 'PUT',
                'url' => route('admin.meja.edit', $meja),
                'button_text' => 'Ubah',
            ]
        ]);
    }

    public function update(MejaRequestUpdate $request, Meja $meja)
    {
        // dd($request->all());

        DB::beginTransaction();
        try {
            $meja->update($request->all());

            DB::commit();

            return redirect()->route('admin.meja')->with('success', 'Meja berhasil diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.meja')->with('error', 'Meja gagal diubah');
        }
    }
}
