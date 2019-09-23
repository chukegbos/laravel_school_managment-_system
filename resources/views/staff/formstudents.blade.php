@extends('layouts.admin')
@section('pageTitle', 'All Students')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px">Students of {{ $class }} {{ $formname }} </span>
      <a class="btn btn-warning btn-xs pull-right"  href="#" data-toggle="modal" data-target="#resultmodal"> View Scores</a>
      <a class="btn btn-primary btn-xs pull-right"  href="#" data-toggle="modal" data-target="#registersubjectmodal">View Subjects</a>
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

              <div class="table-responsive">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      
                      <th>Fullname</th>                          
                      <th>Roll Number</th>
                      <!--<th>Register Subject</th>-->
                      <th>Profile</th>
                      <th>Result</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($students as $student)
                    <tr>
                      
                      <td>{{ $student->lastname}} {{ $student->firstname }} {{ $student->middlename}}</td>
                      <td>{{ $student->roll }}</td>
                      <!--<td>
                        <div class="row">
                          <div class="col-md-9">
                            {{ $student->subject_offered }}
                          </div>
                          <div class="col-md-3">   
                          @if(isset($subjects))
                            <a class="open-SubjectDialog btn btn-info pull-right"
                                href="#" 
                                data-toggle="modal" 
                                data-target="#registerstudentsubjectmodal" 
                                data-roll="{{$student->roll}}"
                                data-firstname="{{$student->firstname}}"
                                data-lastname="{{$student->lastname}}"
                                data-middlename="{{$student->middlename}}">Register                                 
                            </a>
                          @endif
                          </div>
                        </div>
                      </td>-->
                      <td>
                        <a class="btn btn-info btn-xs" href="{{ url('/admin/studentprofile') }}/?roll={{$student->roll}}">View</a> 
                      </td>
                      <td>
                        <form action="{{ url('/admin/viewresult') }}" method="POST">
                          {{ csrf_field() }}
                          <input type="hidden" name="roll" value="{{ $student->roll }}">
                          <input type="hidden" name="session" value="{{ $session->id }}">
                          <input type="hidden" name="term" value="{{ $setting->current_term }}">
                          <button class="btn btn-success btn-xs">View</button>
                        </form>
                      </td>
                     
                    </tr>
                    @empty
                    @endforelse
                  </tbody>                     
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>        
    </section>
    <!-- /.content -->
  </div>
  
  <div class="modal fade" id="registersubjectmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="background:white">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"> Register subjects for the students</h4>
          </div>
          <div class="modal-body">
            <form method="post" class="profile-wrapper" action="{{ url('admin/registersubject') }}" >
              {{ csrf_field() }}

              <input type="hidden" value="{{ $form->id}}" name="id">

              <input type="hidden" name="school_id" value="{{ $setting->id }}">
              <div class="form-group">
                @forelse($subjects as $subject)
                  <div class="c-inputs-stacked">
                    @if(in_array($subject->name, $exploded)) 
                      <input type="checkbox" id="checkbox_{{ $subject->id}}" name="subject_offered[]" checked value="{{ $subject->name}}"/>
                      <label for="checkbox_{{ $subject->id}}" class="block">{{ $subject->name }}</label> 
                    @else
                      <input type="checkbox" id="checkbox_{{ $subject->id}}" name="subject_offered[]" value="{{ $subject->name}}"/>
                      <label for="checkbox_{{ $subject->id}}" class="block">{{ $subject->name }}</label> 
                    @endif
                  </div>
                @empty
                  No Subject Found.
                @endforelse
              </div>                    
              <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button>                              
            </form>
          </div>
          
          <div class="modal-footer">
           
          </div>
        </div><!-- /.modal-content -->                     
    </div>
  </div>

  <div class="modal fade" id="resultmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog" style="background:white">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"> Pick Subject</h4>
            </div>
            <div class="modal-body">

              <form method="post" class="profile-wrapper" action="{{ url('admin/addresult')}}">
                {{ csrf_field() }}
                <input type="hidden" value="{{ $form->id}}" name="class">
                <input type="hidden" value="{{ $session->id}}" name="session">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="fname">Select Subject</label>
                    <select name="subject" class="form-control" required="">
                      @for ($i = 0; $i < $length; $i++)
                        @forelse($subjects as $subject)
                          @if($subject->name==$exploded[$i])
                            <option value="{{ $subject->id }}">{{ $exploded[$i]  }}</option>
                          @endif
                        @empty
                        @endforelse
                      @endfor
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="fname">Select Term</label>
                    <select name="term" class="form-control" required="">
                        <option value="First Term">First Term</option>
                        <option value="Second Term">Second Term</option>
                        <option value="Third Term">Third Term</option>
                        <option value="Annual">Annual</option>
                    </select>
                  </div>
                </div>

                <button type="submit" class="btn btn-success pull-right">Select <i class="fa fa-save"></i></button>                              
              </form>

            </div>
            
            <div class="modal-footer">
             
            </div>
          </div><!-- /.modal-content -->                     
      </div>
  </div>

  <script>
    $(document).on("click", ".open-SubjectDialog", function () {
         var mainRoll = $(this).data('roll');
         var mainFirstname = $(this).data('firstname');
         var mainLastname = $(this).data('lastname');
         var mainMiddlename = $(this).data('middlename');

         $(".modal-body #mainroll").val( mainRoll );
         $(".modal-body #mainfirstname ").val( mainFirstname );
         $(".modal-body #mainlastname ").val( mainLastname );
         $(".modal-body #mainmiddlename ").val( mainMiddlename );
        $('#registerstudentsubjectmodal').modal('show');
    });
  </script>

  <div class="modal fade" id="registerstudentsubjectmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="background:white">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"> Register subjects for the students</h4>
          </div>
          <div class="modal-body">
            <form method="post" class="profile-wrapper" action="{{ url('staff/studentsubject') }}" >
                <input type="hidden" name="school_id" value="{{ $setting->id }}">
                <input type="hidden" name="siteini" value="{{ $setting->siteini }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="hidden" readonly="true" class="form-control" name="roll" id="mainroll">
                    <input type="text" readonly="true" class="form-control" name="name" id="mainlastname">
                 </div>

                <div class="form-group">
                    
                      @for ($i = 0; $i < $length; $i++)
                        <div class="c-inputs-stacked">
                           <input type="checkbox" id="checkbox_{{ $exploded[$i] }}" name="subject_offered[]" value="{{ $exploded[$i] }}"/>
                           <label for="checkbox_{{ $exploded[$i] }}" class="block">{{ $exploded[$i]  }}</label>
                        </div>   
                      @endfor
                </div>                    
                <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button>                              
            </form>
          </div>
          
          <div class="modal-footer">
           
          </div>
        </div><!-- /.modal-content -->                     
    </div>
  </div>
@endsection
