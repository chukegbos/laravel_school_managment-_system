<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Teacher;
use App\Student;

class Applicant extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'application_id', 'form_id', 'firstname', 'lastname', 'middlename', 'gender', 'dob', 'address', 'present_school', 'present_class', 'class_of_interest', 'guardian_name', 'guardian_title', 'guardian_address', 'guardian_phone', 'guardian_email', 'nationality', 'state', 'lga', 'status',

    ];

    protected $dates = [
        'deleted_at', 'dob',
    ];
}