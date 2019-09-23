@extends('layouts.admin')
@section('pageTitle', 'Staff Profile')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
      <div class="header-icon">
          <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
          <h1>Profile</h1>
          <small></small>
          <ol class="breadcrumb hidden-xs">
              <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
              <li class="active">Profile</li>
          </ol>
      </div>
  </section>

  <section class="content">
    <div class="row">
      <!-- Form controls -->
      <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-body">
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

              <div class="row">
                <div class="col-sm-2">
                  <img class="img-fluid img-responsive" src="{{ asset('storage') }}/{{ $profile->image }}" alt="User profile picture" style="height: 150px;width: 200px">
                </div>
                <div class="col-sm-8">
                    <p style="text-align:center; font-size: 20px; font-weight: bold;">{{ strtoupper($setting->school_name) }}</p>   
                    <p style="text-align:center; margin-top: 10px; font-size: 15px; font-weight: bold;">Address: {{ ucwords($setting->address) }} <br>{{ $setting->email }}<br>{{ $setting->phone }}</p>
                </div> 
              </div>

              <div class="row">
                <div class="col-sm-12">
                  <div class="row">
                    <div class="col-sm-12">
                      <div style="background:#009688; height:auto; text-align: center; color: white">
                        <h4 style="padding: 20px">Staff Profile</h4>
                      </div>
                      
                      <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                          <tr>
                            <th>Full Name</th>
                            <td>{{ $profile->lastname }} {{ $profile->firstname }} {{ $profile->middlename }}</td>
                          </tr>
                          <tr>
                            <th>School Code</th>
                            <td>{{ $profile->school_code }}</td>
                          </tr>
                          <tr>
                            <th>Staff Roll/ID (Category)</th>
                            <td>{{ $profile->roll }} ({{ $profile->category }} staff)</td>
                          </tr>

                          <tr>
                            <th>Subject Taught</th>
                            <td>{{ $profile->subject }}</td>
                          </tr>
                          <tr>
                            <th>Phone Number</th>
                            <td>{{ $profile->phone }}</td>
                          </tr>
                          <tr>
                            <th>Email</th>
                            <td>{{ $profile->email}}</td>
                          </tr>
                          
                          <tr>
                            <th>Date of Birth</th>
                            <td>{{ $profile->dob->toFormattedDateString() }} ({{ $profile->age }} Years)</td>
                          </tr>

                          <tr>
                            <th>Gender</th>
                            <td>{{ $profile->gender }}</td>
                          </tr>

                          <tr>
                            <th>Current Address</th>
                            <td>{{ $profile->current_address }}</td>
                          </tr>

                          <tr>
                            <th>Parmanent Address</th>
                            <td>{{ $profile->parmanent_address }}</td>
                          </tr>

                          <tr>
                            <th>Nationality (State of Origin)</th>
                            <td>{{ $profile->country }} ({{ $profile->state }})</td>
                          </tr>

                          <tr>
                            <th>LGA</th>
                            <td>{{ $profile->city }}</td>
                          </tr>

                          <tr>
                            <th>Religion</th>
                            <td>{{ $profile->religion }}</td>
                          </tr>

                          <tr>
                            <th>Position</th>
                            <td>{{ $profile->position }}</td>
                          </tr>

                          <tr>
                            <th>Current Form Class</th>
                            <td>{{ $profile->class }}</td>
                          </tr>

                          <tr>
                            <th>Recent Degree</th>
                            <td>{{ $profile->last_degree }}</td>
                          </tr>

                          <tr>
                            <th>University Attended</th>
                            <td>{{ $profile->university_attended }}</td>
                          </tr>
                        </table>
                      </div>

                    </div>   
                  </div>
                </div>
              </div>
            </div>
        </div> 
        <hr>
        <div class="row no-print">
          <div class="col-12">
            @if(Auth::user()->role=="Admin" || Auth::user()->role=="Zalla Admin" )
              <a href="{{ url('/admin/editstaff') }}/?roll={{$profile->roll}}" class="btn btn-danger" style="margin-right: 5px;">
              <i class="fa fa-edit"></i> Edit Profile
              </a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
