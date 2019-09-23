<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Student;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'session', 'term', 'class', 'subject', 'roll', 'first_test', 'second_test', 'third_test', 'forth_test', 'fifth_test', 'exam', 'total', 'grade', 'comment', 'school_code', 'sign','fullname', 'teacher'
    ];

    protected $dates = [
        'deleted_at', 
    ];

    public function getFullnameAttribute()
    {
        $roll = $this->attributes['roll'];
        if (isset($roll)) {
            $student = Student::where('roll', $roll)->first();
            $name = $student->lastname.' '.$student->firstname.' '.$student->middlename;
            return $name;
        }     
    }
}
