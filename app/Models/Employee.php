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
    protected $appends = [
        'name',
        'email',
    ];

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
    public function getNameAttribute()
    {
        return $this->user->name;
    }
    public function getEmailAttribute()
    {
        return $this->user->email;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function schools()
    {
        return $this->belongsToMany(School::class, 'employee_school');
    }
    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('profile_picture')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }
}
