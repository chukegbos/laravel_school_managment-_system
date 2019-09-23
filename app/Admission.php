<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Teacher;
use App\Student;

class Admission extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'form_name', 'school_code', 'form_id', 'class', 'start_date', 'end_date', 'fee', 'status', 'session'
    ];

    protected $dates = [
        'deleted_at', 'start_date', 'end_date'
    ];
}