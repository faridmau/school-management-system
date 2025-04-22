<?php

namespace App\Models;

use App\Traits\HasAddress;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasAddress;
    protected $guarded = [];
}
