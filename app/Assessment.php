<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Student;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assessment extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'session', 'term', 'class', 'psychomotor', 'handwriting', 'verbal_fluency', 'games', 'construction', 'musical', 'affective_area', 'punctiality', 'alertness', 'drawing', 'attendance', 'neatness', 'politeness', 'honesty', 'physical_development', 'friendship', 'self_control', 'industrious', 'generousity', 'school_code', 'adjustment', 'roll', 'fullname', 'present', 'absent', 'teacher_comment', 'principal_comment', 'principal_sign', 'teacher_sign'
    ];

    protected $dates = [
        'deleted_at', 'teacher_sign', 'principal_sign'
    ];

    public function getFullnameAttribute()
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
}