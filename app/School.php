<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Student;
use App\School;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'school_name', 'slogan', 'school_code', 'address', 'phone', 'email', 'logo', 'current_session', 'current_term', 'deleted_at', 'representative', 'number_of_student', 'assessment', 'status', 'ini', 'school_stamp', 'trial_end', 'trial_start', 'active_end', 'color'
    ];

    protected $dates = [
        'deleted_at', 'trial_end', 'trial_start', 'active_end'
    ];

    public function getNumberofstudentAttribute()
    {
   
        $school_id = $this->attributes['id'];
        $numberofstudent = Student::where('deleted_at', NULL)->where('school_id', $school_id)->count();
        return $numberofstudent;
    }
}
