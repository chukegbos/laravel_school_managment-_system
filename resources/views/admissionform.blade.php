<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Admission Form | {{ $school->school_name }}</title>

      <!-- Favicon and touch icons -->
      <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
      

      <!-- Bootstrap -->
      <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
      <!-- style css -->
      <link href="assets/dist/css/stylehealth.min.css" rel="stylesheet" type="text/css"/>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
      <style>
          body{
              background:{{ $school->color }};
          }
          .panel-bd > .panel-heading, .alert-success{
            background: {{ $setting->color }}
          }
      </style>
  </head>
  <body>
      <!-- Content Wrapper -->
      <div class="login-wrapper">
          <!--<div class="back-link">
              <a href="{{ url('/') }}" class="btn btn-success">Back to Dashboard</a>
          </div>-->

                        
          <div class="container" style="margin-top: -10px; padding: 20px">
            <div class="col-md-2"></div>
            <div class="col-md-8">
              <div class="panel panel-bd">
                  @if($school->logo!=NULL)
                    <img src="{{ asset('storage') }}/{{ $setting->logo }}" style="height: 100px; display: block; margin-left: auto; margin-right: auto; width: 50%;">
                  @else
                    <img src="{{ asset('assets/img/hsm.png') }}" style="height: 100px; display: block;margin-left: auto; margin-right: auto; width: 50%;">
                  @endif
                  <p style="font-size: 20px; font-weight: bolder; text-align: center">{{ $school->school_name }}</p>
                  <div class="panel-heading">
                    <h3 style="text-align: center;">Student Admission Form</h3>
                  </div>
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
                    <form method="POST" action="{{ url('admission') }}">
                      {{ csrf_field() }}
                      <div class="row">
                        <div class="col-md-12">
                          <p style="font-size: 17px; color: {{ $school->color }}; font-weight: bolder; text-transform: uppercase;">1. Student Information</p>
                        </div>
                        <hr>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label" for="username">First Name</label>
                            <input type="text" required autofocus value="{{ old('firstname') }}" name="firstname" class="form-control">
                            @if ($errors->has('firstname'))
                              <span class="help-block">
                                <strong>{{ $errors->first('firstname') }}</strong>
                              </span>
                            @endif
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label" for="username">Last Name</label>
                            <input type="hidden" value="{{ $admission->form_id }}" name="form_id">
                            <input type="text" required autofocus value="{{ old('lastname') }}" name="lastname" class="form-control">
                            @if ($errors->has('lastname'))
                              <span class="help-block">
                                <strong>{{ $errors->first('lastname') }}</strong>
                              </span>
                            @endif
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label" for="username">Middle Name</label>
                            <input type="text" required autofocus value="{{ old('middlename') }}" name="middlename" class="form-control">
                            @if ($errors->has('middlename'))
                              <span class="help-block">
                                <strong>{{ $errors->first('middlename') }}</strong>
                              </span>
                            @endif
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label" for="username">Application Number</label>
                            <input type="text" readonly="true" value="{{ $application_id }}" name="application_id" class="form-control">
                            <input type="hidden" value="Pending" name="status" class="form-control">
                          </div>
                        </div>


                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label" for="username">Gender</label>
                            <select class="form-control" name="gender" required="">
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label" for="username">Date of Birth</label>
                            <input type="date" required autofocus  name="dob" class="form-control">
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label" for="username">Address</label>
                            <textarea name="address" class="form-control" required=""></textarea>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label" for="username">Name of Present School</label>
                            <input type="text" name="present_school" class="form-control">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label" for="username">Present Class <br> <small>(Current Class of the Student)</small></label>
                            <select class="form-control" name="present_class" required="">
                              <option value="None">None</option>
                              <option value="JSS 1">JSS 1</option>
                              <option value="JSS 2">JSS 2</option>
                              <option value="JSS 3">JSS 3</option>
                              <option value="SSS 1">SSS 1</option>
                              <option value="SSS 2">SSS 2</option>
                              <option value="SSS 3">SSS 3</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label" for="username">Class of Interest <br><small>(The class the child is seeking to be admitted)</small></label>
                            <select class="form-control" name="class_of_interest" required="">
                              <option value="JSS 1">JSS 1</option>
                              <option value="JSS 2">JSS 2</option>
                              <option value="JSS 3">JSS 3</option>
                              <option value="SSS 1">SSS 1</option>
                              <option value="SSS 2">SSS 2</option>
                              <option value="SSS 3">SSS 3</option>
                            </select>
                          </div>
                        </div>
                        

                        <div class="col-md-12">
                          <br><br>
                          <p style="font-size: 17px; color: {{ $school->color }}; font-weight: bolder; text-transform: uppercase;">2. Parent/Guardian Information</p>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label" for="username">Full Name of Parent/Guardian</label>
                            <input type="text" required autofocus value="{{ old('guardian_name') }}" name="guardian_name" class="form-control">
                            @if ($errors->has('guardian_name'))
                              <span class="help-block">
                                <strong>{{ $errors->first('guardian_name') }}</strong>
                              </span>
                            @endif
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label" for="username">Title of Parent/Guardian</label>
                            <select class="form-control" name="guardian_title" required="">
                              <option value="">None</option>
                              <option value="Mr. & Mrs">Mr. & Mrs</option>
                              <option value="Mr.">Mr.</option>
                              <option value="Mrs.">Mrs.</option>
                              <option value="Dr.">Dr.</option>
                              <option value="Prof.">Prof.</option>
                              <option value="Barr.">Barr.</option>
                              <option value="Miss">Miss</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label" for="username">Email</label>
                            <input type="email" name="guardian_email" class="form-control">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label" for="username">Phone Number</label>
                            <input type="tel" name="guardian_phone" required="" class="form-control">
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label" for="username">Parent/Guardian Address</label>
                            <textarea name="guardian_address" class="form-control" required=""></textarea>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label" for="username">Nationality</label>
                            <input type="text" name="nationality" value="Nigeria" readonly="true" class="form-control">
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">State of Origin</label>
                              <select name="state" id="state" class="form-control">
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

                        <div class="col-md-4">
                          <div class="form-group">
                              <label class="control-label">LGA of Origin</label>
                              <select name="lga" id="lga" class="form-control" required>
                              </select>
                          </div>
                        </div>

                        @if($admission->fee!=NULL)
                        <div class="col-md-12">
                          <br><br>
                          <p style="font-size: 13px; color: {{ $school->color }}; font-weight: bolder; text-align: center">PLEASE NOTE: You are required to pay an admission fee of ₦ {{ $admission->fee }} after filling the form</p>
                          <div class="form-group">
                            <input type="checkbox" required=""> <label class="control-label">By ticking this checkbox, you are confirming that you are willing to submit this application</label>
                          </div>
                          
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                          <button class="btn btn-danger" type="reset">Cancel</button>
                          <button class="btn btn-primary" type="submit">Proceed to payment</button>
                        </div>
                        @else
                        <div class="col-md-12">
                          <br><br>
                          <div class="form-group">
                            <input type="checkbox" required=""> <label class="control-label">By ticking this checkbox, you are confirming that you are willing to submit this application</label>
                          </div>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                          <button class="btn btn-danger" type="reset">Cancel</button>
                          <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                        @endif
                      </div>
                    </form>
                  </div>
              </div>
            </div>
          </div>
      </div>
      <!-- /.content-wrapper -->
      <!-- jQuery -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script> 
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
      <!-- <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
      bootstrap js 
      <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>-->
      <script src="assets/dist/js/lga.js" type="text/javascript"></script>
  </body>
</html>