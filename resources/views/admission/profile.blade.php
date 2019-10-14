@extends('layouts.admin')
@section('pageTitle', 'Applicant Profile')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
      <div class="header-icon">
          <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
          <h1>Applicant</h1>
          <small></small>
          <ol class="breadcrumb hidden-xs">
              <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
              <li class="active">Applicant</li>
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
                      <div style="background:#DC2D2D; height:auto; text-align: center; color: white">
                        <h4 style="padding: 20px">Applicant Profile</h4>
                      </div>


                      <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                          <tr>
                            <th>Full Name</th>
                            <td>{{ $profile->lastname }} {{ $profile->firstname }} {{ $profile->middlename }}</td>
                          </tr>
                          <tr>
                            <th>Applicant ID</th>
                            <td>{{ $profile->application_id }}</td>
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
                            <td>{{ $profile->address }}</td>
                          </tr>

                          <tr>
                            <th>Present School</th>
                            <td>{{ $profile->present_school }}</td>
                          </tr>

                          <tr>
                            <th>Present Class</th>
                            <td>{{ $profile->present_class }}</td>
                          </tr>

                          <tr>
                            <th>Class of Interest</th>
                            <td>{{ $profile->class_of_interest }}</td>
                          </tr>

                          

                          <tr>
                            <th>Nationality (State of Origin, LGA)</th>
                            <td>{{ $profile->nationality }} ({{ $profile->state }} {{ $profile->lga }})</td>
                          </tr>

                      


                          <tr>
                            <th>Name of Parent/Guardian</th>
                            <td>{{ $profile->guardian_title}} {{ $profile->guardian_name }}</td>
                          </tr>


                          <tr>
                            <th>Guardian Address</th>
                            <td>{{ $profile->guardian_address }}</td>
                          </tr>


                          <tr>
                            <th>Guardian Phone Number</th>
                            <td>{{ $profile->guardian_phone }}</td>
                          </tr>

                          <tr>
                            <th>Status</th>
                            <td>
                              {{ $profile->status }}  <br>
                              <a href="{{ url('admin/condition') }}/?condition=Admitted&id={{ $profile->id }}">Accept</a> |
                              <a href="{{ url('admin/condition') }}/?condition=Rejected&id={{ $profile->id }}">Reject</a>
                            </td>
                          </tr>
                        </table>
                      </div>

                    </div>   
                  </div>
                </div>
              </div>
            </div>
        </div> 
      </div>
    </div>
  </section>
</div>
@endsection
