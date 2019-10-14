<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\School;
use App\Student;
use App\Setting;
use App\Session;
use App\Assignment;
use App\Assignmentsubmit;
use App\Standard;
use App\Subject;
use App\Resource;
use App\Subjectteacher;
use App\User;
use App\Mail;
use App\Teacher;
use App\Classes;
use App\Card;
use App\Result;
use App\Salary;
use App\Invoice;
use App\Admission;
use Auth;
use DB;
use App\Applicant;
use App\Note;
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


class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        
    }
    public function index()
    {
        $status = request('status'); 
        $error = request('error'); 

        $today = Carbon::today();

        $school_code = Auth::user()->school_code;
        $checkschool = School::where('school_code', $school_code)->first();

        
        $assignment = Assignment::get(); 
        foreach ($assignment as $key) {
            if ($key->submission_date<=$today) {
                $key->status = "Closed";
                $key->update();
            }
        }
        return view('learning.getformclass');
    }
    public function viewnote()
    {
        $school_code = Auth::user()->school_code;
        $id = request('id');
        $note = Note::findOrfail($id);
        $roll = $note->teacher;
        $teacher = Teacher::where('school_code', $school_code)->where('roll', $roll)->where('deleted_at', NULL)->first();
        $name = $teacher->lastname.' '.$teacher->firstname.' '.$teacher->middlename;
        $classes=Classes::where('school_code', $school_code)->where('deleted_at', NULL)->get();
        return view('learning.viewnote', compact('note', 'classes', 'name'));
    }


    public function viewsubmitted()
    {
        $school_code = Auth::user()->school_code;
        $id = request('id');
        $classes=Classes::where('school_code', $school_code)->where('deleted_at', NULL)->get();
        $allassignment = Assignmentsubmit::where('school_code', $school_code)->where('assignment_id', $id)->where('deleted_at', NULL)->get();
        $assignment = Assignment::where('id', $id)->where('deleted_at', NULL)->first();
        $students = Student::get();
        return view('learning.viewsubmitted', compact('assignment', 'allassignment', 'classes', 'students'));
    }

    public function viewassignment()
    {
        $school_code = Auth::user()->school_code;
        $id = request('id');
        $status = request('status');
        $error = request('error');

        if (isset($id)) {
            $note = Assignment::findOrfail($id);
            $roll = $note->teacher;
            $teacher = Teacher::where('school_code', $school_code)->where('roll', $roll)->where('deleted_at', NULL)->first();
            $name = $teacher->lastname.' '.$teacher->firstname.' '.$teacher->middlename;
            $classes=Classes::where('school_code', $school_code)->where('deleted_at', NULL)->get();

            $assignment = Assignmentsubmit::where('assignment_id', $id)->where('roll', Auth::user()->username)->first();
            //return $assignment;
            if (isset($assignment)) {
                return view('learning.viewassignment', compact('note', 'classes', 'name', 'assignment', 'status', 'error'));
            }
            else
            {
                return view('learning.viewassignment', compact('note', 'classes', 'name', 'status', 'error'));
            }
            
        }
        else
        {
            return back();
        }
    }

    public function notes()
    {
        $status = request('status'); 
        $error = request('error'); 
        $school_code = Auth::user()->school_code;
        $roll = Auth::user()->username;


        if (Auth::user()->role=="Staff") {

            $notes = Note::where('deleted_at', NULL)->where('teacher', $roll)->where('school_code', $school_code)->get();
            $teacher = Teacher::where('school_code', $school_code)->where('roll', $roll)->where('deleted_at', NULL)->first();
            $subject = $teacher->subject;

            $school = School::where('school_code', $school_code)->first();
            $session = $school->current_session;
            $mainsession = Session::where('school_code', $school_code)->where('name', $session)->where('deleted_at', NULL)->first();
            $term = $school->current_term;
            

            $subject_teachers = Subjectteacher::where('school_code', $school_code)->where('deleted_at', NULL)->where('roll', $roll)->where('session', $session)->where('term', $term)->get();
          
            $classes=Classes::where('school_code', $school_code)->where('deleted_at', NULL)->get();
            $subjects=Subject::where('deleted_at', NULL)->where('school_code', $school_code)->get();
            return view('learning.notes', compact('notes', 'subject_teachers', 'classes', 'subjects', 'mainsession', 'status', 'error', 'subject'));
        }
        else
        {
            $student = Student::where('school_code', $school_code)->where('roll', $roll)->where('deleted_at', NULL)->first();
            if (!isset($student)) {
                return back();
            }
            $class = $student->getOriginal('class');
            $school = School::where('school_code', $school_code)->first();
            $session = $school->current_session;
            $mainsession = Session::where('school_code', $school_code)->where('name', $session)->where('deleted_at', NULL)->first();
            $term = $school->current_term;
            $notes = Note::where('deleted_at', NULL)->where('session', $session)->where('term', $term)->where('class', $class)->where('school_code', $school_code)->get();
            
            $teachers=Teacher::where('school_code', $school_code)->where('deleted_at', NULL)->get();
            $classes=Classes::where('school_code', $school_code)->where('deleted_at', NULL)->get();
            $subjects=Subject::where('deleted_at', NULL)->where('school_code', $school_code)->get();
            return view('learning.notes', compact('notes', 'classes', 'subjects', 'mainsession', 'status', 'error', 'teachers'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storenote(Request $request)
    {
        //return $request;
        $note = new Note();
        $note->school_code = $request->school_code; 
        $note->class = $request->class; 
        $note->teacher = $request->teacher; 
        $note->session = $request->session;
        $note->subject = $request->subject;
        $note->term = $request->term;
        $note->title = $request->title;
        $note->note= $request->note; 

        $imageExtensions = ['pdf', 'docx', 'doc', 'docs'];

        if ($request->file('pdf')) {
            $file1 = $request->file('pdf');
            $path1 = Storage::disk('public1')->putFile('pdf', $file1);
            $explodeImage = explode('.', $path1);
            $extension = end($explodeImage);

            if(in_array($extension, $imageExtensions))
            {
                $note->pdf = $path1;
            }
            else
            {
                $error = "Document Must Be PDF or Word Document";
                return redirect()->route('notes', array('error' => $error));
            }
        }
        $note->save();
        $status = "Note Succssfully Added";
        return redirect()->route('notes', array('status' => $status));
    }

    public function updatenote(Request $request)
    {
        $id= $request->id; 
        $note = Note::findOrfail($id);
        $note->school_code = $request->school_code; 
        $note->class = $request->class; 
        $note->teacher = $request->teacher; 
        $note->session = $request->session;
        $note->subject = $request->subject;
        $note->term = $request->term;
        $note->title = $request->title;
        $note->note= $request->note; 

        $imageExtensions = ['pdf', 'docx', 'doc', 'docs'];

        if ($request->file('pdf')) {
            $file1 = $request->file('pdf');
            $path1 = Storage::disk('public1')->putFile('pdf', $file1);
            $explodeImage = explode('.', $path1);
            $extension = end($explodeImage);

            if(in_array($extension, $imageExtensions))
            {
                $note->pdf = $path1;
            }
            else
            {
                $error = "Document Must Be PDF or Word Document";
                return redirect()->route('notes', array('error' => $error));
            }
        }
        $note->update();
        $status = "Note Succssfully Updated";
        return redirect()->route('notes', array('status' => $status));
    }

    public function destroynote($id)
    {
        Note::destroy($id);
        return back();
    }

    public function destroyassignment($id)
    {
        Assignment::destroy($id);
        return back();
    }


    public function putassignment()
    {
        $status = request('status'); 
        $error = request('error'); 
        $school_code = Auth::user()->school_code;
        $roll = Auth::user()->username;
        if (Auth::user()->role=="Staff") {
            $notes = Assignment::where('deleted_at', NULL)->where('teacher', $roll)->where('school_code', $school_code)->get();
            $teacher = Teacher::where('school_code', $school_code)->where('roll', $roll)->where('deleted_at', NULL)->first();
            $subject = $teacher->subject;

            $school = School::where('school_code', $school_code)->first();
            $session = $school->current_session;
            $mainsession = Session::where('school_code', $school_code)->where('name', $session)->where('deleted_at', NULL)->first();
            $term = $school->current_term;
            

            $subject_teachers = Subjectteacher::where('school_code', $school_code)->where('deleted_at', NULL)->where('roll', $roll)->where('session', $session)->where('term', $term)->get();
          
            $classes=Classes::where('school_code', $school_code)->where('deleted_at', NULL)->get();
            $subjects=Subject::where('deleted_at', NULL)->where('school_code', $school_code)->get();
            return view('learning.putassignment', compact('notes', 'subject_teachers', 'classes', 'subjects', 'mainsession', 'status', 'error', 'subject'));
        }
        else
        {
            $school = School::where('school_code', $school_code)->first();
            $session = $school->current_session;
            $mainsession = Session::where('school_code', $school_code)->where('name', $session)->where('deleted_at', NULL)->first();
            $term = $school->current_term;
            $teachers=Teacher::where('school_code', $school_code)->where('deleted_at', NULL)->get();
            $classes=Classes::where('school_code', $school_code)->where('deleted_at', NULL)->get();
            $subjects=Subject::where('deleted_at', NULL)->where('school_code', $school_code)->get();
            $student = Student::where('school_code', $school_code)->where('roll', $roll)->where('deleted_at', NULL)->first();
            if (!isset($student)) {
                return back();
            }
            $class = $student->getOriginal('class');
            $notes = Assignment::where('deleted_at', NULL)->where('session', $session)->where('term', $term)->where('class', $class)->where('school_code', $school_code)->get();

            $myassignment = Assignmentsubmit::where('roll', Auth::user()->username)->get();

            return view('learning.putassignment', compact('notes', 'class', 'classes', 'subjects', 'mainsession', 'status', 'error', 'student', 'teachers', 'term', 'myassignment'));
        }
    }

    public function storeassignment(Request $request)
    {
        //return $request;
        $note = new Assignment();
        $note->school_code = $request->school_code; 
        $note->class = $request->class; 
        $note->teacher = $request->teacher; 
        $note->session = $request->session;
        $note->grade_score = $request->grade_score;
        $note->subject = $request->subject;
        $note->term = $request->term;
        $note->submission_date = $request->submission_date;
        $note->note= $request->note; 

        $imageExtensions = ['pdf', 'docx', 'doc', 'docs'];

        if ($request->file('pdf')) {
            $file1 = $request->file('pdf');
            $path1 = Storage::disk('public1')->putFile('pdf', $file1);
            $explodeImage = explode('.', $path1);
            $extension = end($explodeImage);

            if(in_array($extension, $imageExtensions))
            {
                $note->pdf = $path1;
            }
            else
            {
                $error = "Document Must Be PDF or Word Document";
                return redirect()->route('putassignment', array('error' => $error));
            }
        }
        $note->save();
        $status = "Assignment Succssfully Added";
        return redirect()->route('putassignment', array('status' => $status));
    }

    public function updateassignment(Request $request)
    {
        $id= $request->id; 
        $note = Assignment::findOrfail($id);
        $note->school_code = $request->school_code; 
        $note->class = $request->class; 
        $note->teacher = $request->teacher; 
        $note->session = $request->session;
        $note->grade_score = $request->grade_score;
        $note->subject = $request->subject;
        $note->term = $request->term;
        $note->submission_date = $request->submission_date;
        $note->note= $request->note; 

        $imageExtensions = ['pdf', 'docx', 'doc', 'docs'];

        if ($request->file('pdf')) {
            $file1 = $request->file('pdf');
            $path1 = Storage::disk('public1')->putFile('pdf', $file1);
            $explodeImage = explode('.', $path1);
            $extension = end($explodeImage);

            if(in_array($extension, $imageExtensions))
            {
                $note->pdf = $path1;
            }
            else
            {
                $error = "Document Must Be PDF or Word Document";
                return redirect()->route('putassignment', array('error' => $error));
            }
        }
        $note->update();
        $status = "Assignment Succssfully Updated";
        return redirect()->route('putassignment', array('status' => $status));
    }

    public function submitassignment(Request $request)
    {
        if (isset($request->id)) {
            $note = Assignmentsubmit::findOrfail($request->id);
            $imageExtensions = ['pdf', 'docx', 'doc', 'docs'];

            if ($request->file('pdf')) {
                $file1 = $request->file('pdf');
                $path1 = Storage::disk('public1')->putFile('pdf', $file1);
                $explodeImage = explode('.', $path1);
                $extension = end($explodeImage);

                if(in_array($extension, $imageExtensions))
                {
                    $note->pdf = $path1;
                }
                else
                {
                    $error = "Document Must Be PDF or Word Document";
                    return redirect()->route('viewassignment', array('error' => $error, 'id' => $request->assignment_id));
                }
            }
            $note->update();
        }
        else
        {
            $note = new Assignmentsubmit();
            $note->school_code = $request->school_code; 
            $note->roll= $request->roll; 
            $note->assignment_id = $request->assignment_id;
            $imageExtensions = ['pdf', 'docx', 'doc', 'docs'];

            if ($request->file('pdf')) {
                $file1 = $request->file('pdf');
                $path1 = Storage::disk('public1')->putFile('pdf', $file1);
                $explodeImage = explode('.', $path1);
                $extension = end($explodeImage);

                if(in_array($extension, $imageExtensions))
                {
                    $note->pdf = $path1;
                }
                else
                {
                    $error = "Document Must Be PDF or Word Document";
                    return redirect()->route('viewassignment', array('error' => $error, 'id' => $request->assignment_id));
                }
            }
            $note->save();
        }
        $status = "Assignment Succssfully Submitted";
        return redirect()->route('viewassignment', array('status' => $status, 'id' => $request->assignment_id));
    }


    public function addscore(Request $request)
    {
        $id= $request->id; 
        $note = Assignmentsubmit::findOrfail($id);
        $note->update($request->all());
        return back();
        $status = "Note Succssfully Updated";
        return redirect()->route('notes', array('status' => $status));
    }
}
