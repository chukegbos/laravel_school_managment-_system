<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\School;
use App\Bed;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hostel extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'gender', 'school_code', 'category', 'number_of_bed', 'code'
    ];

    protected $dates = [
        'deleted_at', 
    ];

    public function getNumberOfBedAttribute()
    {
        $school_code = Auth::user()->school_code;
        $hostel_code = $this->attributes['code'];
        if (isset($hostel_code)) {
            $hostel = Bed::where('hostel_code', $hostel_code)->where('school_code', $school_code)->count();
            return $hostel;
        }     
    }
}
