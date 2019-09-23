<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\School;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bed extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'session', 'hostel_code', 'school_code', 'bed_number', 'occupant'
    ];

    protected $dates = [
        'deleted_at', 
    ];
}