<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Classes;

class Student extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'term', 'roll', 'lastname', 'middlename', 'firsname', 'password', 'gender', 'image', 'religion', 'dob', 'current_address', 'parmanent_address', 'country', 'state', 'city', 'doa', 'class', 'form', 'photo', 'guardian_relationship', 'guardian_initial', 'guardian_name', 'guardian_occupation', 'guardian_email', 'guardian_phone', 'guardian_address', 'g_image', 'school_id', 'siteini', 'bg', 'genotype', 'asthmatic', 'eye', 'eye_issue', 'disability', 'disability_issue', 'other_med', 'tribe', 'birth_certificate', 'acceptance_form', 'medical_certificate', 'transfer_certificate', 'licence', 'lgi', 'fslc', 'other_certificate', 'hostel', 'bed', 'current_session'
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
        'deleted_at', 'doa', 'dob'
    ];

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['dob'])->age;
    }

    public function getClassAttribute()
    {
        $id = $this->attributes['class'];
        
        $classes = Classes::where('deleted_at', NULL)->where('id', $id)->first();
        if(isset($classes)){
            $name = $classes->name.$classes->form;
        return $name;}
    }
}
