<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Standard extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'session', 'term', 'a_min', 'b_min', 'c_min', 'd_min', 'e_min', 'f_min', 'a_max', 'b_max', 'c_max', 'd_max', 'e_max', 'f_max', 'test1', 'test2', 'test3', 'test4', 'test5', 'exam', 'school_code', 'siteini'
    ];

    protected $dates = [
        'deleted_at', 
    ];
}
