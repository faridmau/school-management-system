<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $guarded = [];
    public $timestamps = true;

    public function addressable()
    {
        return $this->morphTo();
    }
    public function getFullAddressAttribute()
    {
        return $this->street . ', ' . $this->city . ', ' . $this->state . ', ' . $this->zip_code . ', ' . $this->country;
    }
    public function getFullAddressWithCoordinatesAttribute()
    {
        return $this->street . ', ' . $this->city . ', ' . $this->state . ', ' . $this->region . ', ' . $this->zip_code . ', ' . $this->country . ' (' . $this->latitude . ', ' . $this->longitude . ')';
    }
}
