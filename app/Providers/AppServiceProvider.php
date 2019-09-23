<?php

namespace App\Providers;

use View;
use Auth;
use App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\School;
use App\Student;
use App\Teacher;
use App\Classes;
use App\Subject;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        View::composer('*', function($view){
            
            if (Auth::guard('web')->check()) {
                $school_code = Auth::user()->school_code;
                $view->with('setting', School::where('school_code', $school_code)->first()); 
                   
                $view->with('schools', School::where('deleted_at', NULL)->get());

                $view->with('countstudent', Student::where('deleted_at', NULL)->where('school_code', $school_code)->count());
                $view->with('countstaff', Teacher::where('deleted_at', NULL)->where('school_code', $school_code)->count());
                $view->with('countsubject', Subject::where('deleted_at', NULL)->where('school_code', $school_code)->count());
                $view->with('countclass', Classes::where('deleted_at', NULL)->where('school_code', $school_code)->count());
            }

            /**$setting1 = Setting::where('id', $school_code)->first();

            if (isset($setting1)) {
                $settingsession = $setting1->current_session;
                $settingterm = $setting1->current_term;
                $view->with('$session1', Session::where('school_code', $school_code)->where('name', $settingsession)->first());

                $view->with('standard', Standard::where('school_code', $school_code)->first());
                $view->with('sessions', Session::where('school_code', $school_code)->first()); 
            }*/
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
