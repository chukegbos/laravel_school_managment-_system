<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Teacher;
use App\Student;

class Curriculum extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'school_code', 'class'


    ];

    protected $dates = [
        'deleted_at', 'dob',
    ];
}