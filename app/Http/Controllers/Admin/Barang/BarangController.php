<?php

namespace App\Http\Controllers\Admin\Barang;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BarangRequestStore;
use App\Http\Requests\Admin\BarangRequestUpdate;

class BarangController extends Controller
{
    public function index()
    {
        $no = 1;
        $page = 'Barang';
        $barangs = Barang::latest()->select('id', 'name', 'spesification', 'description', 'slug')->get();
        return view('admin.barang.index', compact('barangs', 'page', 'no'));
    }

    public function create()
    {
        $page = "Tambah Barang";

        return view('admin.barang.form', [
            'barang' => new Barang(),
            'page' => $page,
            'page_meta' => [
                'method' => 'POST',
                'url' => route('admin.barang.create'),
                'button_text' => 'Tambah',
            ]
        ]);
    }

    public function store(BarangRequestStore $request)
    {
        // dd($request->all());

        DB::beginTransaction();
        try {
            $barang = Barang::create($request->all());

            DB::commit();

            return redirect()->route('admin.barang')->with('success', 'Barang berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.barang')->with('error', 'Barang gagal ditambahkan');
        }
    }

    public function edit(Barang $barang)
    {
        $page = "Ubah Barang";

        return view('admin.barang.form', [
            'barang' => $barang,
            'page' => $page,
            'page_meta' => [
                'method' => 'PUT',
                'url' => route('admin.barang.edit', $barang),
                'button_text' => 'Ubah',
            ]
        ]);
    }

    public function update(BarangRequestUpdate $request, Barang $barang)
    {
        // dd($request->all());

        DB::beginTransaction();
        try {
            $barang->update($request->all());

            DB::commit();

            return redirect()->route('admin.barang')->with('success', 'Barang berhasil diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.barang')->with('error', 'Barang gagal diubah');
        }
    }
}
