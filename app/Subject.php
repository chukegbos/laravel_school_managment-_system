<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


class Subject extends Model
{
    
    use SoftDeletes;
    protected $fillable = [
        'name', 'slug', 'school_code', 'siteini'
    ];

    protected $dates = [
        'deleted_at', 
    ];
}
