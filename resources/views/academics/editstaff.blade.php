@extends('layouts.admin')
@section('pageTitle', 'Edit Staff')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Edit Profile</h1>
            <small></small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Profile</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
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

                        <form method="post" class="profile-wrapper" action="{{ url('admin/editstaff') }}/{{ $profile->id }}"  enctype="multipart/form-data">
                           {{ method_field('PUT') }}
                            {{ csrf_field() }}
                            <div class="row">                        
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname">First Name</label>
                                        <input class="form-control" type="text" name="firstname" value="{{ $profile->firstname }}" required autofocus>                      
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname">Middle Name</label>
                                        <input class="form-control" value="{{ $profile->middlename }}" type="text" name="middlename" required autofocus>                       
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname">Last Name</label>
                                        <input class="form-control" type="text" name="lastname" value="{{ $profile->lastname }}" required autofocus>                       
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname">Email</label>
                                        <input class="form-control" type="email" value="{{ $profile->email }}" name="email" required autofocus>                       
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname">Phone Number</label>
                                        <input class="form-control" value="{{ $profile->phone }}" type="text" name="phone" required autofocus>                       
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
                                <div class="col-md-3">
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

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input class="form-control" type="date" value="{{ $profile->dob->format('Y-m-d') }}" name="dob" required autofocus>  
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fname">Staff Number</label>
                                        <input class="form-control" type="text" value="{{ $profile->roll }}" readonly="true" name="roll" required autofocus>                       
                                      
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fname">Country</label>
                                        <input class="form-control" type="text" id="fname" value="{{ $profile->country }}" name="country" required autofocus>
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
                                        <textarea class="form-control"  name="current_address" width="840px" height="1000px">{{ $profile->current_address }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="experience" class="control-label"><b>Parmanent Address</b></label>
                                        <textarea class="form-control"  name="parmanent_address" width="840px" height="1000px">{{ $profile->parmanent_address }}</textarea>

                                    </div>
                                </div>

                                <hr>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Choose Category</label>
                                        <select name="category" class="form-control" id="category_id2">
                                          <option {{ $profile->category == "Teaching" ? 'selected' : '' }}  value="Teaching">Teaching</option>
                                          <option {{ $profile->category == "Non-Teaching" ? 'selected' : '' }}  value="Non-Teaching">Non-Teaching</option>

                                        </select>
                                    </div>
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Position/Designation</label>
                                        <input class="form-control" type="text" value="{{ $profile->post }}"  name="post" required autofocus>
                                     </div>
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Salary</label>
                                        <input class="form-control" type="number" value="{{ $profile->salary }}"  name="salary" required>
                                     </div>
                                </div> 

                                <div class="col-md-4">
                                    <div class="form-group">
                                      <label>Grade Level</label>
                                      <select name="level" class="form-control" required>
                                        <option {{ $profile->level == "6" ? 'selected' : '' }} value="6">6</option>
                                        <option {{ $profile->level == "7" ? 'selected' : '' }} value="7">7</option>
                                        <option {{ $profile->level == "8" ? 'selected' : '' }} value="8">8</option>
                                        <option {{ $profile->level == "9" ? 'selected' : '' }} value="9">9</option>
                                        <option {{ $profile->level == "10" ? 'selected' : '' }} ="10">10</option>
                                        <option {{ $profile->level == "11" ? 'selected' : '' }} value="11">11</option>
                                        <option {{ $profile->level == "12" ? 'selected' : '' }} value="12">12</option>
                                        <option {{ $profile->level == "13" ? 'selected' : '' }} value="13">13</option>
                                        <option {{ $profile->level == "14" ? 'selected' : '' }} value="14">14</option>
                                        <option {{ $profile->level == "15" ? 'selected' : '' }} value="15">15</option>
                                        <option {{ $profile->level == "16" ? 'selected' : '' }} value="16">16</option>
                                      </select>
                                    </div>
                                </div> 

                                <hr>

                               <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname">Assign Primary Subject</label>
                                        <select name="subject" class="form-control" id="form">
                                            <option>Select Subject</option>
                                            @forelse($subjects as $subject)
                                            <option {{ $profile->subject == $subject->name ? 'selected' : '' }} value="{{ $subject->name }}">{{ $subject->name }}</option>
                                            @empty
                                            @endforelse 
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname">Recent Degree</label>
                                        <input class="form-control"  value="{{ $profile->last_degree }}" type="text" name="last_degree" required autofocus>                       
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">University Attended</label>
                                        <input class="form-control"  value="{{ $profile->university_attended }}" type="text" name="university_attended" required autofocus>                       
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group input-group image-preview">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                                <span class="glyphicon glyphicon-remove"></span> Clear
                                            </button>
                                            <div class="btn btn-default image-preview-input">
                                                <span class="glyphicon glyphicon-folder-open"></span>
                                                <span class="image-preview-input-title">Click To Upload teacher Photo</span>
                                                <input id="file1" type="file" name="image"/>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>                            
                            <button type="submit" class="btn btn-success pull-right">Save <i class="fa fa-save"></i></button>                              
                        </form>
                    </div> 
                </div> 
            </div>
        </div>     
    </section>
</div>
@endsection
