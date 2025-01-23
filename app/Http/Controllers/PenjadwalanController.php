<?php

namespace App\Http\Controllers;

use App\Models\Laboratorium;
use App\Models\Penjadwalan;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\PenjadwalanStoreRequest;
use App\Http\Requests\PenjadwalanUpdateRequest;

class PenjadwalanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view(
            'admin.penjadwalan.index',
            ['page' => 'Data Penjadwalan Lab', 'penjadwalan' => Penjadwalan::all(), 'no' => 1]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.penjadwalan.form', [
            'barang' => new Penjadwalan(),
            'page' => 'Tambah Penjadwalan',
            'page_meta' => [
                'method' => 'POST',
                'url' => route('penjadwalan.store'),
                'button_text' => 'Tambah',
            ],
            'users' => User::all(),
            'laboratoriums' => Laboratorium::all(),
            'selectedUserId' => old('user_id'),
            'selectedLaboratoriumId' => old('lab_id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PenjadwalanStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['status'] = $request->input('status', 'pending');

        Penjadwalan::create($data);

        return redirect()->route('penjadwalan.index')
            ->with('success', 'Penjadwalan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjadwalan $product): View
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjadwalan $product): View
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PenjadwalanUpdateRequest $request, Penjadwalan $product): RedirectResponse
    {
        $product->update($request->validated());

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjadwalan $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}