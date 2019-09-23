@extends('layouts.admin')
@section('pageTitle', 'Edit Profile')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <span style="font-size:20px">Edit {{ $profile->lastname }} {{ $profile->firstname }} {{ $profile->middlename }}'s Profile</span>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            <li class="active"> <a data-toggle="tab" href="#home">Data Home</a></li>
                            <li> <a data-toggle="tab" href="#parent">Parent/Guardian</a></li>
                            <li> <a data-toggle="tab" href="#admission">Admission</a></li>
                            <li> <a data-toggle="tab" href="#medicals">Medicals</a></li>
                            <li> <a data-toggle="tab" href="#credential">Credential</a></li>
                        </ul>
                     
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="home">
                                @if(isset($status))
                                  <div class="alert alert-success alert-dismissable" style="margin:20px">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4>  <i class="icon fa fa-check"></i> Success!</h4>
                                      {{ $status}}
                                  </div>
                                @endif
                                <div class="panel-body">
                                    <form method="post" class="profile-wrapper" action="{{ url('admin/editstudent') }}/{{ $profile->id }}" enctype="multipart/form-data">
                                        {{ method_field('PUT') }}
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="fname">First Name</label>
                                                    <input class="form-control" type="text" value="{{ $profile->firstname }}" name="firstname" required autofocus>                       
                                                    @if ($errors->has('firstname'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('firstname') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="fname">Middle Name</label>
                                                    <input class="form-control" type="text" value="{{ $profile->middlename }}" name="middlename" required autofocus>                       
                                                    @if ($errors->has('middlename'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('middlename') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="fname">Last Name</label>
                                                    <input class="form-control" type="text" value="{{ $profile->lastname }}" name="lastname" required autofocus>                       
                                                    @if ($errors->has('lastname'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('lastname') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Gender</label>
                                                    <select name="gender" class="form-control" id="category_id2">
                                                      <option {{ $profile->gender == "Male" ? 'selected' : '' }} value="Male">Male</option>
                                                      <option {{ $profile->gender == "Female" ? 'selected' : '' }} value="Female">Female</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Religion</label>
                                                    <select name="religion" class="form-control" id="category_id2">
                                                      <option {{ $profile->religion == "Christianity" ? 'selected' : '' }} value="Christianity">Christianity</option>
                                                      <option {{ $profile->religion == "Muslim" ? 'selected' : '' }} value="Muslim">Muslim</option>
                                                      <option {{ $profile->religion == "African Tradition" ? 'selected' : '' }} value="African Tradition">African Tradition</option>
                                                      <option {{ $profile->religion == "Other" ? 'selected' : '' }} value="Other">Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="fname">Tribe</label>
                                                    <input class="form-control" type="text" id="fname" value="{{ $profile->tribe }}" name="tribe" required autofocus>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Date of Birth</label>
                                                    <input class="form-control" type="date" value="{{ $profile->dob->format('Y-m-d') }}" name="dob" required autofocus>  
                                                </div>
                                            </div>
                                             <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">Country</label>
                                        <input class="form-control" type="text" value="Nigeria" name="country" readonly="true" autofocus>
                                        @if ($errors->has('country'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('country') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label>State of Origin</label>
                                      <select style="height: 35px" name="state" id="state" class="form-control" required="">
                                        <option value="" selected="selected" >- Select -</option>
                                        <option @if($profile->state=="Abia") Selected @endif value='Abia'>Abia</option>
                                        <option @if($profile->state=="Adamawa") Selected @endif value='Adamawa'>Adamawa</option>
                                        <option @if($profile->state=="AkwaIbom") Selected @endif value='AkwaIbom'>AkwaIbom</option>
                                        <option @if($profile->state=="Anambra") Selected @endif value='Anambra'>Anambra</option>
                                        <option @if($profile->state=="Bauchi") Selected @endif value='Bauchi'>Bauchi</option>
                                        <option @if($profile->state=="Bayelsa") Selected @endif value='Bayelsa'>Bayelsa</option>
                                        <option @if($profile->state=="Benue") Selected @endif value='Benue'>Benue</option>
                                        <option @if($profile->state=="Borno") Selected @endif value='Borno'>Borno</option>
                                        <option @if($profile->state=="Cross River") Selected @endif value='Cross River'>Cross River</option>
                                        <option @if($profile->state=="Delta") Selected @endif value='Delta'>Delta</option>
                                        <option @if($profile->state=="Ebonyi") Selected @endif value='Ebonyi'>Ebonyi</option>
                                        <option @if($profile->state=="Edo") Selected @endif value='Edo'>Edo</option>
                                        <option @if($profile->state=="Ekiti") Selected @endif value='Ekiti'>Ekiti</option>
                                        <option @if($profile->state=="Enugu") Selected @endif value='Enugu'>Enugu</option>
                                        <option @if($profile->state=="FCT") Selected @endif value='FCT'>FCT</option>
                                        <option @if($profile->state=="Gombe") Selected @endif value='Gombe'>Gombe</option>
                                        <option @if($profile->state=="Imo") Selected @endif value='Imo'>Imo</option>
                                        <option @if($profile->state=="Jigawa") Selected @endif value='Jigawa'>Jigawa</option>
                                        <option @if($profile->state=="Kaduna") Selected @endif value='Kaduna'>Kaduna</option>
                                        <option @if($profile->state=="Kano") Selected @endif value='Kano'>Kano</option>
                                        <option @if($profile->state=="Kastina") Selected @endif value='Katsina'>Katsina</option>
                                        <option @if($profile->state=="kebbi") Selected @endif value='Kebbi'>Kebbi</option>
                                        <option @if($profile->state=="Kogi") Selected @endif value='Kogi'>Kogi</option>
                                        <option @if($profile->state=="Kwara") Selected @endif value='Kwara'>Kwara</option>
                                        <option @if($profile->state=="Lagos") Selected @endif value='Lagos'>Lagos</option>
                                        <option @if($profile->state=="Nasarawa") Selected @endif value='Nasarawa'>Nasarawa</option>
                                        <option @if($profile->state=="Niger") Selected @endif value='Niger'>Niger</option>
                                        <option @if($profile->state=="Ogun") Selected @endif value='Ogun'>Ogun</option>
                                        <option @if($profile->state=="Ondo") Selected @endif value='Ondo'>Ondo</option>
                                        <option @if($profile->state=="Osun") Selected @endif value='Osun'>Osun</option>
                                        <option @if($profile->state=="Oyo") Selected @endif value='Oyo'>Oyo</option>
                                        <option @if($profile->state=="Plateau") Selected @endif value='Plateau'>Plateau</option>
                                        <option @if($profile->state=="Rivers") Selected @endif value='Rivers'>Rivers</option>
                                        <option @if($profile->state=="Sokoto") Selected @endif value='Sokoto'>Sokoto</option>
                                        <option @if($profile->state=="Taraba") Selected @endif value='Taraba'>Taraba</option>
                                        <option @if($profile->state=="Yobe") Selected @endif value='Yobe'>Yobe</option>
                                        <option @if($profile->state=="Zamfara") Selected @endif value='Zamfara'>Zamafara</option>
                                      </select>
                                    </div>
                                  </div>
        
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label>LGA of Origin</label>
                                        <select name="city" id="lga" class="form-control" required>
                                        </select>
                                    </div>
                                  </div>

                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="experience" class="control-label"><b>Current Address</b></label>
                                                    <textarea class="form-control"  name="current_address" width="840px" height="1000px" required="">{{ $profile->current_address }}</textarea>

                                                    @if ($errors->has('address'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('address') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="experience" class="control-label"><b>Parmanent Address</b></label>
                                                    <textarea class="form-control" required="" name="parmanent_address" width="840px" height="1000px">{{ $profile->parmanent_address }}</textarea>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <img class="img-responsive img-fluid" src="{{ asset('storage') }}/{{ $profile->image }}" style="height: 120px; width: 120px" alt="">
                                                <div class="form-group input-group image-preview">
                                                   
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                                            <span class="glyphicon glyphicon-remove"></span> Clear
                                                        </button>
                                                        <div class="btn btn-default image-preview-input">
                                                            <span class="glyphicon glyphicon-folder-open"></span>
                                                            <span class="image-preview-input-title">Click To Upload Student Photo</span>
                                                            <input id="file1" type="file" name="image"/>
                                                        </div>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>                            
                                        <button type="submit" class="btn btn-success pull-right">Edit <i class="fa fa-save"></i></button>                           
                                    </form>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="parent">
                                @if(isset($status))
                                  <div class="alert alert-success alert-dismissable" style="margin:20px">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4>  <i class="icon fa fa-check"></i> Success!</h4>
                                      {{ $status}}
                                  </div>
                                @endif
                                <div class="panel-body">
                                    <form method="post" class="profile-wrapper" action="{{ url('admin/editstudent') }}/{{ $profile->id }}" enctype="multipart/form-data">
                                        {{ method_field('PUT') }}
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Guardian's Title</label>
                                                    <select name="guardian_initial" class="form-control" id="category_id2">
                                                      <option {{ $profile->guardian_initial == "Mr."? 'selected' : '' }} value="Mr.">Mr.</option>
                                                      <option {{ $profile->guardian_initial == "Mrs."? 'selected' : '' }}value="Mrs.">Mrs.</option>
                                                      <option {{ $profile->guardian_initial == "Miss"? 'selected' : '' }}value="Miss">Miss</option>
                                                      <option {{ $profile->guardian_initial == "Prof."? 'selected' : '' }}value="Prof.">Prof.</option>
                                                      <option {{ $profile->guardian_initial == "Dr."? 'selected' : '' }}value="Dr.">Dr.</option>
                                                      <option {{ $profile->guardian_initial == "Barr."? 'selected' : '' }}value="Barr.">Barr.</option>
                                                      <option {{ $profile->guardian_initial == "Other"? 'selected' : '' }}value="Other">Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="fname">Guardian Name</label>
                                                    <input class="form-control" type="text"  value="{{ $profile->guardian_name }}" name="guardian_name" required autofocus>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Guardian's Relationship</label>
                                                    <select name="guardian_relationship" class="form-control" id="category_id2">
                                                      <option {{ $profile->guardian_relationship == "Father"? 'selected' : '' }} value="Father">Father</option>
                                                      <option {{ $profile->guardian_relationship == "Mother."? 'selected' : '' }} value="Mother">Mother</option>
                                                      <option {{ $profile->guardian_relationship == "Uncle"? 'selected' : '' }} value="Uncle">Uncle</option>
                                                      <option {{ $profile->guardian_relationship == "Aunty"? 'selected' : '' }} value="Aunty">Aunty</option>
                                                      <option {{ $profile->guardian_relationship == "Other"? 'selected' : '' }} value="Other">Others</option>
                                                    </select>
                                                </div>
                                            </div>                      
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="fname">Guardian Occupation</label>
                                                    <input class="form-control" type="text" value="{{ $profile->guardian_occupation }}" name="guardian_occupation" >                       
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="fname">Guardian Phone Number</label>
                                                    <input class="form-control" type="text" value="{{ $profile->guardian_phone }}" name="guardian_phone" >                       
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="fname">Guardian Email</label>
                                                    <input class="form-control" type="email" value="{{ $profile->guardian_email }}" name="guardian_email" >                       
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="experience" class="control-label"><b>Guardian Address<span style="color:green"></span></b></label>
                                                    <textarea class="form-control"  name="guardian_address">{{ $profile->guardian_address}}</textarea>
                                                </div>
                                            </div>
                                        </div>                            
                                        <button type="submit" class="btn btn-success pull-right">Edit <i class="fa fa-save"></i></button>
                                    </form>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="admission">
                                @if(isset($status))
                                  <div class="alert alert-success alert-dismissable" style="margin:20px">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4>  <i class="icon fa fa-check"></i> Success!</h4>
                                      {{ $status}}
                                  </div>
                                @endif
                                <div class="panel-body">
                                    <form method="post" class="profile-wrapper" action="{{ url('admin/editstudent') }}/{{ $profile->id }}" enctype="multipart/form-data">
                                        {{ method_field('PUT') }}
                                        {{ csrf_field() }}
                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fname">Date of Admission</label>
                                                    <input class="form-control" type="date" value="{{ $profile->doa->format('Y-m-d') }}" name="doa" required autofocus>
                                                </div>
                                            </div> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fname">Admission Number</label>
                                                    <input class="form-control" type="text" value="{{ $profile->roll }}" readonly="true" name="roll" required autofocus>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fname">Assign Class</label>
                                                    <select name="class" class="form-control">
                                                      @forelse($classes as $class)
                                                          <option {{ $profile->class == $class->name.$class->form ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}{{ $class->form }}</option>
                                                      @empty
                                                      @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fname">Assign Hostel/House</label>
                                                    <select name="hostel" class="form-control" id="hostel">
                                                      <option value="None">Select Hostel</option>
                                                      @forelse($hostels as $hostel)
                                                          <option @if($profile->hostel==$hostel->code) Selected @endif value="{{ $hostel->code}}">{{ $hostel->name }} ({{ $hostel->category }} {{ $hostel->gender }})</option>
                                                      @empty
                                                      @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                        </div>                            
                                        <button type="submit" class="btn btn-success pull-right">Edit <i class="fa fa-save"></i></button>
                                    </form>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="medicals">
                                @if(isset($status))
                                  <div class="alert alert-success alert-dismissable" style="margin:20px">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4>  <i class="icon fa fa-check"></i> Success!</h4>
                                      {{ $status}}
                                  </div>
                                @endif
                                <div class="panel-body">
                                    <form method="post" class="profile-wrapper" action="{{ url('admin/editstudent') }}/{{ $profile->id }}" enctype="multipart/form-data">
                                        {{ method_field('PUT') }}
                                        {{ csrf_field() }}
                                        <div class="row"> 
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="fname">Blood Group</label>
                                                    <select required="" name="bg" class="form-control dynamic" id="class1" data-dependent="form">
                                                        <option>Select Blood Group</option>
                                                        <option {{ $profile->bg == "A" ? 'selected' : '' }} value="A">A</option>
                                                        <option {{ $profile->bg == "B" ? 'selected' : '' }} value="B">B</option>
                                                        <option {{ $profile->bg == "AB" ? 'selected' : '' }} value="AB">AB</option>
                                                        <option {{ $profile->bg == "O" ? 'selected' : '' }} value="O">O</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="fname">Genotype</label>
                                                    <select name="genotype" class="form-control dynamic" id="class1" data-dependent="form">
                                                        <option>Select Blood Group</option>
                                                        <option {{ $profile->genotype  == "AA" ? 'selected' : '' }} value="AA">AA</option>
                                                        <option {{ $profile->genotype  == "AS" ? 'selected' : '' }} value="AS">AS</option>
                                                        <option {{ $profile->genotype == "SS" ? 'selected' : '' }} value="SS">SS</option>
                                                        <option {{ $profile->genotype == "AC" ? 'selected' : '' }} value="AC">AC</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="fname">Asthmatic ?</label>
                                                    <select name="asthmatic" class="form-control dynamic" id="class1" data-dependent="form">
                                                        <option>Select</option>
                                                        <option {{ $profile->asthmatic  == "Yes" ? 'selected' : '' }} value="Yes">Yes</option>
                                                        <option {{ $profile->asthmatic  == "No" ? 'selected' : '' }} value="No">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="hidden" value="{{ $profile->roll }}" name="roll">  

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="fname">Any Eye Problem ?</label>
                                                    <select name="eye" class="form-control dynamic" id="class1" data-dependent="form">
                                                        <option>Select</option>
                                                        <option {{ $profile->eye  == "Yes" ? 'selected' : '' }} value="Yes">Yes</option>
                                                        <option {{ $profile->eye  == "No" ? 'selected' : '' }} value="No">No</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="fname">If any eye issue, list here</label>
                                                    <textarea rows="1" name="eye_issue" class="form-control dynamic">{{ $profile->eye_issue }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="fname">Disability ?</label>
                                                    <select name="disability" class="form-control dynamic" id="class1" data-dependent="form">
                                                        <option>Select</option>
                                                        <option {{ $profile->disability  == "Yes" ? 'selected' : '' }} value="Yes">Yes</option>
                                                        <option {{ $profile->disability  == "No" ? 'selected' : '' }} value="No">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="fname">If disabled, list here</label>
                                                    <textarea name="disability_issue" class="form-control dynamic" rows="1">{{ $profile->disability_issue }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="fname">Other Medical Record</label>
                                                    <textarea name="other_med" class="form-control dynamic" rows="2">{{ $profile->other_med }}</textarea>
                                                </div>
                                            </div>                                            
                                        </div>                            
                                        <button type="submit" class="btn btn-success pull-right">Edit <i class="fa fa-save"></i></button>                         
                                    </form>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="credential">
                                @if(isset($status))
                                  <div class="alert alert-success alert-dismissable" style="margin:20px">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4>  <i class="icon fa fa-check"></i> Success!</h4>
                                      {{ $status}}
                                  </div>
                                @endif
                                <div class="panel-body">
                                    <form method="post" class="profile-wrapper" action="{{ url('admin/editstudent') }}/{{ $profile->id }}" enctype="multipart/form-data">
                                           {{ method_field('PUT') }}
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <input type="hidden" name="id" value="{{ $profile->id }}">
                                                <input type="hidden" value="{{ $profile->roll }}" name="roll">  
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fname">
                                                            @if($profile->birth_certificate!=NULL)
                                                                <span style="color: blue">You have already uploaded birth certificate before.</span>
                                                                <br> Reupload Birth Certificate?
                                                            @else
                                                                Upload Birth Certificate
                                                            @endif
                                                        </label>
                                                        <input class="form-control" type="file" name="birth_certificate">   
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fname">
                                                            @if($profile->acceptance_form!=NULL)
                                                                <span style="color: blue">You have already uploaded acceptance form before.</span>
                                                                <br> Reupload Accptance Form?
                                                            @else
                                                                Upload Accptance Form
                                                            @endif
                                                        </label>
                                                        <input class="form-control" type="file" name="acceptance_form">   
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fname">
                                                            @if($profile->medical_certificate!=NULL)
                                                                <span style="color: blue">You have already uploaded medical report before.</span>
                                                                <br> Reupload Medical Report?
                                                            @else
                                                                Upload Medical Report
                                                            @endif
                                                        </label>
                                                        <input class="form-control" type="file" name="medical_certificate">   
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fname">
                                                            @if($profile->transfer_certificate!=NULL)
                                                                <span style="color: blue">You have already uploaded Transfer Certificate before.</span>
                                                                <br> Reupload Transfer Certificate?
                                                            @else
                                                                Upload Transfer Certificate
                                                            @endif
                                                        </label>
                                                        <input class="form-control" type="file" name="transfer_certificate">   
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        @if($profile->licence!=NULL)
                                                                <span style="color: blue">You have already uploaded an identity card before.</span>
                                                                <br> Reupload Driver's Licence/Any Identity Card
                                                            @else
                                                                Upload Driver's Licence/Any Identity Card
                                                            @endif
                                                        <input class="form-control" type="file" name="licence">   
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fname">
                                                            @if($profile->fslc!=NULL)
                                                                <span style="color: blue">You have already uploaded First School Certifcate before.</span>
                                                                <br> Reupload First School Certifcate?
                                                            @else
                                                                Upload First School Certifcate
                                                            @endif
                                                        </label>
                                                        <input class="form-control" type="file" name="fslc">   
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        @if($profile->lgi!=NULL)
                                                                <span style="color: blue">You have already uploaded Local Government Identification before.</span>
                                                                <br> Reupload First School Certifcat?
                                                            @else
                                                                Upload Local Government Identification
                                                            @endif
                                                        <label for="fname">Local Government Identification</label>
                                                        <input class="form-control" type="file" name="lgi">   
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fname">Any Other Credential</label>
                                                        <input class="form-control" type="file" name="other_certificate">   
                                                    </div>
                                                </div>
                                            </div>                            
                                            <button type="submit" class="btn btn-success pull-right">Upload <i class="fa fa-save"></i></button>                              
                                    </form>
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
