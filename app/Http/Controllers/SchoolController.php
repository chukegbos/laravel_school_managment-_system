<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Setting;
use App\User;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function stafflogin(Request $request)
    { 
        if (isset($request->zalla)) {
            if (Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password])) {
                //If successful, then redirect to their intended location
                //return $request;
               return redirect('/home');
            }
             return redirect()->back()->withInput($request->only('username', 'remember'));
        }
        else
        {
            $role = $request->role; 
            if (Auth::guard('web')->attempt(['school_code' => $request->school_code, 'role' => $role, 'username' => $request->username, 'password' => $request->password])) {
                //If successful, then redirect to their intended location
                //return $request;
               return redirect('/home');
            }
        }

        //If unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('username', 'remember'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        //
    }
}
