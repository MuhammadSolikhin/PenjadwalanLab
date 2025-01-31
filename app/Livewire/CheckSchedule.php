<?php
namespace App\Livewire;

use App\Models\Jam;
use App\Models\Lab;
use Livewire\Component;
use App\Models\Penjadwalan;
use App\Models\DetailJadwal;

class CheckSchedule extends Component
{
    public $startDate;
    public $endDate;
    public $availableLabs = [];
    public $availableJams = [];

    public $labs;
    public $jams;

    public function mount()
    {
        $this->labs = Lab::all();
        $this->jams = Jam::all();
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'startDate' || $propertyName === 'endDate') {
            $this->checkAvailability();
        }
    }

    public function checkAvailability()
    {
        if ($this->startDate && $this->endDate) {
            // Cari lab yang bentrok dengan jadwal
            $conflictingLabs = Penjadwalan::where(function ($query) {
                $query->whereBetween('start_date', [$this->startDate, $this->endDate])
                    ->orWhereBetween('end_date', [$this->startDate, $this->endDate])
                    ->orWhere(function ($query) {
                        $query->where('start_date', '<=', $this->startDate)
                            ->where('end_date', '>=', $this->endDate);
                    });
            })
                ->with('labs:id') // Relasi ke labs
                ->get()
                ->pluck('labs.*.id')
                ->flatten()
                ->unique();

            // Cari jam yang bentrok
            $conflictingJams = DetailJadwal::whereBetween('tanggal', [$this->startDate, $this->endDate])
                ->pluck('jam_id')
                ->unique();

            // Update data lab dan jam yang tersedia
            $this->availableLabs = Lab::whereNotIn('id', $conflictingLabs)->get();
            $this->availableJams = Jam::whereNotIn('id', $conflictingJams)->get();
        }
    }

    public function render()
    {
        return view('livewire.check-schedule', [
            'labs' => $this->availableLabs,
            'jams' => $this->availableJams,
        ]);
    }
}
