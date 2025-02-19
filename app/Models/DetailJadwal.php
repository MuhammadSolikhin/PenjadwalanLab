<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailJadwal extends Model
{
    use HasFactory;

    protected $fillable = ['penjadwalan_id', 'jam_id', 'tanggal'];
    protected $table = 'detail_jadwal';

    public function penjadwalan()
    {
        return $this->belongsTo(Penjadwalan::class);
    }

    public function jam()
    {
        return $this->belongsTo(Jam::class);
    }
}
