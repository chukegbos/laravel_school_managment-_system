<?php

namespace App\Http\Controllers;

use App\Admission;
use App\Applicant;
use App\School;
use App\User;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = request('status'); 
        $error = request('error'); 
        $form_id = request('form_id'); 
        if (isset($form_id)) {
            $admission = Admission::where('form_id', $form_id)->first();
            $school_code = $admission->school_code;
            $school = School::where('school_code', $school_code)->first();

            $lastapplicant = Applicant::where('deleted_at', NULL)->where('form_id', $form_id)->orderBy('id', 'desc')->first();
      
            if (isset($lastapplicant)) 
            {
                $lastid = $lastapplicant->id + 1;
            }
            else
            {
                $lastid = "1";
            }
            $application_id = $form_id.'/00'.$lastid;

            return view('admissionform', compact('admission', 'school', 'application_id', 'status', 'error'));
        }
        else
        {
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function back()
    {
        return back();
    }

    public function storeadmission(Request $request)
    {
        Applicant::create($request->all());
        $status = 'Admission Application Received Successfully. Your application number is '.$request->application_id.'. Make sure you copy it out as you will be required to use it through out your admission process.';
        return redirect()->route('getadmission', array('status' => $status, 'form_id' => $request->form_id));
    }

    public function successform()
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
     * @param  \App\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function show(Admission $admission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function edit(Admission $admission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admission $admission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admission $admission)
    {
        //
    }
    
    public function passwordemail(Request $request)
    {
        $email = $request->email; 
        //return $email;
        $user = User::where('deleted_at', NULL)->where('email', $email)->first();
        if (isset($user)) {

            $to      = $email; // Send email to our user
            $subject = 'Forgot Password | High School Manager'; // Give the email a subject 
            $message = '
             
            You requested to change your password, if you did not make this request, kindly ignore this message,
            otherwise click this link to change your passowrd:

            <a href="https://myschool.highschoolmanager.com.ng/verify.php?email='.$email.'" Change Password </a>Aut sed dolorem perspiciatis aut dolore veniam nesciunt ullam eos voluptate ut quibusdam totam eiusmod'; // Our message above including the link

                                 
            $headers = 'From:noreply@highschoolmanager.com.ng' . "\r\n"; // Set from headers
            mail($to, $subject, $message, $headers); // Send our email

            return back();
        }
        else
        {
            $error = "No user with such email found!";
            return redirect()->route('password_request', array('error' => $error));
        }
          
    }
}
