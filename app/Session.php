<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Session extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 
        'start_date', 'end_date', 'firstterm_midterm_start', 'firstterm_midterm_end',
        'second_term_start', 'second_term_end', 'secondterm_midterm_start', 'secondterm_midterm_end',
        'third_term_start', 'third_term_end', 'thirdterm_midterm_start', 'thirdterm_midterm_end', 'school_code'
    ];

    protected $dates = [
        'deleted_at', 'start_date', 'end_date', 'firstterm_midterm_start', 'firstterm_midterm_end',
        'second_term_start', 'second_term_end', 'secondterm_midterm_start', 'secondterm_midterm_end',
        'third_term_start', 'third_term_end', 'thirdterm_midterm_start', 'thirdterm_midterm_end',
    ];
}
