<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salary extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'track_id', 'month', 'description', 'amount', 'session', 'term', 'payee', 'paid_to', 'school_code', 'status'
    ];

    protected $dates = [
        'deleted_at', 
    ];
}