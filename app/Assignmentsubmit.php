<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Teacher;
use App\Student;

class Assignmentsubmit extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'school_code', 'roll', 'assignment_id', 'pdf', 'score', 'remark'
    ];

    protected $dates = [
        'deleted_at', 'submission_date'
    ];
}