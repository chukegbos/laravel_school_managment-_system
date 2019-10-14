<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'roll', 'lastname', 'middlename', 'firsname', 'password', 'gender', 'image', 'religion', 'dob', 'current_address', 'parmanent_address', 'country', 'state', 'city', 'class', 'form', 'category', 'email', 'phone', 'last_degree', 'university_attended', 'subject', 'school_code', 'salary', 'level', 'post'
    ];

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     protected $dates = [
        'deleted_at', 'dob'
    ];

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['dob'])->age;
    }
}
