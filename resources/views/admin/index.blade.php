@extends('layouts.admin')
@section('pageTitle', 'Dashboard')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-tachometer"></i>
        </div>
        <div class="header-title">
            <h1> Dashboard</h1>
            <small> Dashboard features</small>
            <ol class="breadcrumb hidden-xs">
                <p><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></p>
                <p class="active">Dashboard</p>
            </ol>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        @if(isset($status))
            <div class="alert alert-success alert-dismissable" style="margin:20px">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>  <i class="icon fa fa-check"></i> Success!</h4>
                {{ $status}}
            </div>
        @endif

        @if(isset($error))
            <div class="alert alert-danger alert-dismissable" style="margin:20px">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>  <i class="icon fa fa-times"></i> Oops!</h4>
                {{ $error}}
            </div>
        @endif
        @if(Auth::user()->role=="Admin")
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-7">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <a href="{{ url('/admin/students') }}">
                                <div class="panel panel-bd cardbox ">
                                    <div class="panel-body">
                                        <div class="statistic-box">
                                            <h2><span class="count-number">{{ $countstudent }}</span>
                                            </h2>
                                        </div>
                                        <div class="items pull-left">
                                            <i class="fa fa-users fa-2x"></i>
                                            <h4>Students </h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                                       
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <a href="{{ url('/admin/staff') }}">
                                <div class="panel panel-bd cardbox" style="background: #FFB61E">
                                    <div class="panel-body">
                                        <div class="statistic-box">
                                            <h2><span class="count-number">{{ $countstaff }}</span>
                                            </h2>
                                        </div>
                                        <div class="items pull-left">
                                            <i class="fa fa-users fa-2x"></i>
                                            <h4>Staff</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <a href="{{ url('/admin/classes') }}">
                                <div class="panel panel-bd cardbox" style="background: #E5343D">
                                    <div class="panel-body">
                                        <div class="statistic-box">
                                            <h2><span class="count-number">{{ $countclass }}</span>
                                            </h2>
                                        </div>
                                        <div class="items pull-left">
                                            <i class="fa fa-user-circle fa-2x"></i>
                                            <h4>Classes</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <a href="{{ url('/admin/subject') }}">
                                <div class="panel panel-bd cardbox" style="background: #58C9F3">
                                    <div class="panel-body">
                                        <div class="statistic-box">
                                            <h2><span class="count-number">{{ $countsubject }}</span>
                                            </h2>
                                        </div>
                                        <div class="items pull-left">
                                            <i class="fa fa-users fa-2x"></i>
                                            <h4>Subjects</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <a href="{{ url('/admin/bed') }}">
                                <div class="panel panel-bd cardbox" style="background: #474751">
                                    <div class="panel-body">
                                        <div class="statistic-box">
                                            <h2></span>
                                            </h2>
                                        </div>
                                        <div class="items pull-left">
                                            <i class="fa fa-bed fa-2x"></i>
                                            <h4>Hostels</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <a href="{{ url('/admin/books') }}">
                                <div class="panel panel-bd cardbox" style="background: #009688">
                                    <div class="panel-body">
                                        <div class="statistic-box">
                                            <h2><span class="count-number"></span>
                                            </h2>
                                        </div>
                                        <div class="items pull-left">
                                            <i class="fa fa-book fa-2x"></i>
                                            <h4>Library</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-5 col-md-5">
                    <div class="panel panel-bd lobidisable">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Account Info</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <p>Name: <span style="color:#3781d3">{{ $setting->school_name }}</span></p>
                            <p>School Code: <span style="color:#3781d3">{{ $setting->school_code }}</span></p>
                            <p>Motto: <span style="color:#3781d3">{{ $setting->slogan }}</span></p>
                            <hr>
                            
                            <p>Current Session: <span style="color:#3781d3">{{ $setting->current_session }}</span></p>
                            <p>Current Term: <span style="color:#3781d3">{{ $setting->current_term }}</span></p>
                            <hr>
                            <p>Account Status: <span style="color:#3781d3"> {{ $setting->status }}</span></p>
                            <p>Expiry Date: <span style="color:#3781d3">  {{ $setting->active_end->toFormattedDateString() }}</span></p>
                            <p>Period: <span style="color:#3781d3"> {{ round((strtotime($setting->active_end) - strtotime($setting->created_at))/60/60/24 )}} more days</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="row">
                <div class="col-sm-12 col-md-7">
                    <div class="panel panel-bd lobidisable">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Account Info</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <p>Name: <span style="color:#3781d3">{{ $setting->school_name }}</span></p>
                            <p>School Code: <span style="color:#3781d3">{{ $setting->school_code }}</span></p>

                            <p>Motto: <span style="color:#3781d3">{{ $setting->slogan }}</span></p>
                            <p>Current Session: <span style="color:#3781d3">{{ $setting->current_session }}</span></p>
                            <p>Current Term: <span style="color:#3781d3">{{ $setting->current_term }}</span></p>
                            <p>Address: <span style="color:#3781d3">{{ $setting->address }}</span></p>
                            <p>Phone: <span style="color:#3781d3">{{ $setting->phone }}</span></p>
                            <p>Email: <span style="color:#3781d3">{{ $setting->email }}</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-5">
                    <div class="panel panel-bd lobidisable">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>About Zallaschool</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <p>ZallaSchool is a product of <a target="_blank" href="http://zallasoft.com.ng/">Zallasoft Technologies and Solutions.</a> An IT firm focused on Application Service Providing, Outsourcing Services, Managed Services.. 
                                <br><a target="_blank" href="http://zallasoft.com.ng/">Read More</a>
                            </p>

                            <p>ZallaSchool is aimed at  sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...
                                <br><a href="">Read More</a>
                            </p>
    
                            <p>Click <a target="_blank" href="">here</a> to download the complete documentation of this product and how to navigate and use this application effectively.</p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>-->
        @elseif(Auth::user()->role=="Staff")
         
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <div class="panel panel-bd lobidisable">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Account Info</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <p>Name: <span style="color:#3781d3">{{ $setting->school_name }}</span></p>
                            <p>School Code: <span style="color:#3781d3">{{ $setting->school_code }}</span></p>

                            <p>Motto: <span style="color:#3781d3">{{ $setting->slogan }}</span></p>
                            <p>Current Session: <span style="color:#3781d3">{{ $setting->current_session }}</span></p>
                            <p>Current Term: <span style="color:#3781d3">{{ $setting->current_term }}</span></p>
                            <p>Address: <span style="color:#3781d3">{{ $setting->address }}</span></p>
                            <p>Phone: <span style="color:#3781d3">{{ $setting->phone }}</span></p>
                            <p>Email: <span style="color:#3781d3">{{ $setting->email }}</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="panel panel-bd lobidisable">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Core Modules</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <p><span style="color:#3781d3">Class Management</span></p>
                                    <p><span style="color:#3781d3">Subject Management</span></p>
                                    <p><span style="color:#3781d3">Student Management</span></p>
                                    <p><span style="color:#3781d3">Student Attendance</span></p>
                                    <p><span style="color:#3781d3">Student Reports</span></p>
                                    <p><span style="color:#3781d3">Student Login</span></p>
                                </div>  
                                <div class="col-sm-12 col-md-4"> 
                                    <p><span style="color:#3781d3">Staff Management</span></p>
                                    <p><span style="color:#3781d3">Staff Login</span></p>
                                    <p><span style="color:#3781d3">Staff Attendance</span></p>
                                    <p><span style="color:#3781d3">Fee Management</span></p>
                                    <p><span style="color:#3781d3">Timetable</span></p>
                                    <p><span style="color:#3781d3">Homework</span></p>
                                    
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <p><span style="color:#3781d3">School Library</span></p>
                                    <p><span style="color:#3781d3">Houses/Hostels</span></p>
                                    <p><span style="color:#3781d3">Parent Login</span></p>
                                    <p><span style="color:#3781d3">Parent Complaint</span></p>
                                    <p><span style="color:#3781d3">Parent Enquiry</span></p>
                                    <p><span style="color:#3781d3">Publication Management</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
</div> 
@endsection