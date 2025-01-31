<?php

namespace App\Http\Controllers;

use App\Models\DetailJadwal;
use App\Models\Jam;
use App\Models\Lab;
use App\Models\Penjadwalan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\PenjadwalanStoreRequest;
use App\Http\Requests\PenjadwalanUpdateRequest;

class PenjadwalanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjadwalan = Penjadwalan::with(['user'])->get();

        if (auth()->user()->role == 'other') {
            $penjadwalan = Penjadwalan::where('user_id', auth()->user()->id)->get();
            return view(
                'user.penjadwalan.index',
                ['page' => 'Data Penjadwalan Lab', 'penjadwalan' => $penjadwalan, 'no' => 1]
            );
        } else if (auth()->user()->role == 'admin') {
            return view(
                'admin.penjadwalan.index',
                ['page' => 'Data Penjadwalan Lab', 'penjadwalan' => $penjadwalan, 'no' => 1]
            );
        } else if (auth()->user()->role == 'laboran') {
            return view(
                'laboran.penjadwalan.index',
                ['page' => 'Data Penjadwalan Lab', 'penjadwalan' => $penjadwalan, 'no' => 1]
            );
        }

    }

    public function createGenerateSchedule(PenjadwalanStoreRequest $request)
    {
        $isConflict = $this->checkScheduleConflict($request['lab_ids'], $request['start_date'], $request['end_date']);
        if ($isConflict) {
            return response()->json(['error' => 'Lab already booked for the selected period'], 400);
        }

        // Buat jadwal baru
        $penjadwalan = Penjadwalan::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            'jenis' => $request['jenis'],
            'keperluan' => $request['keperluan'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
        ]);
        // Lampirkan labs ke penjadwalan
        $penjadwalan->labs()->attach($request['lab_ids']);

        // Dapatkan seluruh range tanggal
        $startDate = Carbon::parse($request['start_date']);
        $endDate = Carbon::parse($request['end_date']);

        // Loop untuk setiap tanggal dalam rentang waktu
        while ($startDate->lte($endDate)) {
            $dayOfWeek = $startDate->dayOfWeek; // 0 (Minggu) sampai 6 (Sabtu)

            // Pilih jam berdasarkan hari
            $jamReguler = [];
            if (in_array($dayOfWeek, [1, 2, 3, 4, 5])) { // Senin - Jumat
                $jamReguler = Jam::where('jenis', 'Reguler A')->get();
            } elseif (in_array($dayOfWeek, [4, 6])) { // Kamis dan Sabtu
                $jamReguler = Jam::where('jenis', 'Reguler CK/CS')->get();
            }

            // Buat detail jadwal untuk setiap jam
            foreach ($jamReguler as $jam) {
                DetailJadwal::create([
                    'penjadwalan_id' => $penjadwalan->id,
                    'jam_id' => $jam->id,
                    'tanggal' => $startDate->format('Y-m-d'),
                ]);
            }

            // Increment ke hari berikutnya
            $startDate->addDay();
        }

        // return response()->json(['message' => 'Schedule created successfully for Prodi', 'penjadwalan' => $penjadwalan]);
        return redirect()->route('penjadwalan.index')
            ->with('success', 'Penjadwalan created successfully.');
    }
    

    // Fungsi untuk membuat penjadwalan jangka pendek (tentatif)
    public function createTentativeSchedule(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'lab_id' => 'required|exists:labs,id',
            'keperluan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam_id' => 'required|exists:jam,id',
        ]);

        // Cek konflik jadwal dengan penjadwalan jangka panjang (generate)
        $isConflict = $this->checkScheduleConflict($validated['lab_id'], $validated['tanggal'], $validated['tanggal']);
        if ($isConflict) {
            return response()->json(['error' => 'Lab already booked for the selected time'], 400);
        }

        // Membuat penjadwalan tentatif
        $penjadwalan = Penjadwalan::create([
            'user_id' => $validated['user_id'],
            'lab_id' => $validated['lab_id'],
            'status' => 'tentative',
            'keperluan' => $validated['keperluan'],
            'start_date' => $validated['tanggal'],
            'end_date' => $validated['tanggal'],
        ]);

        // Membuat detail jadwal untuk waktu yang dipilih
        DetailJadwal::create([
            'penjadwalan_id' => $penjadwalan->id,
            'jam_id' => $validated['jam_id'],
            'tanggal' => $validated['tanggal'],
        ]);

        return response()->json(['message' => 'Tentative schedule created successfully', 'penjadwalan' => $penjadwalan]);
    }

    // Fungsi untuk memeriksa konflik jadwal
    public function checkScheduleConflict($labIds, $startDate, $endDate)
    {
        // Mencari jadwal yang bentrok untuk lab tertentu dalam rentang tanggal yang diberikan
        $conflictingSchedules = Penjadwalan::whereHas('labs', function ($query) use ($labIds) {
            $query->whereIn('lab_id', $labIds);
        })
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                    });
            })
            ->exists();

        return $conflictingSchedules;
    }

    public function checkSchedule(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Cari lab dan jam yang memiliki konflik jadwal
        $conflictingLabs = Penjadwalan::where(function ($query) use ($startDate, $endDate) {
            $query->whereBetween('start_date', [$startDate, $endDate])
                ->orWhereBetween('end_date', [$startDate, $endDate])
                ->orWhere(function ($query) use ($startDate, $endDate) {
                    $query->where('start_date', '<=', $startDate)
                        ->where('end_date', '>=', $endDate);
                });
        })
            ->with('labs:id') // Mengambil lab yang terkait
            ->get()
            ->pluck('labs.*.id') // Ambil ID lab
            ->flatten()
            ->unique();

        $conflictingJams = DetailJadwal::where(function ($query) use ($startDate, $endDate) {
            $query->whereBetween('tanggal', [$startDate, $endDate]);
        })
            ->pluck('jam_id')
            ->unique();

        dd($conflictingJams);

        return response()->json([
            'conflictingLabs' => $conflictingLabs->toArray(),
            'conflictingJams' => $conflictingJams->toArray(),
        ]);
    }


    // Fungsi untuk mengubah status penjadwalan (approve, cancel, etc.)
    public function updateStatus($id, Request $request)
    {
        $penjadwalan = Penjadwalan::findOrFail($id);
        $penjadwalan->update([
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'Penjadwalan status updated successfully']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('user.penjadwalan.form', [
            'labs' => Lab::all(),
            'jams' => Jam::all(),
            'page' => 'Tambah Penjadwalan',
            'users' => User::all(),
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
    public function show($id)
    {
        $penjadwalan = Penjadwalan::with(['labs'])->findOrFail($id);

        $startDate = request('start_date', now()->startOfMonth()->toDateString());
        $endDate = request('end_date', now()->endOfMonth()->toDateString());

        $detailJadwal = DetailJadwal::where('penjadwalan_id', $id)
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->with('jam')
            ->orderBy('tanggal')
            ->get();


        if (auth()->user()->role == 'admin') {
            return view('admin.penjadwalan.show', [
                'page' => 'Detail Penjadwalan',
                'penjadwalan' => $penjadwalan,
                'detailJadwal' => $detailJadwal,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ]);
        } else if (auth()->user()->role == 'laboran') {
            return view('laboran.penjadwalan.show', [
                'page' => 'Detail Penjadwalan',
                'penjadwalan' => $penjadwalan,
                'detailJadwal' => $detailJadwal,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ]);
        }
    }
    public function updateVerifikasi(Request $request, $id)
    {
        $penjadwalan = Penjadwalan::findOrFail($id);

        // Update status berdasarkan input
        $penjadwalan->update([
            'status' => $request->input('status'),
        ]);
        if (auth()->user()->role == 'admin') {
            return redirect()->route('admin.penjadwalan')->with('success', 'Penjadwalan berhasil diverifikasi.');
        } else if (auth()->user()->role == 'laboran') {
            return redirect()->route('laboran.penjadwalan')->with('success', 'Penjadwalan berhasil diverifikasi.');
        }
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