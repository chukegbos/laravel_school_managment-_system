@extends('layouts.admin')
@section('pageTitle', 'Student Profile')
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
                </div>
                <div class="col-sm-8">
                    <p style="text-align:center; font-size: 20px; font-weight: bold;">{{ strtoupper($setting->school_name) }}</p>   
                    <p style="text-align:center; margin-top: 10px; font-size: 15px; font-weight: bold;">Address: {{ ucwords($setting->address) }} <br>{{ $setting->email }}<br>{{ $setting->phone }}</p>
                </div> 
                <div class="col-sm-2">
                  <img class="img-fluid img-responsive" src="{{ asset('storage') }}/{{ $profile->image }}" alt="User profile picture" style="height: 100px; display: block; margin-left: auto; margin-right: auto; width: 50%;">
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12">
                  <div class="row">
                    <div class="col-sm-12">
                      <div style="background:#009688; height:auto; text-align: center; color: white">
                        <h4 style="padding: 20px">Student Profile</h4>
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
                            <th>Admission ID</th>
                            <td>{{ $profile->roll }}</td>
                          </tr>

                          <tr>
                            <th>Current Class</th>
                            <td>{{ $profile->class }} @if (Auth::user()->role=="Admin")<a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="#assignmmodal" >Assign Class</a>@endif<p></td>
                          </tr>
                          <tr>
                            <th>Date of Admission</th>
                            <td>{{ $profile->doa->toDateString() }}</td>
                          </tr>

                          <tr>
                            <th>Hostel (Bedspace)</th>
                            <td>
                              @forelse($hostels as $hostel)
                                @if($hostel->code == $profile->hostel)
                                  {{ $hostel->name }} Hostel - {{ $hostel->category }}- {{ $hostel->gender }}
                                @endif
                              @empty
                              @endforelse
                              (Bed {{ $profile->bed }})
                            </td>
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
                            <th>Tribe</th>
                            <td>{{ $profile->tribe }}</td>
                          </tr>
                          <tr>
                            <th>Religion</th>
                            <td>{{ $profile->religion }}</td>
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
                            <th>Blood Group</th>
                            <td>{{ $profile->bg }}</td>
                          </tr>


                          <tr>
                            <th>Genotype</th>
                            <td>{{ $profile->genotype }}</td>
                          </tr>

                          <tr>
                            <th>Asthmatic</th>
                            <td>{{ $profile->asthmatic }}</td>
                          </tr>

                          <tr>
                            <th>Any Eye Problem?</th>
                            <td>{{ $profile->eye }}</td>
                          </tr>
                          @if($profile->eye=="Yes")
                          <tr>
                            <th>Eye Issues</th>
                            <td>{{ $profile->eye_issue }}</td>
                          </tr>
                          @endif

                          <tr>
                            <th>Disabled?</th>
                            <td>{{ $profile->disability }}</td>
                          </tr>
                          @if($profile->disability=="Yes")
                          <tr>
                            <th>Disability</th>
                            <td>{{ $profile->disability_issue }}</td>
                          </tr>
                          @endif

                          <tr>
                            <th>Acceptance Form</th>
                            <td>
                              @if($profile->acceptance_form==NULL)
                                Not Available
                              @else
                                <a href="{{ asset('storage') }}/{{ $profile->acceptance_form }}"><img class="img-fluid" src="{{ asset('storage') }}/{{ $profile->acceptance_form }}" style="height: 60px; width: 60px"> click to view</a>
                              @endif
                              </td>
                          </tr>

                          <tr>
                            <th>Birth Certificate</th>
                            <td>
                              @if($profile->birth_certificate==NULL)
                                Not Available
                              @else
                                <a href="{{ asset('storage') }}/{{ $profile->birth_certificate }}"><img class="img-fluid" src="{{ asset('storage') }}/{{ $profile->birth_certificate }}" style="height: 60px; width: 60px"> click to view</a>
                              @endif
                            </td>
                          </tr>

                          <tr>
                            <th>Medical Certificate</th>
                            <td>
                              @if($profile->medical_certificate==NULL)
                                Not Available
                              @else
                                <a href="{{ asset('storage') }}/{{ $profile->medical_certificate }}"><img class="img-fluid" src="{{ asset('storage') }}/{{ $profile->medical_certificate }}" style="height: 60px; width: 60px"> click to view</a>
                              @endif
                            </td>
                          </tr>

                          <tr>
                            <th>School Transfer Certificate</th>
                            <td>
                              @if($profile->transfer_certificate==NULL)
                                Not Available
                              @else
                                <a href="{{ asset('storage') }}/{{ $profile->transfer_certificate }}"><img class="img-fluid" src="{{ asset('storage') }}/{{ $profile->transfer_certificate }}" style="height: 60px; width: 60px"> click to view</a>
                              @endif
                              </td>
                          </tr>

                          <tr>
                            <th>Local Government Identification</th>
                            <td>
                              @if($profile->lgi==NULL)
                                Not Available
                              @else
                                <a href="{{ asset('storage') }}/{{ $profile->lgi }}"><img class="img-fluid" src="{{ asset('storage') }}/{{ $profile->lgi }}" style="height: 60px; width: 60px"> click to view</a>
                              @endif
                              </td>
                          </tr>

                          <tr>
                            <th>Any Licence or Identity Card</th>
                            <td>
                              @if($profile->licence==NULL)
                                Not Available
                              @else
                                <a href="{{ asset('storage') }}/{{ $profile->licence }}"><img class="img-fluid" src="{{ asset('storage') }}/{{ $profile->licence }}" style="height: 60px; width: 60px"> click to view</a>
                              @endif
                              </td>
                          </tr>

                          <tr>
                            <th>First School Leaving Cerificate</th>
                            <td>
                              @if($profile->fslc==NULL)
                                Not Available
                              @else
                                <a href="{{ asset('storage') }}/{{ $profile->fslc }}"><img class="img-fluid" src="{{ asset('storage') }}/{{ $profile->fslc }}" style="height: 60px; width: 60px"> click to view</a>
                              @endif
                            </td>
                          </tr>

                          <tr>
                            <th>Any Other Credential</th>
                            <td>
                              @if($profile->other_certificate==NULL)
                                Not Available
                              @else
                                <a href="{{ asset('storage') }}/{{ $profile->other_certificate }}"><img class="img-fluid" src="{{ asset('storage') }}/{{ $profile->other_certificate }}" style="height: 60px; width: 60px"> click to view</a>
                              @endif
                              </td>
                          </tr>

                          <tr>
                            <th>Name of Guardian</th>
                            <td>{{ $profile->guardian_name }}</td>
                          </tr>


                          <tr>
                            <th>Guardian Initial</th>
                            <td>{{ $profile->guardian_initial }}</td>
                          </tr>

                          <tr>
                            <th>Guardian Relationship</th>
                            <td>{{ $profile->guardian_relationship }}</td>
                          </tr>


                          <tr>
                            <th>Guardian Occupation</th>
                            <td>{{ $profile->guardian_occupation }}</td>
                          </tr>


                          <tr>
                            <th>Guardian Phone Number</th>
                            <td>{{ $profile->guardian_phone }}</td>
                          </tr>

                          <tr>
                            <th>Guardian Relationship</th>
                            <td>{{ $profile->guardian_email }}</td>
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
              <a href="{{ url('/admin/editstudent') }}/?roll={{ $profile->roll }}" class="btn btn-danger pull-right" style="margin-right: 5px;">
                <i class="fa fa-edit"></i> Edit Profile
              </a>
              <!--<a href="#" data-toggle="modal" data-target="#resultmodal"  class="btn btn-primary pull-right" style="margin-right: 5px;">
                <i class="fa fa-dashboard"></i> View Student Result
              </a>-->
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

  <div class="modal fade" id="assignmmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog" style="background:white">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"> Assign Class</h4>
            </div>
            <div class="modal-body">
              <form method="post" class="profile-wrapper" action="{{ url('admin/station') }}" >
                 {{ csrf_field() }}
                  
                   <div class="form-group">
                      <label for="fname">Classes</label>
                      <select name="class" class="form-control" required>
                          <option>Select Class</option>
                          @forelse($classes as $class)
                              <option value="{{ $class->id }}">{{ $class->name }} {{ $class->form }}</option>
                          @empty
                          @endforelse
                      </select>
                      <input type="hidden" value="{{ $profile->roll }}" name="roll">
                  </div>
                  <button type="submit" class="btn btn-success pull-right">Assign <i class="fa fa-save"></i></button>                              
              </form>
            </div>
            
            <div class="modal-footer">
             
            </div>
          </div><!-- /.modal-content -->                     
      </div>
  </div>

  <div class="modal fade" id="activemmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog" style="background:white">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"> Change Status</h4>
            </div>
            <div class="modal-body">
              <form method="post" class="profile-wrapper" action="{{ url('admin/status') }}" >
                 {{ csrf_field() }}
                  
                   <div class="form-group">
                      <label for="fname">Status</label>
                      <select name="status" class="form-control" id="category_id2">
                        <option value="Active">Active</option>
                        <option value="Suspended">Suspend</option>
                        <option value="Expelled">Expell</option>
                      </select>
                      <input type="hidden" value="{{ $profile->roll }}" name="roll">
                  </div>                    
                  <button type="submit" class="btn btn-success pull-right">Change <i class="fa fa-save"></i></button>                              
              </form>
            </div>
            
            <div class="modal-footer">
             
            </div>
          </div><!-- /.modal-content -->                     
      </div>
  </div>
@endsection
