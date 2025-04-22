<?php

namespace App\Traits;

use App\Models\Address;

trait HasAddress
{
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function getCityAttribute()
    {
        return $this->address?->city;
    }

    public function getStateAttribute()
    {
        return $this->address?->state;
    }

    public function getZipCodeAttribute()
    {
        return $this->address?->zip_code;
    }
    public function getCountryAttribute()
    {
        return $this->address?->country;
    }
    public function setCountryAttribute($value)
    {
        $address = $this->address ?? $this->address()->make();
        $address->country = $value;
        $this->setRelation('address', $address);
    }

    public function getRegionAttribute()
    {
        return $this->address?->region;
    }

    public function getStreetAttribute()
    {
        return $this->address?->street;
    }
    public function getLatitudeAttribute()
    {
        return $this->address?->latitude;
    }
    public function getLongitudeAttribute()
    {
        return $this->address?->longitude;
    }


    //     street
    // city
    // state
    // zip_code
    // country
    // region
    // latitude
    // longitude


}
