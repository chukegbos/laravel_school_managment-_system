<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Teacher;
use App\Student;
use App\Assignmentsubmit;

class Assignment extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'school_code', 'class', 'session', 'term', 'submission_date', 'note', 'pdf', 'teacher', 'subject', 'number_of_students', 'number_of_submit', 'status', 'grade_score'
    ];

    protected $dates = [
        'deleted_at', 'submission_date'
    ];

    public function getNumberOfStudentsAttribute()
    {
        $id = $this->attributes['class'];
        $students = Student::where('class', $id)->count();
        return $students;      
    }

    public function getNumberOfSubmitAttribute()
    {
        $id = $this->attributes['id'];
        $assignmentsubmit = Assignmentsubmit::where('assignment_id', $id)->count();
        return $assignmentsubmit;      
    }
}