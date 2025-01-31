<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jam extends Model
{
    use HasFactory;

    protected $fillable = ['waktu_mulai', 'waktu_selesai', 'jenis'];
    protected $table = 'jam';

    public function detailJadwal()
    {
        return $this->hasMany(DetailJadwal::class);
    }

    public function penjadwalan()
    {
        return $this->belongsToMany(Penjadwalan::class, 'detail_jadwal', 'jam_id', 'penjadwalan_id');
    }
}
