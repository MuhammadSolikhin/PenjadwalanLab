<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penjadwalan extends Model
{
    use HasFactory;
    protected $table = 'penjadwalan';
    protected $fillable = [
        'name',
        'status',
        'keperluan',
        'tgl_mulai',
        'tgl_selesai',
        'user_id',
        'lab_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,);
    }

    public function laboratorium(): BelongsTo
    {
        return $this->belongsTo(Laboratorium::class, 'lab_id');
    }
}
