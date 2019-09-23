<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


class Station extends Model
{
    
    use SoftDeletes;
    protected $fillable = [
        'session', 'term', 'class', 'form', 'roll', 'firstname', 'lastname', 'middlename', 'subject_oferred', 'school_id', 'siteini'
    ];

    protected $dates = [
        'deleted_at', 
    ];
}
