<?php

namespace App\Models;

use App\Traits\HasAddress;
use Spatie\Image\Enums\Fit;
use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class School extends Model implements HasMedia
{
    use HasAddress;
    use HasSlug;
    use InteractsWithMedia;
    protected $table = 'schools';
    protected $casts = [
        'facilities' => 'array',
        'social_media_links' => 'array',
    ];
    protected $guarded = [];

    protected static function booted()
    {
        if (auth()) {
            static::creating(function ($model) {
                $model->created_by = auth()->id();
            });
            static::updating(function ($model) {
                $model->updated_by = auth()->id();
            });
        }
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
    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('school_logo')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }
}
