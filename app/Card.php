<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Student;
use App\Setting;
use App\School;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'token', 'serial_number', 'roll', 'session', 'term', 'school_code', 'count', 'status', 'produced_by', 'date_used'
    ];

    protected $dates = [
        'deleted_at', 
    ];

    public function getRollAttribute()
    {
        $roll = $this->attributes['roll'];
        //return $roll;
        $name = Student::where('deleted_at', NULL)->where('roll', $roll)->first();
        $lastname = $name->lastname;
        $firstname = $name->firstname;
        $middlename = $name->middlename;

        if (isset($lastname) && isset($firstname) && isset($middlename)) {
            $fullname = $name->lastname.' '.$name->firstname.' '.$name->middlename;
        }
        elseif (isset($lastname) && !isset($firstname) && isset($middlename))
        {
            $fullname = $name->lastname.' '.$name->middlename;
        }
        elseif (isset($lastname) && isset($firstname) && !isset($middlename))
        {
            $fullname = $name->lastname.' '.$name->firstname;
        }
        else
        {
            $fullname = $name->firstname.' '.$name->middlename;
        }
        return $fullname;
    }

    public function getSchoolCodeAttribute()
    {
        $school_code = $this->attributes['school_code'];
        $schoolname = School::where('deleted_at', NULL)->where('school_code', $school_code)->first();
        $name = $schoolname->school_name;
        return $name;
    }

}
