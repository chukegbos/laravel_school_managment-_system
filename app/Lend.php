<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Teacher;
use App\Student;

class Lend extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'lender', 'book_code', 'status', 'school_code', 'return_date'
    ];

    protected $dates = [
        'deleted_at', 'return_date', 
    ];

    public function getLenderAttribute()
    {
    	$roll = $this->attributes['lender'];
    	$student = Student::where('roll', $roll)->where('deleted_at', NULL)->first();
        $teacher = Teacher::where('roll', $roll)->where('deleted_at', NULL)->first();
        if (isset($student)) {
        	return $student->lastname.' '.$student->firstname.' '.$student->middlename.' (Student)';
        }
        elseif (isset($teacher))  {
        	return $teacher->lastname.' '.$teacher->firstname.' '.$teacher->middlename.' (Staff)';
        } 
    }
}
