<?php

namespace App\Models;

use Spatie\Image\Enums\Fit;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
class School extends Model implements HasMedia
{

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
    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('school_logo')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }
}
