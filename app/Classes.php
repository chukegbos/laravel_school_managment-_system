<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Teacher;
use App\Student;

class Classes extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'title', 'capacity', 'number_of_students', 'school_code', 'form', 'subject_offered', 'form_teacher'
    ];

    protected $dates = [
        'deleted_at', 
    ];

    public function getFormTeacherAttribute()
    {
        $roll = $this->attributes['form_teacher'];
        if (isset($roll)) {

            $teacher = Teacher::where('roll', $roll)->first();
            $name = $teacher->lastname.' '.$teacher->firstname.' '.$teacher->middlename;
            return $name;
        }     
    }

    public function getNumberOfStudentAttribute()
    {
        $id = $this->attributes['id'];
        $students = Student::where('class', $id)->count();
        return $students;      
    }
}
