<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\School;
use App\Student;
use App\Setting;
use App\Session;
use App\Assessment;
use App\Station;
use App\Standard;
use App\Subject;
use App\Subjectteacher;
use App\User;
use App\Teacher;
use App\Classes;
use App\Result;
use App\Admission;
use Auth;
use DB;
use App\Applicant;
use App\Hostel;
use App\Bed;
use App\Lend;
use App\Book;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::today();
        $trial = "Trial";
        $active = "Active";
        $hsm_school = "HSM/2019/0001";
        $demo_school = "HSM/2019/0002";

        $school_code = Auth::user()->school_code;
        $checkschool = School::where('school_code', $school_code)->first();

        if ($checkschool->status!="Active") {
            return view('accountlock', compact('checkschool'));
        }

        $schools = School::where('status', 'trial')->get(); 
        foreach ($schools as $key) {
            if ($key->trial_end<=$today) {
                $key->status = "Inactive";
                $key->update();
            }
        }

        $activeschools = School::where('status', 'active')->where('school_code', '!=', $demo_school)->where('school_code', '!=', $hsm_school)->get();
        foreach ($activeschools as $key) {
            if ($key->active_end<=$today) {
                $key->status = "Inactive";
                $key->update();
            }
        }

        $status = request('status'); 
        $error = request('error'); 
        if (Auth::user()->role=="Staff") {
            $name = Auth::user()->username;
            $form = Classes::where('deleted_at', NULL)->where('form_teacher', $name)->first();
            if (isset($form)) {

                $subject_offered = $form->subject_offered;
                $exploded = explode(",",$subject_offered);
                $length = count($exploded);
                return view('admin.index', compact('status', 'error', 'exploded', 'length'));
            }
            else
            {
                return view('admin.index', compact('status', 'error'));
            }
        }
        else
        {
            return view('admin.index', compact('status', 'error'));
        }       
    }

    public function schools()
    {
        $school_status = request('school_status');
        if (isset($school_status)) {
            $schoolss = School::where('deleted_at', NULL)->where('status', $school_status)->get();
            return view('admin.schools', compact('schoolss', 'school_status'));
        }
        else{
            $schoolss = School::where('deleted_at', NULL)->get();
            return view('admin.schools', compact('schoolss'));
        }       
    }

    public function create_school()
    {
        $today = Carbon::today();
        $year = $today->year;
        $month = $today->month;
        $day = $today->day;

        $lastuser = School::where('deleted_at', NULL)->orderBy('id', 'desc')->first();
        if (isset($lastuser)) 
        {
            $lastid = $lastuser->id + 1;
        }
        else
        {
            $lastid = "1";
        }
        $school_code = 'HSM/'.$year.'/000'.$lastid;
        return view('admin.create_school', compact('school_code'));    
    }

    public function storeschool(Request $request)
    {
        $today = Carbon::now();
        $end = $today->addDays(30);

        $step1 = new School();
        $step1->school_name = $request->school_name;
        $step1->school_code = $request->school_code;
        $step1->slogan = $request->slogan;
        $step1->ini = $request->ini;
        $step1->address = $request->address;
        $step1->email = $request->email;
        $step1->phone = $request->phone;
        $step1->status = $request->status;
        $step1->color = "#36324e";

        
        if ($request->status=="Trial") {
            $step1->trial_end = $end;
            $step1->trial_start = $today;
        }
        elseif ($request->status=="Active")
        {
            $step1->active_end = $today->addDays(366);
        }
        
    
        $step1->current_session = $request->current_session;
        $step1->current_term = $request->current_term;
        $step1->representative_type = $request->representative_type;
        $step1->representative = $request->representative;
        $step1->assessment = $request->assessment;
        $step1->save();
        
        $step2 = new User();
        $step2->username = $request->username;
        $step2->school_code = $request->school_code;
        $step2->email = $request->email;
        $step2->password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm';
        $step2->role = 'Admin';
        $step2->sub_role = 'School Admin';
        $step2->save();

        $step3 = new User();
        $step3->school_code = $request->school_code;
        $step3->password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm';
        $step3->role = 'Entrance Admin';
        $step3->sub_role = 'Entrance School Admin';
        $step3->save();

        $step4 = new Session();
        $step4->school_code = $request->school_code;
        $step4->name = $request->current_session;

        $step4->start_date = Carbon::now();
        $step4->end_date = Carbon::now();
        $step4->firstterm_midterm_start = Carbon::now();
        $step4->firstterm_midterm_end = Carbon::now();

        $step4->second_term_start = Carbon::now();
        $step4->second_term_end = Carbon::now();
        $step4->secondterm_midterm_start = Carbon::now();
        $step4->secondterm_midterm_end = Carbon::now();

        $step4->third_term_start = Carbon::now();
        $step4->third_term_end = Carbon::now();
        $step4->thirdterm_midterm_start = Carbon::now();
        $step4->thirdterm_midterm_end = Carbon::now();
        $step4->save();
        
        $to      = $request->email; // Send email to our user
        $subject = 'New School | High School Manager'; // Give the email a subject 
        $message = '
        Hello,
        Thank you for signing up with High School Manager, you can now have access to online school management solution to ease up your school managerial activities.

        You can access your portal via https://myschool.swiftonlineschool.com
        Your School Details
            School Code: '.$request->school_code.'
            School Name: '.$request->school_name.'
            Email: '.$request->email.'
            
            
        Your School Details  
            Login School Code: '.$request->school_code.'
            Login username: '.$request->username.'
            Login Password: secret
            Login Role: School Administrator
       
        Thank you once again for using this platform.
        
        
        Chukwunonso Egbo
        For:    High School Manager
                info@highschoolmanager.com.ng
                08066267671
       '; // Our message above including the link

        $mainmessage = strip_tags($message); 
        $headers = 'From:noreply@highschoolmanager.com.ng' . "\r\n";; // Set from headers
        mail($to, $subject, $mainmessage, $headers); // Send our email
                
                
        //Attempt to log the user in
        if (Auth::guard('web')->attempt(['school_code' => $request->school_code, 'role' => 'Entrance Admin', 'password' => 'secret'])) {
            //If successful, then redirect to their intended location
            
           return redirect('/admin/sessions');
        } 
        return redirect()->route('reqschool', array('status' => $status));
    }

    public function storeschoolstamp(Request $request)
    {
        $school_code = $request->school_code;
        $school=School::where('deleted_at', NULL)->where('school_code', $school_code)->first();
        $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];

        if ($request->file('school_stamp')) {
            $file1 = $request->file('school_stamp');
            $path1 = Storage::disk('public1')->putFile('school_stamp', $file1);
            $explodeImage = explode('.', $path1);
            $extension = end($explodeImage);

            if(in_array($extension, $imageExtensions))
            {
                $school->school_stamp = $path1;
            }
            else
            {
                $error = "Stamp must be a scanned image";
                return redirect()->route('schoolstamp', array('error' => $error));
            }
        }
        $status = "Succssfully Added";
        $school->update();
        return redirect()->route('schoolstamp', array('status' => $status ));
    }

    public function storeschoollogo(Request $request)
    {
        $school_code = $request->school_code;
        $school=School::where('deleted_at', NULL)->where('school_code', $school_code)->first();
        $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];

        if ($request->file('logo')) {
            $file1 = $request->file('logo');
            $path1 = Storage::disk('public1')->putFile('logo', $file1);
            $explodeImage = explode('.', $path1);
            $extension = end($explodeImage);

            if(in_array($extension, $imageExtensions))
            {
                $school->logo = $path1;
            }
            else
            {
                $error = "Logo must be a scanned image";
                return redirect()->route('schoollogo', array('error' => $error));
            }
        }
        $status = "Logo Succssfully Added";
        $school->update();
        return redirect()->route('schoollogo', array('status' => $status ));
    }


    public function visit()
    {
        $status = request('status'); 
        $error = request('error'); 
        $school_code = request('school_code');
        //Attempt to log the user in
        if (Auth::guard('web')->attempt(['school_code' => $school_code, 'role' => 'Entrance Admin', 'password' => 'secret'])) {
            //If successful, then redirect to their intended location
            
           return redirect('/home');
        }

        return view('admin.schools');
    }

    public function switchback(Request $request)
    {
        $status = request('status'); 
        $error = request('error'); 
        
        //Attempt to log the user in
        if (Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password])) {
            //If successful, then redirect to their intended location
            
           return redirect('/home');
        }
        return back();
    }

    public function extendtime(Request $request)
    {
        $status = request('status'); 
        $error = request('error'); 
        $trial = "Trial"; 
        $id = $request->id;
        $number = $request->number;

        $school = School::findOrFail($id);
        $school->trial_end = $school->trial_end->addDays($number);
        $school->update();
        return redirect()->route('schools', array('school_status' => $trial ));
    }

    public function extendactive(Request $request)
    {
        $status = request('status'); 
        $error = request('error'); 
        $active = "Active"; 
        $id = $request->id;
        $number = $request->number;

        $school = School::findOrFail($id);
        $school->active_end = $school->active_end->addDays($number);
        $school->update();
        return redirect()->route('schools', array('school_status' => $active ));
    }

    public function activate()
    {
        $today = Carbon::today();
        $status = request('status'); 
        $school_code = request('school_code'); 
        $active = "Active"; 

        $school = School::where('school_code', $school_code)->first();
        $school->status = $active;
        $school->active_end = $today->addDays(365);
        $school->update();
        return back();
    }

    public function trial()
    {
        $today = Carbon::today();
        $status = request('status'); 
        $school_code = request('school_code'); 
        $trial = "Trial"; 
        $step1 = School::where('school_code', $school_code)->first();

        $today = Carbon::now();
        $end = $today->addDays(30);
        $step1->trial_end = $end;
        $step1->trial_start = $today;
        $step1->created_at = $today;
        $step1->status = $trial;
        $step1->update();
        return back();
    }

    public function deactivate()
    {
        $today = Carbon::today();
        $status = request('status'); 
        $school_code = request('school_code'); 
        $inactive = "Inactive"; 
        $school = School::where('school_code', $school_code)->first();
        $school->status = $inactive;
        $school->update();
        return back();
    }


    public function sessions()
    {
        $status = request('status'); 
        $error = request('error'); 
        $school_code = Auth::user()->school_code;
        $sessions = Session::where('deleted_at', NULL)->where('school_code', $school_code)->orderBy('created_at', 'asc')->get();
        return view('administration.sessions', compact('sessions', 'status', 'error'));
    }

    public function schoolsetting()
    {
        $status = request('status'); 
        $error = request('error'); 
        $school_code = Auth::user()->school_code;
        return view('admin.schoolsetting', compact('status', 'error'));
    }

    public function admins()
    {
        $status = request('status'); 
        $error = request('error'); 
        $school_code = Auth::user()->school_code;
        $admins = User::where('school_code', $school_code)->where('role', 'Admin')->where('deleted_at', NULL)->get();
        return view('admin.admin', compact('status', 'error', 'admins'));
    }

    public function schoolstamp()
    {
        $status = request('status'); 
        $error = request('error'); 
        $school_code = Auth::user()->school_code;
        return view('admin.schoolstamp', compact('status', 'error'));
    }

    public function schoollogo()
    {
        $status = request('status'); 
        $error = request('error'); 
        $school_code = Auth::user()->school_code;
        return view('admin.schoollogo', compact('status', 'error'));
    }

    public function activate_session()
    {
        $status = request('status'); 
        $error = request('error'); 
        $school_code = request('school_code');
        $current_session = request('current_session');
        $school = School::where('deleted_at', NULL)->where('school_code', $school_code)->first();
        $school->current_session = $current_session;
        $school->update();
        return back();
    }

    public function storesessions(Request $request)
    {
        $sessionsname = $request->name;
        $getsessions = Session::where('deleted_at', NULL)->where('school_code', $school_code)->where('name', $sessionsname)->first();
        if (isset($getsessions)) {
            $error = "Sessions Already Exist";
            return redirect()->route('sessions', array('error' => $error));
        }
        else
        {
            Session::create($request->all());
            $status = "Sessions Added Successfully";
            return redirect()->route('sessions', array('status' => $status));
        }
    }


    public function destroysession($id)
    {
        Session::destroy($id);
        return back();
    }
    public function destroyadmin($id)
    {
        User::destroy($id);
        return back();
    }

    public function storeschoolsetting(Request $request)
    {
        $school_code = $request->school_code;
        $getschool = School::where('deleted_at', NULL)->where('school_code', $school_code)->first();
        $getschool->update($request->all());
        $status = "Updated Successfully";
        return redirect()->route('schoolsetting', array('status' => $status));
    }

    public function updatesession(Request $request)
    {
        $id = $request->id;
        $getsession = Session::where('deleted_at', NULL)->where('id', $id)->first();
        $getsession->update($request->all());
        $status = "Sessions Updated Successfully";
        return redirect()->route('sessions', array('status' => $status));
    }

    public function standard()
    {
        $status = request('status'); 
        $error = request('error'); 
        $school_code = Auth::user()->school_code;
        $standards = Standard::where('deleted_at', NULL)->where('school_code', $school_code)->first();

        if (isset($standards)) {
            return view('administration.standard', compact('standards', 'status', 'error')); 
        }
        else
        {
            return view('administration.createstandard', compact('status', 'error'));
        }
    }

    public function storestandard(Request $request)
    {
        $school_code = Auth::user()->school_code;
        $standards = Standard::where('school_code', $school_code)->first();
        
        $setting = School::where('school_code', $school_code)->first();
        $assessment = $setting->assessment;
        if ($assessment==1) {
            if (($request->test1 + $request->exam) == 100) 
            {
                Standard::create($request->all());            
                $status = "Standard Created Successfully";
                return redirect()->route('standard', array('status' => $status));  
            }
            else{
                $error = "The total score (i.e. 1st Assessment + Exam) must be equal to 100%";
                return redirect()->route('standard', array('error' => $error));  
            } 
        }
        elseif ($assessment==2) {
            if (($request->test1 + $request->test2 + $request->exam) == 100) 
            {
                Standard::create($request->all());            
                $status = "Standard Created Successfully";
                return redirect()->route('standard', array('status' => $status));  
            }
            else{
                $error = "The total score (i.e. 1st Assessment + 2nd Assessment + Exam) must be equal to 100%";
                return redirect()->route('standard', array('error' => $error));  
            } 
        }
        elseif ($assessment==3) {
            if (($request->test1 + $request->test2 +$request->test3 + $request->exam) == 100) 
            {
                Standard::create($request->all());            
                $status = "Standard Created Successfully";
                return redirect()->route('standard', array('status' => $status));  
            }
            else{
                $error = "The total score (i.e. 1st Assessment + 2nd Assessment + 3rd Assessment + Exam) should be equal to 100%";
                return redirect()->route('standard', array('error' => $error));  
            } 
        }
        else {
            if (($request->test1 + $request->test2 + $request->test3 + $request->test4 + $request->exam) == 100) 
            {
                Standard::create($request->all());            
                $status = "Standard Created Successfully";
                return redirect()->route('standard', array('status' => $status));  
            }
            else{
                $error = "The total score (i.e. 1st Assessment + 2nd Assessment + 3rd Assessment + 4th Assessment + Exam) should be equal to 100%";
                return redirect()->route('standard', array('error' => $error));  
            } 
        }
    }

    public function updatestandard(Request $request)
    {
        $school_code = Auth::user()->school_code;
        $standards = Standard::where('school_code', $school_code)->first();
        $setting = School::where('school_code', $school_code)->first();

        $status = request('status'); 
        $error = request('error'); 
        $assessment = $setting->assessment;
        if ($assessment==1) {
            if (($request->test1 + $request->exam) == 100) {
                $standards->update($request->all());
                $status ="Standard Successfully Set";
                return redirect()->route('standard', array('status' => $status));
            }
            else
            {
                $error = "The total score (i.e. 1st Assessment + Exam) should be equal to 100%";
                return redirect()->route('standard', array('error' => $error));
            }
        }
        elseif ($assessment==2) {
            if (($request->test1 + $request->test2 + $request->exam) == 100) {
                $standards->update($request->all());
                $status ="Standard Successfully Set";
                return redirect()->route('standard', array('status' => $status));
            }
            else
            {
                $error = "The total score (i.e. 1st Assessment + 2nd Assessment + Exam) should be equal to 100%";
                return redirect()->route('standard', array('error' => $error));
            }
        } 
        elseif ($assessment==3) {
            
            if (($request->test1 + $request->test2 + $request->test3 + $request->exam) == 100) {
            
                $standards->update($request->all());
                $status ="Standard Successfully Set";
                return redirect()->route('standard', array('status' => $status));
            }
            else
            {
                $error = "The total score (i.e. 1st Assessment + 2nd Assessment + 3rd Assessment + Exam) should be equal to 100%";
                return redirect()->route('standard', array('error' => $error));
            }
        } 
        else{
            if (($request->test1 + $request->test2 + $request->test3 + $request->test4 + $request->exam) == 100) {
                $standards->update($request->all());
                $status ="Standard Successfully Set";
                return redirect()->route('standard', array('status' => $status));
            }
            else
            {
                $error = "The total score (i.e. 1st Assessment + 2nd Assessment + 3rd Assessment + 4th Assessment + Exam) should be equal to 100%";
                return redirect()->route('standard', array('error' => $error));
            }
        }      
    }

    //subject
     public function subjects()
    {
        $status = request('status'); 
        $error = request('error'); 
        $school_code = Auth::user()->school_code;
        $subjects = Subject::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        return view('academics.subjects', compact('subjects', 'status', 'error'));
    }

    public function storesubject(Request $request)
    {
        $school_code = Auth::user()->school_code;
        $name = $request->name;

        $getsubject = Subject::where('deleted_at', NULL)->where('school_code', $school_code)->where('name', $name)->first();
        if (isset($getsubject)) {
            $error = "Subject Already Exist";
            return redirect()->route('subjects', array('error' => $error));
        }
        else{
            $step1 = new Subject();
            $slug = str_slug($request->name, '-');
            $step1->slug = $slug;
            $step1->name = $request->name;
            $step1->school_code = $request->school_code;
            $step1->save();

            $status = "Subject Added Successfully";
            return redirect()->route('subjects', array('status' => $status));
        }
    }

     public function destroysubject($id)
    {
        Subject::destroy($id);
        return back();
    }


    //Teachers
    public function staff()
    {
        $status = request('status'); 
        $error = request('error'); 
        $subject = request('subject'); 
        $school_code = Auth::user()->school_code;
        $school = School::where('school_code', $school_code)->where('deleted_at', NULL)->first();
        
        $term = $school->current_term;
        $session = $school->current_session;

        $classes = Classes::where('school_code', $school_code)->where('deleted_at', NULL)->get();
        $subjectteachers = Subjectteacher::where('school_code', $school_code)->where('term', $term)->where('session', $session)->where('deleted_at', NULL)->get();

        if (isset($subject)) {
            $teachers = Teacher::where('deleted_at', NULL)->where('school_code', $school_code)->where('subject', $subject)->orderBy('created_at', 'desc')->get();
        }
        else{
            $teachers = Teacher::where('deleted_at', NULL)->where('school_code', $school_code)->orderBy('created_at', 'desc')->get();
        }
        return view('academics.teachers', compact('teachers', 'status', 'error', 'classes', 'subject', 'subjectteachers'));
    }

    public function addteacher()
    {
        $school_code = Auth::user()->school_code;
        $classes = Classes::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        $subjects = Subject::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        return view('academics.addteacher', compact('classes', 'subjects'));
    }

    public function storeteacher(Request $request)
    {
        $teacher = new Teacher();
        $teacher->school_code = $request->school_code; 
        $teacher->roll = $request->roll; 
        $teacher->lastname = $request->lastname;
        $teacher->firstname = $request->firstname;
        $teacher->middlename = $request->middlename;
        $teacher->phone = $request->phone; 
        $teacher->email = $request->email;
        $teacher->password = bcrypt($request['password']);
        $teacher->gender = $request->gender;
        $teacher->religion = $request->religion; 
        $teacher->dob = $request->dob; 
        $teacher->country = $request->country;
        $teacher->state = $request->state; 
        $teacher->city = $request->city; 
        $teacher->class = $request->class;
        $teacher->last_degree = $request->last_degree; 
        $teacher->category = $request->category; 
        $teacher->current_address = $request->current_address; 
        $teacher->parmanent_address = $request->parmanent_address;
        $teacher->university_attended = $request->university_attended;
        $teacher->subject = $request->subject; 

        $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];

        if ($request->file('image')) {
            $file1 = $request->file('image');
            $path1 = Storage::disk('public1')->putFile('teacher_image', $file1);
            $explodeImage = explode('.', $path1);
            $extension = end($explodeImage);

            if(in_array($extension, $imageExtensions))
            {
                $teacher->image = $path1;
            }
            else
            {
                $error = "Photo must be a scanned image";
                return redirect()->route('addteacher', array('error' => $error));
            }
        }
        $teacher->save();
        $status = "Succssfully Addeded";


        $step2 = new User();
        $step2->username = $request->roll;
        $step2->school_code = $request->school_code;
        $step2->email = $request->email;
        $step2->password = bcrypt($request['password']);
        $step2->role = 'Staff';
        $step2->sub_role = 'School Staff';
        $step2->save();
        return redirect()->route('staff', array('status' => $status));
    }

    public function destroyteacher($id)
    {
        $teacher = Teacher::where('id', $id)->first();
        $roll = $teacher->roll;
        $user = User::where('username', $roll)->first();
        $userid = $user->id;
        User::destroy($userid);
        Teacher::destroy($id);
        return back();
    }

    public function teacherprofile()
    {
        $roll = request('roll');  
        $profile = Teacher::where('deleted_at', NULL)->where('roll', $roll)->first();
        $school_code = Auth::user()->school_code;
        return view('academics.staffprofile', compact('profile'));    
    }

     public function editstaff()
    {
        $roll = request('roll');  
        $profile = Teacher::where('deleted_at', NULL)->where('roll', $roll)->first();
        $school_code = Auth::user()->school_code;
        $subjects = Subject::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        return view('academics.editstaff', compact('profile', 'subjects'));       
    }
   
    public function updatestaff(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->roll = $request->roll; 
        $teacher->lastname = $request->lastname;  
        $teacher->firstname = $request->firstname;
        $teacher->middlename = $request->middlename;
        $teacher->phone = $request->phone; 
        $teacher->email = $request->email;
        $teacher->gender = $request->gender;
        $teacher->religion = $request->religion; 
        $teacher->dob = $request->dob; 
        $teacher->country = $request->country;
        $teacher->state = $request->state; 
        $teacher->city = $request->city; 
        $teacher->position = $request->position;
        $teacher->last_degree = $request->last_degree; 
        $teacher->category = $request->category; 
        $teacher->current_address = $request->current_address; 
        $teacher->parmanent_address = $request->parmanent_address;
        $teacher->university_attended = $request->university_attended;
        $teacher->subject = $request->subject; 
        $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];

        if ($request->file('image')) {
            $file1 = $request->file('image');
            $path1 = Storage::disk('public1')->putFile('teacher_image', $file1);
            $explodeImage = explode('.', $path1);
            $extension = end($explodeImage);

            if(in_array($extension, $imageExtensions))
            {
                $teacher->image = $path1;
            }
            else
            {
                $error = "Photo must be a scanned image";
                return redirect()->route('addteacher', array('error' => $error));
            }
        }   
        $status = "Profile Updated Successfully"; 
        $teacher->update();
        return redirect()->route('staff', array('status' => $status, 'roll' => $request->roll));
    } 

    public function classes()
    {
        $school_code = Auth::user()->school_code;
        $settings = School::where('school_code', $school_code)->first();
        $mainterm = $settings->current_term;
        $mainsession = $settings->current_session;

        $status = request('status'); 
        $error = request('error'); 
        $mainsubject = request('subject'); 
       
        if (isset($mainsubject)) {
            $classes= Classes::where('school_code', $school_code)->where('deleted_at', NULL)->where('subject_offered','LIKE','%'.$mainsubject.'%')->get();
            $subjectteachers = Subjectteacher::where('deleted_at', NULL)->where('school_code', $school_code)->where('term', $mainterm)->where('session', $mainsession)->get();
            $teachers = Teacher::where('subject', $mainsubject)->where('deleted_at', NULL)->where('school_code', $school_code)->orderBy('created_at', 'desc')->get();
            $subjects = Subject::where('name', $mainsubject)->where('deleted_at', NULL)->where('school_code', $school_code)->get();
            return view('academics.classes', compact('classes', 'error', 'status', 'teachers', 'mainsubject', 'subjects', 'subjectteachers'));
        }
        else
        {
            $subjects = Subject::where('deleted_at', NULL)->where('school_code', $school_code)->get();
            $teachers = Teacher::where('deleted_at', NULL)->where('school_code', $school_code)->orderBy('created_at', 'desc')->get();
            
            $classes=Classes::where('school_code', $school_code)->where('deleted_at', NULL)->get();
            return view('academics.classes', compact('classes', 'error', 'status', 'teachers', 'subjects'));
        }
        
        
    }

    public function storeclasses(Request $request)
    {
        $classname = $request->name;
        $form = $request->form;
        $school_code = $request->school_code;
        
        $getclass = Classes::where('deleted_at', NULL)->where('name', $classname)->where('form', $form)->where('school_code', $school_code)->first();
        if (isset($getclass)) {
            $error = "Class Already Exist";
            return redirect()->route('admin.class', array('error' => $error));
        }
        else{
            $step1 = new Classes();
            $step1->name = $request->name;
            $step1->form = $request->form;
            $setslug = $request->name.' '.$request->form;
            $slug = str_slug($setslug, '-');
            $step1->slug = $slug;
            $step1->school_code = $request->school_code;
            $step1->title = $request->title;
            $step1->save();
            //Classes::create($request->all());

            $status = "Class Added Successfully";
            return redirect()->route('admin.class', array('status' => $status));
        }
    }

    public function destroyclass($id)
    {
        Classes::destroy($id);
        return back();
    }

    public function form_teacher(Request $request)
    {
        $id = $request->id;
        $classes = Classes::where('deleted_at', NULL)->where('id', $id)->first();
        $classes->update($request->all());
        $status = "Form Teacher Updated Successfully";
        return redirect()->route('admin.class', array('status' => $status));
    }

    public function subject_teacher(Request $request)
    {
        $school_code = Auth::user()->school_code;
        $settings = School::where('school_code', $school_code)->first();
        $mainterm = $settings->current_term;
        $mainsession = $settings->current_session;

        $class = $request->class;
        $roll = $request->roll;
        $subject = $request->subject;

        $subjectteachers = Subjectteacher::where('school_code', $school_code)->where('deleted_at', NULL)->where('session', $mainsession)->where('term', $mainterm)->where('class', $class)->where('subject', $subject)->first();
        if (isset($subjectteachers)) {
            $subjectteachers->roll = $roll;
            $subjectteachers->update();
        }
        else{
          $teacher = new Subjectteacher();
          $teacher->school_code = $school_code;
          $teacher->session = $mainsession;
          $teacher->term = $mainterm;
          $teacher->class = $class;
          $teacher->subject = $subject;
          $teacher->roll = $roll;
          $teacher->save();
        }

        $status = "Subject Teacher Updated Successfully";
        return redirect()->route('admin.class', array('status' => $status, 'subject' => $subject));
    }


    public function registersubject(Request $request)
    {
        $id = $request->id;  
        $school_code = Auth::user()->school_code;
        $classes = Classes::findOrFail($id); 
        $classes->subject_offered = collect($request->subject_offered)->implode(',');
        $classes->update();
        $status = "Subjects Registered Successfully";
        if (Auth::user()->role=="Staff") {
            return redirect()->route('formclass', array('status' => $status));
        }else
        {
            return redirect()->route('admin.class', array('status' => $status));
        }
    }

    public function allstudents()
    { 
        $school_code = Auth::user()->school_code;
        $class_id = request('class_id');  
        if (isset($class_id)) {
            $allstudents = Student::where('deleted_at', NULL)->where('school_code', $school_code)->where('class', $class_id)->orderBy('created_at', 'desc')->get();
        }
        else
        {
           $allstudents = Student::where('deleted_at', NULL)->where('school_code', $school_code)->orderBy('created_at', 'desc')->get(); 
        }
        
        $classes = Classes::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        return view('academics.students', compact('allstudents', 'classes'));
    }

    public function addstudent()
    {
        $today = Carbon::today();
        $year = $today->year;
        $month = $today->month;
        $day = $today->day;
        $school_code = Auth::user()->school_code;
        $school = School::where('school_code', $school_code)->first();
        $ini = $school->ini;
        $lastuser = Student::where('deleted_at', NULL)->where('school_code', $school_code)->orderBy('id', 'desc')->first();
        if (isset($lastuser)) 
        {
            $lastid = $lastuser->id + 1;
        }
        else
        {
            $lastid = "1";
        }
        $random_number = 'HSM/'.$ini.'/'.$year.'/000'.$lastid;

        $classes = Classes::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        $subjects = Subject::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        $hostels = Hostel::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        return view('academics.addstudent', compact('random_number', 'classes', 'subjects', 'hostels'));
    }

    public function storestudent(Request $request)
    {
        $school_code = Auth::user()->school_code;
        
        $student = new Student();
        $student->school_code = $school_code; 
        $student->roll = $request->roll; 
        $student->lastname = $request->lastname;  
        $student->firstname = $request->firstname;
        $student->middlename = $request->middlename; 
        $student->gender = $request->gender;
        $student->religion = $request->religion; 
        $student->dob = $request->dob; 
        $student->country = $request->country;
        $student->state = $request->state; 
        $student->city = $request->city; 
        if(isset($request->class))
        {
            $student->class = $request->class;
        }
        
        if(isset($request->hostel))
        {
            $hostel = Hostel::where('code', $request->hostel)->where('school_code', $school_code)->first();
            $bed = Bed::where('deleted_at', NULL)->where('hostel_code', $request->hostel)->where('occupant', NULL)->first();
            
            if(isset($bed)){
                $bed->occupant =  $request->roll;
                $bed->update();
                
                $student->hostel = $request->hostel;
                $student->bed = $bed->bed_number;
            }
            else{
                $nospace = 'No more bed space at '.$hostel->name.', Please create more bed space and reallocate this student to one.';
            }
        }
        
        $student->doa = $request->doa; 
        $student->current_address = $request->current_address; 
        $student->parmanent_address = $request->parmanent_address;
        $student->guardian_relationship = $request->guardian_relationship; 
        $student->guardian_initial = $request->guardian_initial; 
        $student->guardian_name = $request->guardian_name;
        $student->guardian_occupation = $request->guardian_occupation; 
        $student->guardian_phone = $request->guardian_phone; 
        $student->guardian_email = $request->guardian_email;
        $student->guardian_address = $request->guardian_address;

        

        $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];

        if ($request->file('image')) {
            $file1 = $request->file('image');
            $path1 = Storage::disk('public1')->putFile('student_image', $file1);
            $explodeImage = explode('.', $path1);
            $extension = end($explodeImage);

            if(in_array($extension, $imageExtensions))
            {
                $student->image = $path1;
            }
            else
            {
                $error = "Photo must be a scanned image";
                return redirect()->route('add_Student', array('error' => $error));
            }
        }
        $student->save();

        $step2 = new User();
        $step2->username = $request->roll;
        $step2->school_code = $school_code;
        $step2->password = bcrypt('secret');
        $step2->role = 'Student';
        $step2->sub_role = 'School Student';
        $step2->save();

        if(isset($nospace))
        {
            $status = 'Student added successfully. '.$nospace;
        }
        else
        {
             $status = 'Student added successfully.';
        }
        return redirect()->route('studentprofile', array('roll' => $request->roll, 'status' =>$status)); 
    }
    
    public function station(Request $request)
    {
        $school_code = Auth::user()->school_code;
        $class = $request->class;
        $roll = $request->roll;
        
        $student = Student::where('roll', $roll)->first();
        $student->class = $class;
        $student->save();
        $status = "Class Assigned Successfully";
         return redirect()->route('studentprofile', array('roll' => $request->roll, 'status' =>$status)); 
    }
    
    public function studentprofile()
    {
        $roll = request('roll');
        $error = request('error');
        $status = request('status');
        $profile = Student::where('deleted_at', NULL)->where('roll', $roll)->first();   
        $school_code = Auth::user()->school_code;
        $standards = Standard::where('school_code', $school_code)->where('deleted_at', NULL)->first();
        $classes=Classes::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        $hostels=Hostel::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        return view('academics.profile', compact('profile', 'standards', 'classes', 'hostels', 'status', 'error'));    
    }

    public function editstudent()
    {
        $roll = request('roll');  
        $status = request('status');  
        $error = request('error');  
        $profile = Student::where('deleted_at', NULL)->where('roll', $roll)->first();
        $school_code = Auth::user()->school_code;
        $classes = Classes::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        $subjects = Subject::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        $hostels=Hostel::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        return view('academics.editstudent', compact('profile', 'classes', 'subjects', 'status', 'error', 'hostels'));       
    }

    public function updatestudent(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        if (isset($request->lastname)) {
            $student->lastname = $request->lastname;  
            $student->firstname = $request->firstname;
            $student->middlename = $request->middlename; 
            $student->gender = $request->gender;
            $student->religion = $request->religion; 
            $student->dob = $request->dob; 
            $student->tribe = $request->tribe; 
            $student->country = $request->country;
            $student->state = $request->state; 
            $student->city = $request->city;
            $student->current_address = $request->current_address; 
            $student->parmanent_address = $request->parmanent_address;

            if ($request->file('image')) {
                $file1 = $request->file('image');
                $path1 = Storage::disk('public1')->putFile('student_image', $file1);
                $explodeImage = explode('.', $path1);
                $extension = end($explodeImage);

                if(in_array($extension, $imageExtensions))
                {
                    $student->image = $path1;
                }
                else
                {
                    $error = "Photo must be a scanned image";
                    return redirect()->route('admin.editstudent', array('error' => $error, 'roll' => $roll));
                }
            }

            $student->save();
            $status ="Student profile Successfully Editted";
            $roll = $student->roll;
            return redirect()->route('admin.editstudent', array('status' => $status, 'roll' => $roll)); 
        }

        elseif (isset($request->guardian_initial)) {
            $student->guardian_relationship = $request->guardian_relationship; 
            $student->guardian_initial = $request->guardian_initial; 
            $student->guardian_name = $request->guardian_name;
            $student->guardian_occupation = $request->guardian_occupation; 
            $student->guardian_phone = $request->guardian_phone; 
            $student->guardian_email = $request->guardian_email;
            $student->guardian_address = $request->guardian_address;
            if ($request->file('g_image')) {           
                $file = $request->file('g_image');
                $path = Storage::disk('public1')->putFile('parent_image', $file);
                $student->g_image = $path;
            } 
            $student->save();
            $status ="Student profile Successfully Editted";
            $roll = $student->roll;
            return redirect()->route('admin.editstudent', array('status' => $status, 'roll' => $roll));
        }

        elseif (isset($request->class)) 
        {
            if ($request->hostel!=$student->hostel) {
                $oldbed = Bed::where('deleted_at', NULL)->where('occupant', $student->roll)->get();
                foreach ($oldbed as $key) {
                    $key->occupant = NULL;
                    $key->update();
                }
                $bed = Bed::where('deleted_at', NULL)->where('hostel_code', $request->hostel)->where('occupant', NULL)->first();
                if(isset($bed))
                {
                    $bed->occupant =  $request->roll;
                    $bed->update();
                    $student->hostel = $request->hostel;
                    $student->bed = $bed->bed_number;
                }
            }

            $student->roll = $request->roll; 
            $student->class = $request->class;
            $student->doa = $request->doa;
            $student->save();
            $status ="Student profile Successfully Editted";
            $roll = $student->roll;
            return redirect()->route('admin.editstudent', array('status' => $status, 'roll' => $roll));  
        }

        elseif (isset($request->bg)) {
            $student->bg = $request->bg; 
            $student->genotype = $request->genotype; 
            $student->asthmatic = $request->asthmatic;
            $student->eye = $request->eye; 
            $student->eye_issue = $request->eye_issue; 
            $student->disability = $request->disability;
            $student->disability_issue = $request->disability_issue;
            $student->other_med = $request->other_med;
          
            $student->save();
            $status ="Medical Profile Successfully Editted";
            $roll = $student->roll;
            return redirect()->route('admin.editstudent', array('status' => $status, 'roll' => $roll)); 
        }

        elseif (isset($request->id)) {
            if ($request->file('birth_certificate')) {           
                $file = $request->file('birth_certificate');
                $path = Storage::disk('public1')->putFile('Credential', $file);
                $student->birth_certificate = $path;
            } 

            if ($request->file('acceptance_form')) {           
                $file = $request->file('acceptance_form');
                $path = Storage::disk('public1')->putFile('Credential', $file);
                $student->acceptance_form = $path;
            }

            if ($request->file('medical_certificate')) {           
                $file = $request->file('medical_certificate');
                $path = Storage::disk('public1')->putFile('Credential', $file);
                $student->medical_certificate = $path;
            }

            if ($request->file('transfer_certificate')) {           
                $file = $request->file('transfer_certificate');
                $path = Storage::disk('public1')->putFile('Credential', $file);
                $student->transfer_certificate = $path;
            }

            if ($request->file('licence')) {           
                $file = $request->file('licence');
                $path = Storage::disk('public1')->putFile('Credential', $file);
                $student->licence = $path;
            }

            if ($request->file('lgi')) {           
                $file = $request->file('lgi');
                $path = Storage::disk('public1')->putFile('Credential', $file);
                $student->lgi = $path;
            }
            if ($request->file('fslc')) {           
                $file = $request->file('fslc');
                $path = Storage::disk('public1')->putFile('Credential', $file);
                $student->fslc = $path;
            }
            if ($request->file('other_certificate')) {           
                $file = $request->file('other_certificate');
                $path = Storage::disk('public1')->putFile('Credential', $file);
                $student->other_certificate = $path;
            }
            $student->save();
            $status ="Credential Successfully Updated";
            $roll = $student->roll;

            return redirect()->route('admin.editstudent', array('status' => $status, 'roll' => $roll)); 
        }
    }

    public function addresult()
    { 
        $status = request('status');  
        $error = request('error');  
        $school_code = Auth::user()->school_code;

        $standard = Standard::where('deleted_at', NULL)->where('school_code', $school_code)->first();
        $sessions = Session::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        $classes = Classes::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        $subjects = Subject::where('deleted_at', NULL)->where('school_code', $school_code)->get();
  
        return view('result.chooseresult', compact('standard', 'sessions', 'classes', 'subjects', 'status', 'error'));       
    }

    public function getclass(Request $request)
    {
        $term = $request->term;  
        $session = $request->session; 
        $class= $request->class; 
        $subject_id = $request->subject; 

        $subject = Subject::findOrFail($subject_id);
        $subjectname = $subject->name;
      
        $get_session = Session::findOrFail($session);
        $sessionname = $get_session->name;


        $school_code = Auth::user()->school_code;
        
        $students = Student::where('school_code', $school_code)->where('deleted_at', NULL)->Where('class', $class)->get();
       

        $classes = Classes::findOrFail($class);
        $subject_offers = $classes->subject_offered;
        $exploded = explode(",", $subject_offers);

        $subjectteachers = Subjectteacher::where('school_code', $school_code)->where('deleted_at', NULL)->where('session', $sessionname)->where('term', $term)->where('class', $class)->where('subject', $subject->name)->first();
        if (isset($subjectteachers)) {
          $teacher = $subjectteachers->roll; 
        }
        else{
            $teacher = NULL;
        }      
        if(in_array($subjectname, $exploded)) {
            if ($term != "Annual") {
                foreach($students as $student) {

                    Result::updateOrCreate([
                        'school_code' => $school_code,
                        'class' => $class,
                        'session' => $session,
                        'term' => $term,
                        'subject' => $subject_id,
                        'roll' => $student->roll,
                    ],[
                        'school_code' => $school_code,
                        'class' => $class,
                        'session' => $session,
                        'term' => $term,
                        'teacher' => $teacher,
                        'subject' => $subject_id,
                        'roll' => $student->roll,
                    ]);
                }

                foreach($students as $student) {
                    Result::updateOrCreate([
                        'school_code' => $school_code,
                        'class' => $class,
                        'session' => $session,
                        'term' => 'Annual',
                        'subject' => $subject_id,
                        'roll' => $student->roll,
                    ],[
                        'school_code' => $school_code,
                        'class' => $class,
                        'session' => $session,
                        'term' => 'Annual',
                        'teacher' => $teacher,
                        'subject' => $subject_id,
                        'roll' => $student->roll,
                    ]);
                }
            }
            return redirect()->route('resultsheet', array('session' => $session, 'class' => $class, 'term' => $term, 'subject' => $subject, 'school_code' => $school_code));
        }
        else
        {
            $error = $classes->name.$classes->form.' does not offer '.$subjectname.' or'.$subjectname.' has not be reistered for this class. Kinldy contact the admin to do so.';
            if (Auth::user()->role=="Staff") {
                return redirect()->route('subjectclass', array('error' => $error));
            }
            else
            {
                return redirect()->route('addresult', array('error' => $error));
            } 
       }
    }

    public function resultsheet()
    {
        $school_code = request('school_code');
        $standard = Standard::where('school_code', $school_code)->first();
        $session = request('session'); 
        $term =  request('term'); 
        $class = request('class');  
        $subject = request('subject'); 
        $getsession = Session::findOrFail($session);
        $sessionsname = $getsession->name;

        $getclass = Classes::findOrFail($class);
        $classname = $getclass->name.$getclass->form;

        $getsubject = Subject::findOrFail($subject);
        $subjectname = $getsubject->name;


        $results = Result::where('deleted_at', NULL)->where('school_code', $school_code)->Where('class', $class)->Where('subject', $subject)->where('session', $session)->where('term', $term)->get();

        $checksign = Result::where('deleted_at', NULL)->where('school_code', $school_code)->Where('class', $class)->Where('subject', $subject)->where('session', $session)->where('term', $term)->first();
        if(isset($checksign)){
            $ready = $checksign->sign;
        }
        return view('result.mainresult', compact('results', 'session', 'sessionsname', 'term', 'subject', 'class', 'standard', 'ready', 'classname', 'subjectname'));
    }

    public function readyresult()
    {
        $school_code = Auth::user()->school_code;
        $session = request('session'); 
        $term =  request('term'); 
        $class = request('class');  
        $subject = request('subject');
        $knowstatus= Result::where('deleted_at', NULL)->where('school_code', $school_code)->Where('class', $class)->Where('subject', $subject)->where('session', $session)->where('term', $term)->first();

        if (isset($knowstatus)) {
            $sign = $knowstatus->sign;
            $results = Result::where('deleted_at', NULL)->where('school_code', $school_code)->Where('class', $class)->Where('subject', $subject)->where('session', $session)->where('term', $term)->get();

            if ($sign==NULL) {
                foreach ($results as $result) {
                    $result->sign = "Signed";
                    $result->update();
                }
            }else{
                foreach ($results as $result) {
                    $result->sign = NULL;
                    $result->update();
                }
            }
        }
        return back();
    }

    public function storeresult(Request $request)
    {
        //return $request;
        $id = $request->id;
        $exam = $request->exam;
        $comment = $request->comment;      

        $school_code = Auth::user()->school_code;
        $standards = Standard::where('school_code', $school_code)->first();
        $setschool = School::where('school_code', $school_code)->first();
        
        $term= $request->term;
        $session = $request->session;
      
        if($setschool->assessment==1){
            $first_test = $request->first_test;
            $total = $first_test + $exam;
        }
        elseif ($setschool->assessment==2){
            $first_test = $request->first_test;
            $second_test = $request->second_test;
            $total = $first_test + $second_test + $exam;
        }
        elseif ($setschool->assessment==3){
            $first_test = $request->first_test;
            $second_test = $request->second_test;
            $third_test = $request->third_test;
            $total = $first_test + $second_test + $third_test + $exam;
        }
        elseif ($setschool->assessment==4){
            $first_test = $request->first_test;
            $second_test = $request->second_test;
            $third_test = $request->third_test;
            $forth_test = $request->forth_test;
            $total = $first_test + $second_test + $third_test + $forth_test + $exam;
        }
        else{
            $first_test = $request->first_test;
            $second_test = $request->second_test;
            $third_test = $request->third_test;
            $forth_test = $request->forth_test;
            $fifth_test = $request->fifth_test;
            $total = $first_test + $second_test + $third_test + $forth_test + $fifth_test + $exam;
        }

        $student_result = Result::findOrFail($id);
        $studentroll = $student_result->roll;
        $subject = $student_result->subject;
        $class = $student_result->class;
        

        $firstterm = "First Term";
        $secondterm = "Second Term";
        $thirdterm = "Third Term";
        $annual = "Annual";
       
        if ($term==$thirdterm) {
            $firstterm_result = Result::where('school_code', $school_code)->where('deleted_at', NULL)->where('term', $firstterm)->where('roll', $studentroll)->where('session', $session)->where('subject', $subject)->first();

            if (isset($firstterm_result)) {
                if($setschool->assessment==1){
                    $firstterm_result_test1 = $firstterm_result->first_test;
                }
                elseif($setschool->assessment==2){
                    $firstterm_result_test1 = $firstterm_result->first_test;
                    $firstterm_result_test2 = $firstterm_result->second_test;
                }
                elseif($setschool->assessment==3){ 
                    $firstterm_result_test1 = $firstterm_result->first_test;
                    $firstterm_result_test2 = $firstterm_result->second_test;
                    $firstterm_result_test3 = $firstterm_result->third_test;
                }
                elseif($setschool->assessment==4){ 
                    $firstterm_result_test1 = $firstterm_result->first_test;
                    $firstterm_result_test2 = $firstterm_result->second_test;
                    $firstterm_result_test3 = $firstterm_result->third_test;
                    $firstterm_result_test4 = $firstterm_result->forth_test;
                }
                else{
                    $firstterm_result_test1 = $firstterm_result->first_test;
                    $firstterm_result_test2 = $firstterm_result->second_test;
                    $firstterm_result_test3 = $firstterm_result->third_test;
                    $firstterm_result_test4 = $firstterm_result->forth_test;
                    $firstterm_result_test5 = $firstterm_result->fifth_test;
                }
                $firstterm_result_exam = $firstterm_result->exam;
                $firstterm_result_total = $firstterm_result->total;
            }

            $secondterm_result = Result::where('school_code', $school_code)->where('deleted_at', NULL)->where('term', $secondterm)->where('roll', $studentroll)->where('session', $session)->where('subject', $subject)->first();

            if (isset($secondterm_result)) {
                if($setschool->assessment==1){
                    $secondterm_result_test1 = $secondterm_result->first_test;
                }
                elseif($setschool->assessment==2){       
                    $secondterm_result_test1 = $secondterm_result->first_test;
                    $secondterm_result_test2 = $secondterm_result->second_test;
                }
                elseif($setschool->assessment==3){ 
                    $secondterm_result_test1 = $secondterm_result->first_test;
                    $secondterm_result_test2 = $secondterm_result->second_test;
                    $secondterm_result_test3 = $secondterm_result->third_test;
                }
                elseif($setschool->assessment==4){ 
                    $secondterm_result_test1 = $secondterm_result->first_test;
                    $secondterm_result_test2 = $secondterm_result->second_test;
                    $secondterm_result_test3 = $secondterm_result->third_test;
                    $secondterm_result_test4 = $secondterm_result->forth_test;
                }
                else{
                    $secondterm_result_test1 = $secondterm_result->first_test;
                    $secondterm_result_test2 = $secondterm_result->second_test;
                    $secondterm_result_test3 = $secondterm_result->third_test;
                    $secondterm_result_test4 = $secondterm_result->forth_test;
                    $secondterm_result_test5 = $secondterm_result->fifth_test;
                }

                $secondterm_result_exam = $secondterm_result->exam;
                $secondterm_result_total = $secondterm_result->total;
            }

            /*$first_test = $request->first_test;
            $second_test = $request->second_test;
            $exam = $request->exam;
            $total = $first_test + $second_test + $exam;*/

            if (isset($firstterm_result) && !isset($secondterm_result)) { 
                if($setschool->assessment==1){
                    $annual_firsttest = round(($firstterm_result_test1 + 0 + $first_test)/3);  
                }
                elseif($setschool->assessment==2){
                    $annual_firsttest = round(($firstterm_result_test1 + 0 + $first_test)/3);            
                    $annual_secondtest = round(($firstterm_result_test2 + 0 + $second_test)/3);
                }
                elseif($setschool->assessment==3){
                    $annual_firsttest = round(($firstterm_result_test1 + 0 + $first_test)/3);            
                    $annual_secondtest = round(($firstterm_result_test2 + 0 + $second_test)/3);
                    $annual_thirdtest = round(($firstterm_result_test3 + 0 + $third_test)/3);
                }
                elseif($setschool->assessment==4){
                    $annual_firsttest = round(($firstterm_result_test1 + 0 + $first_test)/3);            
                    $annual_secondtest = round(($firstterm_result_test2 + 0 + $second_test)/3);
                    $annual_thirdtest = round(($firstterm_result_test3 + 0 + $third_test)/3);
                    $annual_forthtest = round(($firstterm_result_test4 + 0 + $forth_test)/3);
                }

                else{
                    $annual_firsttest = round(($firstterm_result_test1 + 0 + $first_test)/3);            
                    $annual_secondtest = round(($firstterm_result_test2 + 0 + $second_test)/3);
                    $annual_thirdtest = round(($firstterm_result_test3 + 0 + $third_test)/3);
                    $annual_forthtest = round(($firstterm_result_test4 + 0 + $forth_test)/3);
                    $annual_fifthtest = round(($firstterm_result_test5 + 0 + $fifth_test)/3);
                }
                $annual_exam = round(($firstterm_result_exam + 0 + $exam)/3);
                $annual_total = round(($firstterm_result_total + 0 + $total)/3);
            }
            elseif (!isset($firstterm_result) && isset($secondterm_result)) { 
                if($setschool->assessment==1){
                    $annual_firsttest = round((0 + $secondterm_result_test1 + $first_test)/3);            
                }
                elseif($setschool->assessment==2){
                    $annual_firsttest = round((0 + $secondterm_result_test1 + $first_test)/3); 
                    $annual_secondtest = round((0 + $secondterm_result_test2 + $second_test)/3);
                }
                elseif($setschool->assessment==3){
                    $annual_firsttest = round((0 + $secondterm_result_test1 + $first_test)/3); 
                    $annual_secondtest = round((0 + $secondterm_result_test2 + $second_test)/3);
                    $annual_thirdtest = round((0 + $secondterm_result_test3 + $third_test)/3);
                }
                elseif($setschool->assessment==4){
                    $annual_firsttest = round((0 + $secondterm_result_test1 + $first_test)/3); 
                    $annual_secondtest = round((0 + $secondterm_result_test2 + $second_test)/3);
                    $annual_thirdtest = round((0 + $secondterm_result_test3 + $third_test)/3);
                    $annual_forthtest = round((0 + $secondterm_result_test4 + $forth_test)/3);
                }
                else{
                    $annual_firsttest = round((0 + $secondterm_result_test1 + $first_test)/3); 
                    $annual_secondtest = round((0 + $secondterm_result_test2 + $second_test)/3);
                    $annual_thirdtest = round((0 + $secondterm_result_test3 + $third_test)/3);
                    $annual_forthtest = round((0 + $secondterm_result_test4 + $forth_test)/3);
                    $annual_fifthtest = round((0 + $secondterm_result_test5 + $fifth_test)/3);
                }

                $annual_exam = round((0 + $secondterm_result_exam + $exam)/3);
                $annual_total = round((0 + $secondterm_result_total + $total)/3);
            }
            elseif (!isset($firstterm_result) && !isset($secondterm_result)) { 
                if($setschool->assessment==1){
                    $annual_firsttest = round((0 + 0 + $first_test)/3); 
                }

                elseif($setschool->assessment==2){
                    $annual_firsttest = round((0 + 0 + $first_test)/3);            
                    $annual_secondtest = round((0 + 0 + $second_test)/3);
                }

                elseif($setschool->assessment==3){
                    $annual_firsttest = round((0 + 0 + $first_test)/3);            
                    $annual_secondtest = round((0 + 0 + $second_test)/3);
                    $annual_thirdtest = round((0 + 0 + $third_test)/3);
                }
                elseif($setschool->assessment==4){
                    $annual_firsttest = round((0 + 0 + $first_test)/3);            
                    $annual_secondtest = round((0 + 0 + $second_test)/3);
                    $annual_thirdtest = round((0 + 0 + $third_test)/3);
                    $annual_forthtest = round((0 + 0 + $forth_test)/3);
                }
                else{
                    $annual_firsttest = round((0 + 0 + $first_test)/3);            
                    $annual_secondtest = round((0 + 0 + $second_test)/3);
                    $annual_thirdtest = round((0 + 0 + $third_test)/3);
                    $annual_forthtest = round((0 + 0 + $forth_test)/3);
                    $annual_fifthtest = round((0 + 0 + $fifth_test)/3);
                }


                $annual_exam = round((0 + 0 + $exam)/3);
                $annual_total = round((0 + 0 + $total)/3);
            }
            else{
                if($setschool->assessment==1){
                    $annual_firsttest = round(($firstterm_result_test1 + $secondterm_result_test1 + $first_test)/3); 
                    $annual_secondtest = NULL;
                    $annual_thirdtest = NULL;
                    $annual_fifthtest = NULL;
                    $annual_forthtest = NULL;
                }
                elseif($setschool->assessment==2){
                    $annual_firsttest = round(($firstterm_result_test1 + $secondterm_result_test1 + $first_test)/3);            
                    $annual_secondtest = round(($firstterm_result_test2 + $secondterm_result_test2 + $second_test)/3);
                    $annual_thirdtest = NULL;
                    $annual_fifthtest = NULL;
                    $annual_forthtest = NULL;
                }
                elseif($setschool->assessment==3){
                    $annual_firsttest = round(($firstterm_result_test1 + $secondterm_result_test1 + $first_test)/3);
                    $annual_secondtest = round(($firstterm_result_test2 + $secondterm_result_test2 + $second_test)/3);
                    $annual_thirdtest = round(($firstterm_result_test3 + $secondterm_result_test3 + $third_test)/3);
                    $annual_forthtest = NULL;
                    $annual_fifthtest = NULL;
                }
                elseif($setschool->assessment==4){
                    $annual_firsttest = round(($firstterm_result_test1 + $secondterm_result_test1 + $first_test)/3);
                    $annual_secondtest = round(($firstterm_result_test2 + $secondterm_result_test2 + $second_test)/3);
                    $annual_thirdtest = round(($firstterm_result_test3 + $secondterm_result_test3 + $third_test)/3);
                    $annual_forthtest = round(($firstterm_result_test4 + $secondterm_result_test4 + $forth_test)/3);
                    $annual_fifthtest = NULL;
                }
                else{
                    $annual_firsttest = round(($firstterm_result_test1 + $secondterm_result_test1 + $first_test)/3);
                    $annual_secondtest = round(($firstterm_result_test2 + $secondterm_result_test2 + $second_test)/3);
                    $annual_thirdtest = round(($firstterm_result_test3 + $secondterm_result_test3 + $third_test)/3);
                    $annual_forthtest = round(($firstterm_result_test4 + $secondterm_result_test4 + $forth_test)/3);
                    $annual_fifthtest = round(($firstterm_result_test5 + $secondterm_result_test5 + $fifth_test)/3);
                }

                $annual_exam = round(($firstterm_result_exam + $secondterm_result_exam + $exam)/3);
                $annual_total = round(($firstterm_result_total + $secondterm_result_total + $total)/3);
            }


            //Annual
            if ($annual_total>=$standards->a_min) {
                Result::updateOrCreate([
                    'school_code' => $school_code,
                    'session' => $session,
                    'term' => $annual,
                    'subject' => $subject,
                    'roll' => $studentroll,
                    'class' => $class,
                ],[
                    'school_code' => $school_code,
                    'session' => $session,
                    'term' => $annual,
                    'class' => $class,
                    'subject' => $subject,
                    'roll' => $studentroll,
                    'first_test' => $annual_firsttest,
                    'second_test' => $annual_secondtest,
                    'third_test' => $annual_thirdtest,
                    'forth_test' => $annual_forthtest,
                    'fifth_test' => $annual_fifthtest,
                    'exam' => $annual_exam,
                    'total' => $annual_total,
                    'grade' => "A",
                    'comment' => "Excellent",
                ]);


                if ($total>=$standards->a_min) {

                    $result = Result::findOrFail($id);
                    $result->grade ="A";

                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                elseif ($total>=$standards->b_min) {
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="B";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();                  
                }
                elseif ($total>=$standards->c_min) {
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="C";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();                   
                }
                elseif ($total>=$standards->d_min) {
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="D";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();                  
                }
                elseif ($total>=$standards->e_min) {
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="E";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();                   
                }
                else{
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="F";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();                   
                }
            }
            elseif ($annual_total>=$standards->b_min){
                Result::updateOrCreate([
                    'school_code' => $school_code,
                    'session' => $session,
                    'term' => $annual,
                    'subject' => $subject,
                    'roll' => $studentroll,
                ],[
                    'siteini' => $siteini,
                    'school_code' => $school_code,
                    'session' => $session,
                    'term' => $annual,
                    'class' => $class,
                    'form' => $form,
                    'subject' => $subject,
                    'roll' => $studentroll,
                    'subject' => $subject,
                    'lastname' => $lastname,
                    'firstname' => $firstname,
                    'middlename' => $middlename,
                    'first_test' => $annual_firsttest,
                    'second_test' => $annual_secondtest,
                    'third_test' => $annual_thirdtest,
                    'forth_test' => $annual_forthtest,
                    'fifth_test' => $annual_fifthtest,
                    'exam' => $annual_exam,
                    'total' => $annual_total,
                    'grade' => "B",
                    'comment' => "Very Good",
                ]);

                if ($total>=$standards->a_min) {

                    $result = Result::findOrFail($id);
                    $result->grade ="A";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                elseif ($total>=$standards->b_min) {
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="B";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                elseif ($total>=$standards->c_min) {
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="C";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                elseif ($total>=$standards->d_min) {
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="D";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                elseif ($total>=$standards->e_min) {
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="E";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                else{
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="F";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
            }
            elseif ($annual_total>=$standards->c_min){
                Result::updateOrCreate([
                    'siteini' => $siteini,
                    'school_code' => $school_code,
                    'session' => $session,
                    'term' => $annual,
                    'subject' => $subject,
                    'roll' => $studentroll,
                ],[
                    'siteini' => $siteini,
                    'school_code' => $school_code,
                    'session' => $session,
                    'term' => $annual,
                    'class' => $class,
                    'form' => $form,
                    'subject' => $subject,
                    'roll' => $studentroll,
                    'subject' => $subject,
                    'lastname' => $lastname,
                    'firstname' => $firstname,
                    'middlename' => $middlename,
                    'first_test' => $annual_firsttest,
                    'second_test' => $annual_secondtest,
                    'third_test' => $annual_thirdtest,
                    'forth_test' => $annual_forthtest,
                    'fifth_test' => $annual_fifthtest,
                    'exam' => $annual_exam,
                    'total' => $annual_total,
                    'grade' => "C",
                    'comment' => "Good",
                ]);

                if ($total>=$standards->a_min) {

                    $result = Result::findOrFail($id);
                    $result->grade ="A";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                elseif ($total>=$standards->b_min) {
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="B";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                elseif ($total>=$standards->c_min) {
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="C";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                elseif ($total>=$standards->d_min) {
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="D";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                elseif ($total>=$standards->e_min) {
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="E";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                else{
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="F";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
            }
            elseif ($annual_total>=$standards->d_min){
                Result::updateOrCreate([
                    'siteini' => $siteini,
                    'school_code' => $school_code,
                    'session' => $session,
                    'term' => $annual,
                    'subject' => $subject,
                    'roll' => $studentroll,
                ],[
                    'siteini' => $siteini,
                    'school_code' => $school_code,
                    'session' => $session,
                    'term' => $annual,
                    'class' => $class,
                    'form' => $form,
                    'subject' => $subject,
                    'roll' => $studentroll,
                    'subject' => $subject,
                    'lastname' => $lastname,
                    'firstname' => $firstname,
                    'middlename' => $middlename,
                    'first_test' => $annual_firsttest,
                    'second_test' => $annual_secondtest,
                    'third_test' => $annual_thirdtest,
                    'forth_test' => $annual_forthtest,
                    'fifth_test' => $annual_fifthtest,
                    'exam' => $annual_exam,
                    'total' => $annual_total,
                    'grade' => "D",
                    'comment' => "Fair",
                ]);

                if ($total>=$standards->a_min) {

                    $result = Result::findOrFail($id);
                    $result->grade ="A";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                elseif ($total>=$standards->b_min) {
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="B";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                elseif ($total>=$standards->c_min) {
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="C";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                elseif ($total>=$standards->d_min) {
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="D";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                elseif ($total>=$standards->e_min) {
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="E";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                else{
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="F";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
            }
            elseif ($annual_total>=$standards->e_min){
                Result::updateOrCreate([
                    'siteini' => $siteini,
                    'school_code' => $school_code,
                    'session' => $session,
                    'term' => $annual,
                    'subject' => $subject,
                    'roll' => $studentroll,
                ],[
                    'siteini' => $siteini,
                    'school_code' => $school_code,
                    'session' => $session,
                    'term' => $annual,
                    'class' => $class,
                    'form' => $form,
                    'subject' => $subject,
                    'roll' => $studentroll,
                    'subject' => $subject,
                    'lastname' => $lastname,
                    'firstname' => $firstname,
                    'middlename' => $middlename,
                    'first_test' => $annual_firsttest,
                    'second_test' => $annual_secondtest,
                    'third_test' => $annual_thirdtest,
                    'forth_test' => $annual_forthtest,
                    'fifth_test' => $annual_fifthtest,
                    'exam' => $annual_exam,
                    'total' => $annual_total,
                    'grade' => "E",
                    'comment' => "Poor",
                ]);

                if ($total>=$standards->a_min) {

                    $result = Result::findOrFail($id);
                    $result->grade ="A";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                elseif ($total>=$standards->b_min) {
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="B";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                elseif ($total>=$standards->c_min) {
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="C";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                elseif ($total>=$standards->d_min) {
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="D";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                elseif ($total>=$standards->e_min) {
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="E";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                else{
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="F";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
            } 
            else{
                Result::updateOrCreate([
                    'siteini' => $siteini,
                    'school_code' => $school_code,
                    'session' => $session,
                    'term' => $annual,
                    'subject' => $subject,
                    'roll' => $studentroll,
                ],[
                    'siteini' => $siteini,
                    'school_code' => $school_code,
                    'session' => $session,
                    'term' => $annual,
                    'class' => $class,
                    'form' => $form,
                    'subject' => $subject,
                    'roll' => $studentroll,
                    'subject' => $subject,
                    'lastname' => $lastname,
                    'firstname' => $firstname,
                    'middlename' => $middlename,
                    'first_test' => $annual_firsttest,
                    'second_test' => $annual_secondtest,
                    'third_test' => $annual_thirdtest,
                    'forth_test' => $annual_forthtest,
                    'fifth_test' => $annual_fifthtest,
                    'exam' => $annual_exam,
                    'total' => $annual_total,
                    'grade' => "F",
                    'comment' => "Very Poor",
                ]);


                if ($total>=$standards->a_min) {

                    $result = Result::findOrFail($id);
                    $result->grade ="A";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                elseif ($total>=$standards->b_min) {
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="B";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                elseif ($total>=$standards->c_min) {
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="C";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                elseif ($total>=$standards->d_min) {
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="D";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                elseif ($total>=$standards->e_min) {
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="E";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
                else{
                    
                    $result = Result::findOrFail($id);
                    $result->grade ="F";
                    if($setschool->assessment==1){
                        $result->first_test = $first_test;
                    }
                    elseif($setschool->assessment==2){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                    }
                    elseif($setschool->assessment==3){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                    }
                    elseif($setschool->assessment==4){
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                    }
                    else{
                        $result->first_test = $first_test;
                        $result->second_test = $second_test;
                        $result->third_test = $third_test;
                        $result->forth_test = $forth_test;
                        $result->fifth_test = $fifth_test;
                    }
                    $result->exam = $exam;
                    $result->total = $total;
                    $result->comment = $comment;
                    $result->update();

                    
                }
            }

            //Third Term
            if ($total>=$standards->a_min) {
                $result = Result::findOrFail($id);
                $result->grade ="A";
                if($setschool->assessment==1){
                    $result->first_test = $first_test;
                }
                elseif($setschool->assessment==2){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                }
                elseif($setschool->assessment==3){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                }
                elseif($setschool->assessment==4){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                    $result->forth_test = $forth_test;

                }
                else{
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                    $result->forth_test = $forth_test;
                    $result->fifth_test = $fifth_test;
                }
                $result->exam = $exam;
                $result->total = $total;
                $result->comment = $comment;
                //return $request;
                $result->update();
            }
            elseif ($total>=$standards->b_min) {
                $result = Result::findOrFail($id);
                $result->grade ="B";
                if($setschool->assessment==1){
                    $result->first_test = $first_test;
                }
                elseif($setschool->assessment==2){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                }
                elseif($setschool->assessment==3){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                }
                elseif($setschool->assessment==4){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                    $result->forth_test = $forth_test;
                }
                else{
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                    $result->forth_test = $forth_test;
                    $result->fifth_test = $fifth_test;
                }
                $result->exam = $exam;
                $result->total = $total;
                $result->comment = $comment;
                $result->update();
            }
            elseif ($total>=$standards->c_min) {
                $result = Result::findOrFail($id);
                $result->grade ="C";
                if($setschool->assessment==1){
                    $result->first_test = $first_test;
                }
                elseif($setschool->assessment==2){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                }
                elseif($setschool->assessment==3){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                }
                elseif($setschool->assessment==4){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                    $result->forth_test = $forth_test;
                }
                else{
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                    $result->forth_test = $forth_test;
                    $result->fifth_test = $fifth_test;
                }
                $result->exam = $exam;
                $result->total = $total;
                $result->comment = $comment;
                $result->update();
            }
            elseif ($total>=$standards->d_min) {
                $result = Result::findOrFail($id);
                $result->grade ="D";
                if($setschool->assessment==1){
                    $result->first_test = $first_test;
                }
                elseif($setschool->assessment==2){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                }
                elseif($setschool->assessment==3){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                }
                elseif($setschool->assessment==4){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                    $result->forth_test = $forth_test;
                }
                else
                {
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                    $result->forth_test = $forth_test;
                    $result->fifth_test = $fifth_test;
                }
                $result->exam = $exam;
                $result->total = $total;
                $result->comment = $comment;
                $result->update();
            }
            elseif ($total>=$standards->e_min) {
                $result = Result::findOrFail($id);
                $result->grade ="E";
                if($setschool->assessment==1){
                    $result->first_test = $first_test;
                }
                elseif($setschool->assessment==2){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                }
                elseif($setschool->assessment==3){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                }
                elseif($setschool->assessment==4){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                    $result->forth_test = $forth_test;
                }
                else
                {
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                    $result->forth_test = $forth_test;
                    $result->fifth_test = $fifth_test;
                }
                $result->exam = $exam;
                $result->total = $total;
                $result->comment = $comment;
                $result->update();
            }
            else
            {
                $result = Result::findOrFail($id);
                $result->grade ="F";
                if($setschool->assessment==1){
                    $result->first_test = $first_test;
                }
                elseif($setschool->assessment==2){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                }
                elseif($setschool->assessment==3){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                }
                elseif($setschool->assessment==4){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                    $result->forth_test = $forth_test;
                }
                else{
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                    $result->forth_test = $forth_test;
                    $result->fifth_test = $fifth_test;
                }
                $result->exam = $exam;
                $result->total = $total;
                $result->comment = $comment;
                $result->update();
            }
        }
        else
        {
            if ($total>=$standards->a_min) {
                $result = Result::findOrFail($id);
                $result->grade ="A";
                if($setschool->assessment==1){
                    $result->first_test = $first_test;
                }
                elseif($setschool->assessment==2){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                }
                elseif($setschool->assessment==3){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                }
                elseif($setschool->assessment==4){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                    $result->forth_test = $forth_test;

                }
                else{
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                    $result->forth_test = $forth_test;
                    $result->fifth_test = $fifth_test;
                }
                $result->exam = $exam;
                $result->total = $total;
                $result->comment = $comment;
                //return $request;
                $result->update();
            }
            elseif ($total>=$standards->b_min) {
                $result = Result::findOrFail($id);
                $result->grade ="B";
                if($setschool->assessment==1){
                    $result->first_test = $first_test;
                }
                elseif($setschool->assessment==2){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                }
                elseif($setschool->assessment==3){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                }
                elseif($setschool->assessment==4){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                    $result->forth_test = $forth_test;
                }
                else{
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                    $result->forth_test = $forth_test;
                    $result->fifth_test = $fifth_test;
                }
                $result->exam = $exam;
                $result->total = $total;
                $result->comment = $comment;
                $result->update();
            }
            elseif ($total>=$standards->c_min) {
                $result = Result::findOrFail($id);
                $result->grade ="C";
                if($setschool->assessment==1){
                    $result->first_test = $first_test;
                }
                elseif($setschool->assessment==2){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                }
                elseif($setschool->assessment==3){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                }
                elseif($setschool->assessment==4){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                    $result->forth_test = $forth_test;
                }
                else{
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                    $result->forth_test = $forth_test;
                    $result->fifth_test = $fifth_test;
                }
                $result->exam = $exam;
                $result->total = $total;
                $result->comment = $comment;
                $result->update();
            }
            elseif ($total>=$standards->d_min) {
                $result = Result::findOrFail($id);
                $result->grade ="D";
                if($setschool->assessment==1){
                    $result->first_test = $first_test;
                }
                elseif($setschool->assessment==2){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                }
                elseif($setschool->assessment==3){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                }
                elseif($setschool->assessment==4){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                    $result->forth_test = $forth_test;
                }
                else
                {
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                    $result->forth_test = $forth_test;
                    $result->fifth_test = $fifth_test;
                }
                $result->exam = $exam;
                $result->total = $total;
                $result->comment = $comment;
                $result->update();
            }
            elseif ($total>=$standards->e_min) {
                $result = Result::findOrFail($id);
                $result->grade ="E";
                if($setschool->assessment==1){
                    $result->first_test = $first_test;
                }
                elseif($setschool->assessment==2){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                }
                elseif($setschool->assessment==3){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                }
                elseif($setschool->assessment==4){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                    $result->forth_test = $forth_test;
                }
                else
                {
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                    $result->forth_test = $forth_test;
                    $result->fifth_test = $fifth_test;
                }
                $result->exam = $exam;
                $result->total = $total;
                $result->comment = $comment;
                $result->update();
            }
            else
            {
                $result = Result::findOrFail($id);
                $result->grade ="F";
                if($setschool->assessment==1){
                    $result->first_test = $first_test;
                }
                elseif($setschool->assessment==2){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                }
                elseif($setschool->assessment==3){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                }
                elseif($setschool->assessment==4){
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                    $result->forth_test = $forth_test;
                }
                else{
                    $result->first_test = $first_test;
                    $result->second_test = $second_test;
                    $result->third_test = $third_test;
                    $result->forth_test = $forth_test;
                    $result->fifth_test = $fifth_test;
                }
                $result->exam = $exam;
                $result->total = $total;
                $result->comment = $comment;
                $result->update();
            }
        }

        return redirect()->route('resultsheet', array('session' => $session, 'class' => $class, 'term' => $term, 'subject' => $subject, 'school_code' => $school_code));
    }

    public function viewresult()
    { 
        $status = request('status');  
        $error = request('error');  
        $school_code = Auth::user()->school_code;

        $standard = Standard::where('deleted_at', NULL)->where('school_code', $school_code)->first();
        $sessions = Session::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        $students = Student::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        $subjects = Subject::where('deleted_at', NULL)->where('school_code', $school_code)->get();
  
        return view('result.choosestudent', compact('standard', 'sessions', 'students', 'subjects', 'status', 'error'));       
    }

    public function findresult(Request $request)
    {
        $school_code = Auth::user()->school_code;
        $roll = $request->roll;
        $session = $request->session;
        $term = $request->term; 
        if ($roll==NULL) {
            return back();
        }
        else
        {
        return redirect()->route('getresult', array('session' => $session, 'term' => $term, 'roll' =>$roll));
        }
    }    

    public function getresult()
    {
        $session = request('session');
        $thesession = Session::findOrFail($session) ;
        $sessionsname = $thesession->name;
        $term =  request('term'); 
        $roll = request('roll'); 

        $school_code = Auth::user()->school_code;
        $standards = Standard::where('school_code', $school_code)->first();
        
        
        
        $settings = School::where('school_code', $school_code)->first();
        $mainterm = $settings->current_term;
        $mainsession = $settings->current_session;

        $current_session = Session::where('school_code', $school_code)->where('name', $mainsession)->first();

        if ($mainterm=="First Term") {
            $start = $current_session->start_date;
            $end = $current_session->end_date;
            $diff = $end->diffInDays($start);
            $next_term_start = $current_session->second_term_start;
        }
        elseif ($mainterm=="Second Term") {
            $start = $current_session->second_term_start;
            $end = $current_session->second_term_end;
            $diff = $end->diffInDays($start);
            $next_term_start = $current_session->third_term_start;
        }
        else
        {
            $start = $current_session->third_term_start;
            $end = $current_session->third_term_end;
            $diff = $end->diffInDays($start);
            $next_term_start = $current_session->second_term_start;
        }
        
        $assessment = $settings->assessment;

        $profile = Student::where('deleted_at', NULL)->where('roll', $roll)->first();
        
        if(!isset($profile->class)){
            $error = "This student has not been assigned to any class";
            return redirect()->route('viewresult', array('error' => $error));
        }
        $class = $profile->getOriginal('class');
        
        $mainform = Classes::findOrFail($class);
      
        $subject_offers = $mainform->subject_offered;

        $number_of_students = Student::where('school_code', $school_code)->where('deleted_at', NULL)->where('class', $class)->count();
       
    
        if (isset($subject_offers)) {
            $exploded = explode(",",$subject_offers);
            $length = count($exploded);
        }
        
        $results = Result::where('school_code', $school_code)->where('deleted_at', NULL)->where('roll', $roll)->where('session', $session)->where('term', $term)->orderBy('subject', 'desc')->get();
        
        

        foreach ($results as $result) {
            $subject = $result->subject;
            $sort = Result::where('deleted_at', NULL)->where('school_code', $school_code)->Where('subject', $subject)->Where('class', $class)->where('session', $session)->where('term', $term)->orderBy('total', 'DESC')->get()->toArray();

            $name = Result::where('deleted_at', NULL)->where('school_code', $school_code)->Where('subject', $subject)->Where('class', $class)->where('session', $session)->where('term', $term)->Where('roll', $roll)->first();

            $score = $name->total;
            $a = array_column($sort, 'total');
            
            $key = array_search($score, $a);
            $position = $key + 1;
        }

        $results1 = Result::where('school_code', $school_code)->where('deleted_at', NULL)->where('session', $session)->where('term', $term)->Where('class', $class)->get();

        foreach ($results1 as $value) {
            $sub = $value->subject;
            $gethighest = Result::where('deleted_at', NULL)->where('school_code', $school_code)->Where('subject', $sub)->Where('class', $class)->where('session', $session)->where('term', $term)->orderBy('total', 'DESC')->first();

            $highest = $gethighest->total;

            $getlowest = Result::where('deleted_at', NULL)->where('school_code', $school_code)->Where('subject', $sub)->Where('class', $class)->where('session', $session)->where('term', $term)->orderBy('total', 'ASC')->first();
            $lowest = $getlowest->total;
        }


        $assessgrade= Assessment::where('school_code', $school_code)->where('deleted_at', NULL)->where('roll', $roll)->where('session', $session)->where('term', $term)->where('class', $class)->first();

        $maintotal= Result::where('school_code', $school_code)->where('deleted_at', NULL)->where('roll', $roll)->where('session', $session)->where('term', $term)->orderBy('subject', 'desc')->sum('total');
        
        
        
        
        
        
        
        $allstudents = Result::where('school_code', $school_code)->where('deleted_at', NULL)->where('session', $session)->where('class', $class)->where('term', $term)->groupBy('roll')->get();


        $geteachscore = array();
        foreach ($allstudents as $key) {
            $eachscore = Result::where('school_code', $school_code)->where('deleted_at', NULL)->where('session', $session)->where('class', $class)->where('roll', $key->roll)->where('term', $term)->sum('total');
            $sum_score = array_push($geteachscore, $eachscore);
        }
    
        $collection = collect($geteachscore);
        $firstsorted = $collection->sort();
        $sorted = $firstsorted->reverse()->values()->all();
        $clength = count($geteachscore);
        $mainpos= array_search($maintotal, $sorted);
        $mainposition = $mainpos + 1;
    
        $countresult = Result::where('school_code', $school_code)->where('deleted_at', NULL)->where('roll', $roll)->where('session', $session)->where('term', $term)->orderBy('subject', 'desc')->count();

        $avgtotal = Result::where('school_code', $school_code)->where('deleted_at', NULL)->where('roll', $roll)->where('session', $session)->where('term', $term)->avg('total');
        
        $subjects = Subject::where('school_code', $school_code)->get();

        $classaverage = Result::where('school_code', $school_code)->where('deleted_at', NULL)->where('class', $class)->where('session', $session)->where('term', $term)->avg('total');

        return view('result.result', compact('session', 'term', 'profile', 'results', 'assessment', 'settings', 'maintotal', 'standards', 'length', 'exploded', 'assessgrade', 'diff', 'countresult', 'number_of_students', 'avgtotal', 'position', 'highest', 'lowest', 'sub', 'results1', 'classaverage', 'next_term_start', 'sessionsname', 'mainposition' , 'sorted', 'clength', 'subjects'));    
    }

    public function hostels()
    {
        $status = request('status'); 
        $error = request('error'); 
        $school_code = Auth::user()->school_code;
        $hostels=Hostel::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        return view('hostel.index', compact('hostels', 'status', 'error'));
    }

    public function storehostel(Request $request)
    {
        $school_code = Auth::user()->school_code;
        $category = $request->category;
        $gender = $request->gender;
        $name = $request->name;

        $hostel = Hostel::where('deleted_at', NULL)->where('school_code', $school_code)->where('name', $name)->where('gender', $gender)->where('category', $category)->first();
      
        if(!isset($hostel))
        {
            $lasthostel = Hostel::where('deleted_at', NULL)->where('school_code', $school_code)->orderBy('id', 'desc')->first();
            if (isset($lasthostel)) 
            {
                $lastid = $lasthostel->id + 1;
            }
            else
            {
                $lastid = "1";
            }
            $hostel_code = '00'.$lastid;

            if ($gender=="Male" && $category=="Junior") {
                $step1 = new Hostel();
                $step1->name = $request->name;
                $step1->gender = "Male";
                $step1->code = $hostel_code;
                $step1->category = "Junior";
                $step1->school_code = $school_code;
                $step1->save();
                for ($index = 0; $index <  $request->number_of_bed; $index++) 
                {
                    $lastbed = Bed::where('deleted_at', NULL)->where('school_code', $school_code)->orderBy('id', 'desc')->where('hostel_code', $hostel_code)->first();
                    if (isset($lastbed)) 
                    {
                        $lastbedid = $lastbed->bed_number + 1;
                    }
                    else
                    {
                        $lastbedid = "1";
                    }
                    $bed_number = '00'.$lastbedid;

                    $tick = new Bed();
                    $tick->hostel_code = $hostel_code;
                    $tick->school_code = $school_code;
                    $tick->bed_number  = $bed_number;
                    $tick->status = 1;
                    $tick->save();
                }
            }
            elseif ($gender=="Male" && $category=="Senior") {
                $step1 = new Hostel();
                $step1->name = $request->name;
                $step1->gender = "Male";
                $step1->code = $hostel_code;
                $step1->category = "Senior";
                $step1->school_code = $school_code;
                $step1->save();
                for ($index = 0; $index <  $request->number_of_bed; $index++) 
                {
                    $lastbed = Bed::where('deleted_at', NULL)->orderBy('id', 'desc')->where('hostel_code', $hostel_code)->first();
                    if (isset($lastbed)) 
                    {
                        $lastbedid = $lastbed->id + 1;
                    }
                    else
                    {
                        $lastbedid = "1";
                    }
                    $bed_number = '00'.$lastbedid;
                    $tick = new Bed();
                    $tick->hostel_code = $hostel_code;
                    $tick->school_code = $school_code;
                    $tick->bed_number  = $bed_number;
                    $tick->status = 1;
                    $tick->save();
                }
            }
            elseif ($gender=="Female" && $category=="Junior") {
                $step1 = new Hostel();
                $step1->name = $request->name;
                $step1->gender = "Female";
                $step1->code = $hostel_code;
                $step1->category = "Junior";
                $step1->school_code = $school_code;
                $step1->save();
                for ($index = 0; $index <  $request->number_of_bed; $index++) 
                {
                    $lastbed = Bed::where('deleted_at', NULL)->orderBy('id', 'desc')->where('hostel_code', $hostel_code)->first();
                    if (isset($lastbed)) 
                    {
                        $lastbedid = $lastbed->id + 1;
                    }
                    else
                    {
                        $lastbedid = "1";
                    }
                    $bed_number = '00'.$lastbedid;

                    $tick = new Bed();
                    $tick->hostel_code = $hostel_code;
                    $tick->school_code = $school_code;
                    $tick->bed_number  = $bed_number;
                    $tick->status = 1;
                    $tick->save();
                }
            }
            else{
                $step1 = new Hostel();
                $step1->name = $request->name;
                $step1->gender = "Female";
                $step1->code = $hostel_code;
                $step1->category = "Senior";
                $step1->school_code = $school_code;
                $step1->save();
                for ($index = 0; $index <  $request->number_of_bed; $index++) 
                {
                    $lastbed = Bed::where('deleted_at', NULL)->orderBy('id', 'desc')->where('hostel_code', $hostel_code)->first();
                    if (isset($lastbed)) 
                    {
                        $lastbedid = $lastbed->id + 1;
                    }
                    else
                    {
                        $lastbedid = "1";
                    }
                    $bed_number = '00'.$lastbedid;

                    $tick = new Bed();
                    $tick->hostel_code = $hostel_code;
                    $tick->school_code = $school_code;
                    $tick->bed_number  = $bed_number;
                    $tick->status = 1;
                    $tick->save();
                }
            }

            $status = 'Hostels and bed added for both male and female junior and senior category';
            return redirect()->route('hostels', array('status' => $status));
        }
        else{
           $error = 'Hostels already exist'; 
           return redirect()->route('hostels', array('error' => $error));
        } 
    }

    public function destroyhostel($id)
    {
        $hostel = Hostel::findOrFail($id);
        $hostel_code = $hostel->code;
        $bed = Bed::where('deleted_at', NULL)->where('hostel_code', $hostel_code)->get();
        foreach ($bed as $key) {
            $bed_id = $key->id;
            Bed::destroy($bed_id);
        }
        Hostel::destroy($id);
        return back();
    }


    public function bed()
    {
        $status = request('status'); 
        $error = request('error'); 
        $hostel_code = request('hostel_code'); 
        $category = request('category'); 
        $school_code = Auth::user()->school_code;

        if (isset($hostel_code)) {
           $beds = Bed::where('deleted_at', NULL)->where('school_code', $school_code)->where('hostel_code', $hostel_code)->get();
        }
        else
        {
            $beds = Bed::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        }
        $students=Student::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        $hostels=Hostel::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        return view('hostel.beds', compact('beds', 'status', 'error', 'hostels', 'students'));
    }

    public function removebed()
    {
        $hostel_code = request('hostel_code'); 
        $school_code = Auth::user()->school_code;
        $bed = Bed::where('deleted_at', NULL)->where('school_code', $school_code)->where('hostel_code', $hostel_code)->where('occupant', NULL)->first();
        if (isset($bed)) {
            $id = $bed->id;
            Bed::destroy($id);
        }
        return back();
    }

    public function addbed()
    {
        $hostel_code = request('hostel_code'); 
        $school_code = Auth::user()->school_code;

        $lastbed = Bed::where('deleted_at', NULL)->orderBy('id', 'desc')->where('hostel_code', $hostel_code)->first();
        if (isset($lastbed)) 
        {
            $lastbedid = $lastbed->id + 1;
        }
        else
        {
            $lastbedid = "1";
        }
        $bed_number = '00'.$lastbedid;

        $tick = new Bed();
        $tick->hostel_code = $hostel_code;
        $tick->school_code = $school_code;
        $tick->bed_number  = $bed_number;
        $tick->status = 1;
        $tick->save();
        return back();
    }

    public function getbed($id)
    {
        $school_code = Auth::user()->school_code;
        $hostel = Hostel::findOrFail($id);
        $hostel_code = $hostel->code;
        $bed = Bed::where('school_code', $school_code)->where('deleted_at', NULL)->where('hostel_code', $hostel_code)->where('occupant', NULL)->get();
        return response()->json($bed);
    }
    
    public function books()
    {
        $status = request('status'); 
        $error = request('error'); 
        $school_code = Auth::user()->school_code;
        $lastbook = Book::where('deleted_at', NULL)->where('school_code', $school_code)->orderBy('id', 'desc')->first();
        if (isset($lastbook)) 
        {
            $lastid = $lastbook->id + 1;
        }
        else
        {
            $lastid = "1";
        }
        $book_code = '00'.$lastid;
        $books = Book::where('school_code', $school_code)->where('deleted_at', NULL)->get();
        return view('library.book', compact('status', 'error', 'books', 'book_code'));
    }


    public function storebooks(Request $request)
    {
        $name = $request->name;
        $getname = Book::where('deleted_at', NULL)->where('school_code', $request->school_code)->where('name', $name)->first();
        if (isset($getname)) {
            $error = "Book Already Exist";
            return redirect()->route('books', array('error' => $error));
        }
        else
        {
            Book::create($request->all());
            $status = "Book Added Successfully";
            return redirect()->route('books', array('status' => $status));
        }
    }


    public function removebook()
    {
        $book_code = request('book_code'); 
        $school_code = Auth::user()->school_code;
        $book= Book::where('deleted_at', NULL)->where('school_code', $school_code)->where('book_code', $book_code)->first();
        if (isset($book)) {
            $book->copies_have = $book->copies_have - 1;
            $book->update();
        }
        return back();
    }

    public function addbook()
    {
        $book_code = request('book_code'); 
        $school_code = Auth::user()->school_code;
        $book = Book::where('deleted_at', NULL)->where('school_code', $school_code)->where('book_code', $book_code)->first();
        if (isset($book)) {
            $book->copies_have = $book->copies_have + 1;
            $book->update();
        }
        return back();
    }

    public function lend()
    {
        $status = request('status');
        $error = request('error'); 
        $school_code = Auth::user()->school_code;
        $books = Book::where('school_code', $school_code)->where('deleted_at', NULL)->get();
        $lends = Lend::where('deleted_at', NULL)->where('status', 0)->where('school_code', $school_code)->get();
        return view('library.lend', compact('status', 'error', 'lends', 'books'));
    }

    public function lendhistory()
    {
        $status = request('status');
        $error = request('error'); 
        $school_code = Auth::user()->school_code;
        $lends = Lend::where('deleted_at', NULL)->where('status', 1)->where('school_code', $school_code)->get();
        $books = Book::where('school_code', $school_code)->where('deleted_at', NULL)->get();
        return view('library.lendhistory', compact('status', 'error', 'lends', 'books'));
    }

    public function storelend(Request $request)
    {
        $lender = $request->lender;
        $student = Student::where('deleted_at', NULL)->where('roll', $lender)->first();
        $staff = Teacher::where('deleted_at', NULL)->where('roll', $lender)->first();

        if (isset($staff) || isset($student)) {
            $step4 = new Lend();
            $step4->school_code = $request->school_code;
            $step4->lender = $request->lender;
            $step4->book_code = $request->book_code;
            $step4->status = $request->status;
            $step4->return_date = Carbon::now()->addDays($request->duration);
            $step4->save();

            $status = "Done";
            return redirect()->route('lend', array('status' => $status));
        }
        else
        {
            $error = "No student or staf with that ID found";
            return redirect()->route('books', array('error' => $error));
        }
    }

    public function marksuccess()
    {
        $id = request('id'); 
        $lend = Lend::findOrFail($id);
        $lend->status = 1;
        $lend->update();
        return back();
    }

    public function passwordget()
    {   
        $error = request('passworderror'); 
        return view('admin.password', compact('error'));
    }

    public function password(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
 
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
 
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
 
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
 
        return redirect()->back()->with("success","Password changed successfully !"); 
    }

    public function openticket()
    {
        $status = request('status');
        $error = request('error'); 
        $school_code = Auth::user()->school_code;
        $books = Book::where('school_code', $school_code)->where('deleted_at', NULL)->get();
        
        return view('ticket.openticket', compact('status', 'error'));
    }

    public function compose()
    {
        $status = request('status');
        $error = request('error'); 
        return view('ticket.compose', compact('status', 'error'));
    }

    //Staff

    public function formclass()
    {
        $name = Auth::user()->username;
        $form = Classes::where('deleted_at', NULL)->where('form_teacher', $name)->first();
        if (isset($form)) {
            $formname = $form->form;
            $class = $form->name;
            $class_id = $form->id;
            $subject_offered = $form->subject_offered;
            $exploded = explode(",",$subject_offered);
            $length = count($exploded);

            $school_code = Auth::user()->school_code;
            $school = School::where('deleted_at', NULL)->where('school_code', $school_code)->first();
            $current_session = $school->current_session;
            $session = Session::where('deleted_at', NULL)->where('school_code', $school_code)->where('name', $current_session)->first();
            $subjects = Subject::where('deleted_at', NULL)->where('school_code', $school_code)->get();
            $students = Student::where('deleted_at', NULL)->where('school_code', $school_code)->where('class', $class_id)->orderBy('created_at', 'desc')->get();


            //$students = Station::where('deleted_at', NULL)->where('school_code', $school_code)->where('class', $class)->where('session', $session)->where('form', $formname)->orderBy('lastname', 'asc')->get();

            return view('staff.formstudents', compact('students', 'subjects', 'exploded', 'length', 'formname', 'class', 'form', 'session', 'class_id'));
        }
        else
        {
            $error = "You have not been assigned to any form class' Contact the school admin to do so.";
            return redirect()->route('home', array('error' => $error));
        }
    }

    public function subjectcheck(Request $request)
    {
        $school_code = Auth::user()->school_code;
        $standards = Standard::where('school_code', $school_code)->first();

        $session = request('session');  
        $term = request('term');
        $subject = request('subject');
        $class = request('class');
        $form = request('form');
        $results = Result::where('school_code', $school_code)->where('deleted_at', NULL)->where('class', $class)->where('form', $form)->where('session', $session)->where('term', $term)->where('subject', $subject)->paginate(25);
        
        return view('staff.result', compact('results', 'session', 'term', 'subject', 'class', 'form', 'teacher'));
    }


    public function subjectclass()
    {
        $status = request('status');
        $error = request('error'); 
        $history = request('history'); 
        $school_code = Auth::user()->school_code;
        $school = School::where('school_code', $school_code)->first();
        $session = $school->current_session;
        $mainsession = Session::where('school_code', $school_code)->where('name', $session)->where('deleted_at', NULL)->first();
        $term = $school->current_term;
        $roll = Auth::user()->username;

        if (isset($history)) {
           $subject_teachers = Subjectteacher::where('school_code', $school_code)->where('deleted_at', NULL)->where('roll', $roll)->get();
        }
        else{
        $subject_teachers = Subjectteacher::where('school_code', $school_code)->where('deleted_at', NULL)->where('roll', $roll)->where('session', $session)->where('term', $term)->get();
        }
        $classes=Classes::where('school_code', $school_code)->where('deleted_at', NULL)->get();
        $subjects=Subject::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        if (isset($subject_teachers)) {
           return view('staff.class', compact('subject_teachers', 'classes', 'subjects', 'mainsession', 'status', 'error'));
        }
        else{
            $error = "No Class Found";
            return redirect()->route('home', array('error' => $error));
        }
    }

    public function subjectclasshistory()
    {
        $history = "History";
        return redirect()->route('subjectclass', array('history' => $history));
    }

    public function assessment()
    {
        $school_code = Auth::user()->school_code;
         $standard = Standard::where('school_code', $school_code)->first();
        $forms = DB::table('forms')
                ->where('deleted_at', NULL)
                ->where('school_code', $school_code)
                ->orderBy('class_id', 'asc')
                ->get();
        $sessionsss = Session::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        return view('result.assessment', compact('classes', 'forms', 'subjects', 'sessionsss', 'standard' ));
    }

    public function assessment2()
    {

        $name = Auth::user()->lastname. ' '.Auth::user()->firstname. ' '.Auth::user()->middlename;
        $form = Form::where('deleted_at', NULL)->where('form_teacher', $name)->first();
        if (isset($form)) {
            $class = $form->class_id;
            $form_name = $form->form_name;

            $school_code = Auth::user()->school_code;
            $standards = Standard::where('school_code', $school_code)->first();

            $term = $standards->term;
            $session = $standards->session;
           
           $students = DB::table('stations')->where('school_code', $school_code)->where('deleted_at', NULL)->Where('class', $class)->Where('form', $form_name)->Where('session', $session)->get();

           foreach($students as $student) {

            Assessment::updateOrCreate([
                'school_code' => $school_code,
                'class' => $class,
                'form' => $form_name,
                'session' => $session,
                'term' => $term,
                'roll' => $student->roll,
            ],[
             
                'school_code' => $school_code,
                'class' => $class,
                'form' => $form_name,
                'session' => $session,
                'term' => $term,
                'roll' => $student->roll,
                'present' => '1',
            ]);
        }
       
        
        return redirect()->route('staff.assessmentresult', array('class' => $class, 'form' => $form_name, 'session' => $session, 'term' => $term));

        }
        else
        {
            $error = "You have not been assigned to any class to manage. Contact the admin to deploy you.";
            return redirect()->route('staff.index', array('error' => $error));
        }

    }

    public function assessment3()
    {
        $school_code = Auth::user()->school_code;
        $standard = Standard::where('school_code', $school_code)->first();
        //$session = $standard->session;
        //$term = $standard->term;

        $session = request('session'); 
        $term =  request('term');
        $class = request('class');  
        $form = request('form'); 
    

        $results = Assessment::where('school_code', $school_code)->where('deleted_at', NULL)->Where('class', $class)->Where('form', $form)->Where('session', $session)->Where('term', $term)->get();

        return view('staff.assessment', compact('results', 'session', 'term',  'class', 'form'));
    }

    public function assessedit()
    {
        $school_code = Auth::user()->school_code;
        $id = request('id');
        $assessment = Assessment::findOrFail($id);
        return view('staff.editassessment', compact('assessment')); 

    }

    public function editassessment(Request $request, $id)
    {
        //return $request;
        $assessment = Assessment::findOrFail($id);
        $assessment->update($request->all());

        $class = $assessment->class;
        $form = $assessment->form;
        $session = $assessment->session;
        $term = $assessment->term;
        $school_code = $assessment->school_code;

         $results = Assessment::where('school_code', $school_code)->where('deleted_at', NULL)->Where('class', $class)->Where('form', $form)->Where('session', $session)->Where('term', $term)->get();

        return view('staff.assessment', compact('results', 'session', 'term',  'class', 'form'));       
    }

    public function admissionform()
    {
        $today = Carbon::today();
        $year = $today->year;
        $school_code = Auth::user()->school_code;
        $school = School::where('school_code', $school_code)->first();
        $admissions = Admission::where('school_code', $school_code)->where('deleted_at', NULL)->orderBy('id', 'desc')->get();
        $lastadmissions = Admission::where('school_code', $school_code)->where('deleted_at', NULL)->orderBy('id', 'desc')->first();
      
        if (isset($lastadmissions)) 
        {
            $lastid = $lastadmissions->id + 1;
        }
        else
        {
            $lastid = "1";
        }
        $form_id = $school->ini.'/'.$year.'/0'.$lastid;
        return view('admission.form', compact('admissions', 'school_code', 'form_id')); 
    }

    public function applicant()
    {
        $status = request('status'); 
        $error = request('error'); 
        $form_id = request('form_id'); 
        $applicants = Applicant::where('deleted_at', NULL)->where('form_id', $form_id)->get();
        return view('admission.applicant', compact('applicants')); 
    }

    public function storeadmissionform(Request $request)
    {
        $school_code = $request->school_code;
        $admissions = Admission::where('school_code', $school_code)->where('deleted_at', NULL)->get();
        foreach ($admissions as $key) {
            $key->status = "Stopped";
            $key->update();
        }
        Admission::create($request->all());
        $status = "Admission Form Created Successfully";
        return redirect()->route('admissionform', array('status' => $status));
    }

    public function condition()
    {
        $condition = request('condition'); 
        $id = request('id');
        if (isset($condition)) {
            $application = Applicant::findOrFail($id);
            $application->status = $condition;
            $application->update();
            return back();  
        }
        else
        {
            return back();
        }           
    }

    public function applicantprofile()
    {
        $id = request('id');  
        $profile = Applicant::where('deleted_at', NULL)->where('id', $id)->first();   
        return view('admission.profile', compact('profile'));    
    }
    
    public function editbook(Request $request)
    {
        //return $request;
        $book = Book::findOrFail($request->id);
        $book->update($request->all());
        $status = "Form Updated Successfully";
        return redirect()->route('books', array('status' => $status));
    }
    
    public function updatehostel(Request $request)
    {
        //return $request;
        $hostel = Hostel::findOrFail($request->id);
        $hostel->update($request->all());
        $status = "Hostel Updated Successfully";
        return redirect()->route('hostels', array('status' => $status));
    }
    
    public function addassessment()
    { 
        $status = request('status');  
        $error = request('error');  
        $school_code = Auth::user()->school_code;

        $standard = Standard::where('deleted_at', NULL)->where('school_code', $school_code)->first();
        $sessions = Session::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        $classes = Classes::where('deleted_at', NULL)->where('school_code', $school_code)->get();
        $subjects = Subject::where('deleted_at', NULL)->where('school_code', $school_code)->get();
  
        return view('result.chooseassessment', compact('standard', 'sessions', 'classes', 'subjects', 'status', 'error'));       
    }
    public function getassessment(Request $request)
    {
        $term = $request->term;  
        $session = $request->session; 
        $class= $request->class; 
        $get_session = Session::findOrFail($session);
        $sessionname = $get_session->name;
        $school_code = Auth::user()->school_code;
        $students = Student::where('school_code', $school_code)->where('deleted_at', NULL)->Where('class', $class)->get();
        $classes = Classes::findOrFail($class);

        foreach($students as $student) {
            Assessment::updateOrCreate([
                'school_code' => $school_code,
                'class' => $class,
                'session' => $session,
                'term' => $term,
                'roll' => $student->roll,
            ],[
                'school_code' => $school_code,
                'class' => $class,
                'session' => $session,
                'term' => $term,
                
                'roll' => $student->roll,
            ]);
        }
        return redirect()->route('assessmentsheet', array('session' => $session, 'class' => $class, 'term' => $term, 'school_code' => $school_code));
    }

    public function assessmentsheet()
    {
        $school_code = request('school_code');
        $standard = Standard::where('school_code', $school_code)->first();
        $session = request('session'); 
        $term =  request('term'); 
        $class = request('class');  
    
        $getsession = Session::findOrFail($session);
        $sessionsname = $getsession->name;

        $getclass = Classes::findOrFail($class);
        $classname = $getclass->name.$getclass->form;

       
        $results = Assessment::where('deleted_at', NULL)->where('school_code', $school_code)->Where('class', $class)->where('session', $session)->where('term', $term)->get();

        return view('result.assessmentsheet', compact('results', 'session', 'sessionsname', 'term', 'class', 'standard', 'classname'));
    }
    public function storeassessmentsheet(Request $request)
    {
        $id = $request->id;
        $assessment = Assessment::findOrFail($id);
        $assessment->update($request->all());
        $class = $assessment->class;
        $session = $assessment->session;
        $term = $assessment->term;
        $school_code = $assessment->school_code;
        return redirect()->route('assessmentsheet', array('session' => $session, 'class' => $class, 'term' => $term, 'school_code' => $school_code));      
    }


}
