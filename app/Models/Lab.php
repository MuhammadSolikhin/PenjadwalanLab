<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Lab extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name',
        // 'slug',
        'lokasi',
        'kapasitas',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function penjadwalan()
    {
        return $this->belongsToMany(Penjadwalan::class, 'penjadwalan_lab', 'lab_id', 'penjadwalan_id');
    }
    
}
