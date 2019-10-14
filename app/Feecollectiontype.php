<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feecollectiontype extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'type', 'title', 'description', 'school_code'
    ];

    protected $dates = [
        'deleted_at', 
    ];
}