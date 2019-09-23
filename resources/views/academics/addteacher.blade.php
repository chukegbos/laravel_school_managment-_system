@extends('layouts.admin')
@section('pageTitle', 'Add Staff')
@section('content')
<style type="text/css">
  .select2-container .select2-selection--single{
    height: 35px
  }
</style>
<div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px">Add Staff </span>
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

                      <form method="post" class="profile-wrapper" action="{{ url('admin/addteacher') }}"  enctype="multipart/form-data">
                       {{ csrf_field() }}
                        <div class="row">                        
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="fname">First Name</label>
                              <input class="form-control" type="text" name="firstname" required autofocus> 
                              <input type="hidden" name="school_code" value="{{ $setting->school_code }}">
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
                              <input class="form-control" type="text" name="middlename" required autofocus>
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
                                <input class="form-control" type="text" name="lastname" required autofocus>                       
                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                <label for="fname">Email</label>
                                <input class="form-control" type="email" name="email" required autofocus>                       
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label for="fname">password</label>
                                  <input class="form-control" type="password" name="password" required autofocus>                       
                                  @if ($errors->has('password'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('password') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label for="fname">Phone Number</label>
                                  <input class="form-control" type="text" name="phone" required autofocus>                       
                                  @if ($errors->has('phone'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('phone') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label>Gender</label>
                                  <select name="gender" class="form-control"  required id="category_id2">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label>Religion</label>
                                  <select name="religion" class="form-control"  required id="category_id2">
                                    <option value="Christianity">Christianity</option>
                                    <option value="Muslim">Muslim</option>
                                    <option value="African Tradition">African Tradition</option>
                                    <option value="Others">Others</option>
                                  </select>
                              </div>
                          </div>

                          <div class="col-md-3">
                              <div class="form-group">
                                  <label>Date of Birth</label>
                                  <input class="form-control" type="date" name="dob" required autofocus>  
                              </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Country</label>
                              <input class="form-control" type="text" value="Nigeria" name="country" readonly="true">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label>State of Origin</label>
                              <select style="height: 35px" name="state" id="state" class="form-control" required="">
                                <option value="" selected="selected" >- Select -</option>
                                <option value='Abia'>Abia</option>
                                <option value='Adamawa'>Adamawa</option>
                                <option value='AkwaIbom'>AkwaIbom</option>
                                <option value='Anambra'>Anambra</option>
                                <option value='Bauchi'>Bauchi</option>
                                <option value='Bayelsa'>Bayelsa</option>
                                <option value='Benue'>Benue</option>
                                <option value='Borno'>Borno</option>
                                <option value='Cross River'>Cross River</option>
                                <option value='Delta'>Delta</option>
                                <option value='Ebonyi'>Ebonyi</option>
                                <option value='Edo'>Edo</option>
                                <option value='Ekiti'>Ekiti</option>
                                <option value='Enugu'>Enugu</option>
                                <option value='FCT'>FCT</option>
                                <option value='Gombe'>Gombe</option>
                                <option value='Imo'>Imo</option>
                                <option value='Jigawa'>Jigawa</option>
                                <option value='Kaduna'>Kaduna</option>
                                <option value='Kano'>Kano</option>
                                <option value='Katsina'>Katsina</option>
                                <option value='Kebbi'>Kebbi</option>
                                <option value='Kogi'>Kogi</option>
                                <option value='Kwara'>Kwara</option>
                                <option value='Lagos'>Lagos</option>
                                <option value='Nasarawa'>Nasarawa</option>
                                <option value='Niger'>Niger</option>
                                <option value='Ogun'>Ogun</option>
                                <option value='Ondo'>Ondo</option>
                                <option value='Osun'>Osun</option>
                                <option value='Oyo'>Oyo</option>
                                <option value='Plateau'>Plateau</option>
                                <option value='Rivers'>Rivers</option>
                                <option value='Sokoto'>Sokoto</option>
                                <option value='Taraba'>Taraba</option>
                                <option value='Yobe'>Yobe</option>
                                <option value='Zamfara'>Zamafara</option>
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

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="experience" class="control-label"><b>Current Address</b></label>
                              <textarea class="form-control" required  name="current_address" col="10" required=""></textarea>

                              @if ($errors->has('address'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('address') }}</strong>
                                  </span>
                              @endif
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"><b>Parmanent Address</b></label>
                              <textarea class="form-control"  name="parmanent_address"  required cols="10"></textarea>
                            </div>
                          </div>

                          <hr>

                          <div class="col-md-4">
                              <div class="form-group">
                                  <label>Choose Category</label>
                                  <select name="category" class="form-control" id="category_id2" required>
                                      <option value="Teaching">Teaching</option>
                                      <option value="Non-Teaching">Non-Teaching</option>
                                  </select>
                              </div>
                          </div> 
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label for="fname">Registation Number</label>
                                  <input class="form-control" value="{{ rand(0,12222000) }}" type="text" name="roll" required autofocus>                       
                                  @if ($errors->has('firstname'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('firstname') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>
                          <!--
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="fname">Assign Form Class</label>
                                  <select name="class" class="form-control">
                                    <option>Select Class</option>
                                    @forelse($classes as $class)
                                        <option value="{{ $class->name}}">{{ $class->name }}</option>
                                    @empty
                                    @endforelse
                                  </select>
                              </div>
                          </div>
                          -->
                          <hr>
                          <hr>

                           <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fname">Assign Subject</label>
                                    <select name="subject" class="form-control" id="form">
                                        <option>Select Subject</option>
                                        @forelse($subjects as $subject)
                                        <option value="{{ $subject->name }}">{{ $subject->name }}</option>
                                        @empty
                                        @endforelse 
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fname">Recent Degree</label>
                                    <input class="form-control" type="text" name="last_degree" required autofocus>                       
                                    @if ($errors->has('last_degree'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('last_degree') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fname">University Attended</label>
                                    <input class="form-control" type="text" name="university_attended" required autofocus>                       
                                    @if ($errors->has('university_attended'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('university_attended') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group input-group image-preview">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                            <span class="glyphicon glyphicon-remove"></span> Clear
                                        </button>
                                        <div class="btn btn-default image-preview-input">
                                            <span class="glyphicon glyphicon-folder-open"></span>
                                            <span class="image-preview-input-title">Click To upload teacher Photo</span>
                                            <input id="file1" type="file" name="image"/>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>                            
                        <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button>                              
                        </form>
                    </div> 
                </div> 
            </div>
        </div>     
    </section>
</div>

@endsection
