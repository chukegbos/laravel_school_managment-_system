<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Lend;
use App\User;
use Auth;

class Book extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'book_code', 'isbn', 'school_code', 'copies_have', 'copies_available', 'author'
    ];

    protected $dates = [
        'deleted_at', 
    ];


    public function getCopiesavailableAttribute()
    {
        $school_code = Auth::user()->school_code;
        $book_code = $this->attributes['book_code'];
		$copies_have = $this->attributes['copies_have'];
        $countbook = Lend::where('school_code', $school_code)->where('book_code', $book_code)->where('status', 0)->where('deleted_at', NULL)->count();
        $available = $copies_have - $countbook;
        return $available;   
    }
}