@extends('layouts.admin')
@section('pageTitle', 'Add Student')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px; text-align: center;">Add Student </span>
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

                        <form method="post" class="profile-wrapper" action="{{ url('admin/addstudent') }}"  enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div>
                                <p style="color:green; text-align: center; font-size: 25px; text-transform: uppercase;">
                                    <strong>Student Data</strong>
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname">First Name</label>
                                        <input class="form-control" type="text" name="firstname" required autofocus>                     
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
                                        <input class="form-control" type="text" name="middlename" autofocus>                       
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
                                        <input type="hidden" name="school_id" value="{{ $setting->id }}">
                                        <input type="hidden" name="siteini" value="{{ $setting->siteini }}">                 
                                        @if ($errors->has('lastname'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('lastname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select name="gender" class="form-control" id="category_id2">
                                          <option value="Male">Male</option>
                                          <option value="Female">Female</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Religion</label>
                                        <select name="religion" class="form-control" id="category_id2">
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

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="experience" class="control-label"><b>Current Address</b></label>
                                        <textarea class="form-control"  name="current_address" width="840px" height="1000px"></textarea>

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
                                        <textarea class="form-control"  name="parmanent_address" width="840px" height="1000px"></textarea>

                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div>
                                <p style="color:green; text-align: center; font-size: 25px; text-transform: uppercase;">
                                    <strong>Admission Data</strong>
                                </p>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fname">Date of Admission</label>
                                        <input class="form-control" type="date"  name="doa" required autofocus> 
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fname">Admission Number</label>
                                        <input class="form-control" type="text" name="roll" value="{{ $random_number }}" required autofocus>                       
                                        @if ($errors->has('firstname'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('firstname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fname">Assign Class</label>
                                        <select name="class" class="form-control" id="class">
                                          <option>Select Class</option>
                                          @forelse($classes as $class)
                                              <option value="{{ $class->id}}">{{ $class->name }} {{ $class->form }}</option>
                                          @empty
                                          @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fname">Assign Hostel/House</label>
                                        <select name="hostel" class="form-control" id="hostel">
                                          @forelse($hostels as $hostel)
                                              <option value="{{ $hostel->code}}">{{ $hostel->name }} ({{ $hostel->category }} {{ $hostel->gender }})</option>
                                          @empty
                                          @endforelse
                                        </select>
                                    </div>
                                </div>
                                <!--
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname">Assign Bed</label>
                                        <select id="bed" name="bed" class="form-control" required="" >
                                        </select>
                                    </div>
                                </div>-->
                            </div>

                            <br>
                            <div>
                                <p style="color:green; text-align: center; font-size: 25px; text-transform: uppercase;">
                                    <strong>Guardian's Data</strong>
                                </p>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Guardian's Title</label>
                                        <select name="guardian_initial" class="form-control" id="category_id2">
                                          <option value="Mr.">Mr.</option>
                                          <option value="Mrs.">Mrs.</option>
                                          <option value="Miss">Miss</option>
                                          <option value="Prof.">Prof.</option>
                                          <option value="Dr.">Dr.</option>
                                          <option value="Barr.">Barr.</option>
                                          <option value="Other">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname">Guardian Name</label>
                                        <input class="form-control" type="text" name="guardian_name" required autofocus>                       
                                        @if ($errors->has('guardian_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('guardian_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Guardian's Relationship</label>
                                        <select name="guardian_relationship" class="form-control" id="category_id2">
                                          <option value="Father">Father</option>
                                          <option value="Mother">Mother</option>
                                          <option value="Uncle">Uncle</option>
                                          <option value="Aunty">Aunty</option>
                                          <option value="Other">Others</option>
                                        </select>
                                    </div>
                                </div>                       
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname">Guardian Occupation</label>
                                        <input class="form-control" type="text" name="guardian_occupation" >                       
                                        @if ($errors->has('guardian_occupation'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('guardian_occupation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname">Guardian Phone Number</label>
                                        <input class="form-control" type="text" name="guardian_phone" >                       
                                        @if ($errors->has('guardian_phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('guardian_phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname">Guardian Email</label>
                                        <input class="form-control" type="email" name="guardian_email" >                       
                                        @if ($errors->has('guardian_email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('guardian_email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="experience" class="control-label"><b>Guardian Address<span style="color:green"></span></b></label>
                                        <textarea class="form-control"  name="guardian_address"></textarea>

                                    </div>
                                </div>
                            </div>  

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group input-group image-preview">
                                        <label for="fname">Upload Student Photo</label><br><br>
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
                            <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button>                              
                        </form>
                    </div> 
                </div> 
            </div>
        </div>     
    </section>
</div>

<script type="text/javascript" src="https://programmingpot.com/demo/assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="https://programmingpot.com/demo/assets/js/bootstrap.min.js"></script>
        
<script>
    $(document).ready(function() {
        $('#hostel').on('change', function() {
            var hostelID = $(this).val();
            if(hostelID) {
                $.ajax({
                    url: '/admin/getbed/'+hostelID,
                    type: "GET",
                    data : {"_token":"{{ csrf_token() }}"},
                    dataType: "json",
                    success:function(data) {
                        //console.log(data);
                      if(data){
                        $('#bed').empty();
                        $('#bed').append('<option value="">-- Select Bed Space --</option>'); 
                        $.each(data, function(key, value){
                        $('select[name="bed"]').append('<option value="'+ value.id +'">' + value.bed_number+ '</option>');
                    });
                  }else{
                    $('#bed').empty();
                  }
                  }
                });
            }else{
              $('#bed').empty();
            }
        });
    });
</script>
@endsection
