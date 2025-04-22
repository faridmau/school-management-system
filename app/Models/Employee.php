<?php

namespace App\Models;

use App\Traits\HasAddress;

use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Employee extends Model implements HasMedia
{
    use HasAddress;
    use InteractsWithMedia;
    protected $guarded = [];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('profile_picture')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }
}
