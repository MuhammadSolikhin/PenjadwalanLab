<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penjadwalan extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'keperluan',
        'jenis',
        'start_date',
        'end_date',
        'user_id',
        'lab_id'
    ];

    protected $table = 'penjadwalan';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, );
    }

    public function labs()
    {
        return $this->belongsToMany(Lab::class, 'penjadwalan_lab', 'penjadwalan_id', 'lab_id');
    }

    public function detailJadwal()
    {
        return $this->hasMany(DetailJadwal::class);
    }

    public function jam()
    {
        return $this->belongsToMany(Jam::class, 'detail_jadwal', 'penjadwalan_id', 'jam_id');
    }
}
