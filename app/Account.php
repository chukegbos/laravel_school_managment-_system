<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'track_id', 'month', 'description', 'amount', 'session', 'term', 'payee', 'paid_to', 'school_code', 'status', 'class'
    ];

    protected $dates = [
        'deleted_at', 
    ];
}