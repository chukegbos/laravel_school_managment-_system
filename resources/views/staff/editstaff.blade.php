@extends('layouts.userpage')
@section('pageTitle', 'Edit Staff')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Profile
      </h1>
    </section>
        <!-- Main content -->
      <!-- Main content -->
    <section class="content">
        @if(isset($status))
          <div class="alert alert-success alert-dismissable" style="margin:20px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4>  <i class="icon fa fa-check"></i> Success!</h4>
              {{ $status}}
          </div>
        @endif
        <div class="row">
          <div class="col-12">
            <div class="box box-solid">
              <div class="box-body">
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
                                <label>Date of Birth</label>
                                <input class="form-control" type="date" value="{{ $profile->dob->format('Y-m-d') }}" name="dob" required autofocus>  
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fname">Staff Number</label>
                                <input class="form-control" type="text" value="{{ $profile->roll }}" readonly="true" name="roll" required autofocus>                       
                              
                            </div>
                        </div>

                        <div class="col-md-4">
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

                         <div class="col-md-4">
                            <div class="form-group">
                                <label for="fname">State</label>
                                <input class="form-control" type="text" id="fname" value="{{ $profile->state }}" name="state" required autofocus>
                                @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fname">LGA</label>
                                <input class="form-control" type="text" id="fname" value="{{ $profile->city }}"  name="city" required autofocus>
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

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Choose Category</label>
                                <select name="category" class="form-control" id="category_id2">
                                  <option {{ $profile->category == "Teaching" ? 'selected' : '' }}  value="Teaching">Teaching</option>
                                  <option {{ $profile->category == "Non-Teaching" ? 'selected' : '' }}  value="Non-Teaching">Non-Teaching</option>

                                </select>
                            </div>
                        </div> 
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Position/Designation</label>
                                <input class="form-control" type="text" id="fname" value="{{ $profile->position }}"  name="position" required autofocus>
                             </div>
                        </div> 
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fname">Assign Class</label>
                                <select name="class" class="form-control dynamic" id="class1" data-dependent="form">
                                  <option>Select Class</option>
                                  @forelse($classes as $class)
                                      <option {{ $profile->class == $class->name ? 'selected' : '' }} value="{{ $class->name}}">{{ $class->name }}</option>
                                  @empty
                                  @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fname">Assign Form</label>
                                <select name="form" class="form-control" id="form">
                                    <option>Select Form</option>
                                    @forelse($forms as $form)
                                    <option {{ $profile->form == $form->form_name ? 'selected' : '' }} value="{{ $form->form_name }}">{{ $form->form_name }}</option>
                                    @empty
                                    @endforelse 
                                </select>
                            </div>
                        </div>
                        <hr>
                        <hr>

                       <div class="col-md-3">
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

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fname">Recent Degree</label>
                                <input class="form-control"  value="{{ $profile->last_degree }}" type="text" name="last_degree" required autofocus>                       
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fname">University Attended</label>
                                <input class="form-control"  value="{{ $profile->university_attended }}" type="text" name="university_attended" required autofocus>                       
                                
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group input-group image-preview">
                                <label for="fname">Upload teacher Photo</label><br>
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
                    <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button>                              
                </form>
              </div> 
            </div> 
          </div>
        </div>     
    </section>
    <!-- /.content -->
  </div>
    <!-- /.content -->
    <script>
        jQuery(document).ready(function($){
            $('#class1').change(function(){
                    $.get("{{ url('/admin/addteacher/fetch')}}", 
                        { option: $(this).val() }, 
                        function(data) {
                            var form = $('#form');
                            form.empty();
         
                            $.each(data, function(index, element) {
                                form.append("<option value='"+ element.id +"'>" + element.name + "</option>");
                            });
                        });
                });
        });
    </script>
@endsection
