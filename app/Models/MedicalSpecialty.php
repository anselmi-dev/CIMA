<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalSpecialty extends Model
{
    /** @use HasFactory<\Database\Factories\MedicalSpecialtyFactory> */
    use HasFactory;

    use HasSlug;

    protected $fillable = ['name', 'slug', 'description', 'content'];

    public function professionals()
    {
        return $this->belongsToMany(Professional::class);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

}
