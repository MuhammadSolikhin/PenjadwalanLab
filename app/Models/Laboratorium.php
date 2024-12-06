<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Laboratorium extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'laboratoria';

    protected $fillable = [
        'name',
        'slug',
        'lokasi',
        'kapasitas',
        'status', 
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
