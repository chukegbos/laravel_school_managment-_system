<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subjectteacher extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'session', 'term', 'class', 'roll', 'lastname', 'subject', 'school_code'
    ];

    protected $dates = [
        'deleted_at', 
    ];
}
