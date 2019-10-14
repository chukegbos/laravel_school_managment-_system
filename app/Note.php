<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Teacher;
use App\Student;

class Note extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'school_code', 'class', 'session', 'term', 'title', 'note', 'pdf', 'teacher', 'subject'
    ];

    protected $dates = [
        'deleted_at'
    ];
}