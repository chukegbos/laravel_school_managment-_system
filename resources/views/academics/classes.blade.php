@extends('layouts.admin')
@section('pageTitle', 'All Classes')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px">All @if(isset($mainsubject)) {{ $mainsubject}} @endif Classes </span> 
      @if(!isset($mainsubject))
      <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#addclassmodal" >Add Class</a>
      @endif
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
                      <th>Name</th>
                      <th>Title</th>
                      <th>
                        @if(isset($mainsubject)) 
                          Subject Teacher
                        @else
                          Form Teacher
                        @endif
                      </th>
                      <th>
                        @if(isset($mainsubject)) Subject @else Subject Offered @endif
                      </th>
                      <th>View Students</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($classes as $class)
                    <tr>
                      <td>{{ $class->name }} {{ $class->form }}</td>
                      <td>{{ $class->title }}</td>
                      @if(isset($mainsubject)) 
                        <td>
                          @forelse($teachers as $teacher)
                            @forelse($subjectteachers as $subjectteacher)
                              @if($subjectteacher->roll==$teacher->roll && ($subjectteacher->class==$class->id))
                                {{ $teacher->lastname}} {{ $teacher->firstname }} {{$teacher->middlename}}<br>
                              @else
                              @endif
                            @empty
                            @endforelse
                          @empty
                          @endforelse
                          <a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="#assignmodal{{ $class->id }}" >Re-Assign Teacher</a>
                        </td>

                        <div class="modal fade" id="assignmodal{{ $class->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; height: auto;">
                          <div class="modal-dialog" style="background:white">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                                </div>
                                <div class="modal-body">
                                  <form method="post" class="profile-wrapper" action="{{ url('admin/subject_teacher') }}" >
                                   {{ csrf_field() }}
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="form-group"> 
                                          <label for="fname">Select {{ $mainsubject }} Teacher</label>
                                          <input type="hidden" name="class" value="{{ $class->id }}">
                                          <input type="hidden" name="subject" value="{{$mainsubject}}">
                                          <select name="roll" class="form-control" required="">
                                            @forelse($teachers as $teacher)
                                              <option value="{{ $teacher->roll}}">
                                                {{ $teacher->lastname}} {{ $teacher->firstname }} {{$teacher->middlename}}
                                              </option>
                                            @empty
                                            @endforelse 
                                          </select>
                                        </div>
                                      </div>

                                      <div class="col-md-4"></div>
                                      <div class="col-md-4">
                                        <button type="submit" class="btn btn-success">Assign</button> 
                                      </div>
                                    </div> 
                                                                 
                                  </form>
                                </div>
                              </div><!-- /.modal-content -->                     
                          </div>
                        </div>
                      @else
                        <td>
                          @if(isset($class->form_teacher))
                            {{$class->form_teacher}}<br>
                            <a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="#assignmodal{{ $class->id }}" >Re-Assign Teacher</a>
                          @else
                          <a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="#assignmodal{{ $class->id }}" >Assign Teacher</a>
                          @endif
                        </td>

                        <div class="modal fade" id="assignmodal{{ $class->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; height: auto;">
                          <div class="modal-dialog" style="background:white">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                                </div>
                                <div class="modal-body">
                                  <form method="post" class="profile-wrapper" action="{{ url('admin/form_teacher') }}" >
                                   {{ csrf_field() }}
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="form-group"> 
                                          <label for="fname">Select Form Teacher</label>
                                          <input type="hidden" name="id" value="{{ $class->id }}">
                                          <select name="form_teacher" class="form-control" required="">
                                            @forelse($teachers as $teacher)
                                              <option value="{{ $teacher->roll}}">
                                                {{ $teacher->lastname}} {{ $teacher->firstname }} {{$teacher->middlename}}
                                              </option>
                                            @empty
                                            @endforelse 
                                          </select>
                                        </div>
                                      </div>

                                      <div class="col-md-4"></div>
                                      <div class="col-md-4">
                                        <button type="submit" class="btn btn-success">Assign</button> 
                                      </div>
                                    </div> 
                                                                 
                                  </form>
                                </div>
                              </div><!-- /.modal-content -->                     
                          </div>
                        </div>
                      @endif

                      <td>
                        @if(isset($mainsubject)) 
                          {{ $mainsubject }}
                        @else
                          {{ $class->subject_offered }}<br>
                          <a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="#subjectmodal{{ $class->id }}" >Add Subject</a>
                        @endif
                      </td>
                      







                      <div class="modal fade" id="subjectmodal{{ $class->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; height: auto;">
                        <div class="modal-dialog" style="background:white">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <div>
                                <h4 class="modal-title"> Register Subjects</h4>
                              </div>
                              <div><br><br>
                                <p>Always remember to choose all the subjects offered</p>
                              </div>
                            </div>
                            <form method="post" class="profile-wrapper" action="{{ url('admin/registersubject') }}" >
                              <div class="modal-body"> 
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $class->id }}">
                                <div class="form-group">
                                 
                                  @forelse($subjects as $subject)
                                    <div class="c-inputs-stacked">
                                      @if(in_array($subject->name, explode(",",$class->subject_offered) )) 
                                        <input type="checkbox" id="checkbox_{{ $subject->id}}" checked="" name="subject_offered[]" value="{{ $subject->name}}"/>
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
                              </div>
                            
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Add 
                                  <i class="fa fa-save"></i>
                                </button> 
                              </div>
                            </form>
                          </div><!-- /.modal-content -->                     
                        </div>
                      </div>
                      <td>
                        {{ $class->number_of_student }}
                        <a href="{{ url('/admin/students') }}/?class_id={{ $class->id }}"><i class="fa fa-pencil btn btn-warning "> View all</i>
                        </a> 
                      </td>

                     <td>
                        <form action="{{ url('/admin/destroyclass') }}/{{$class->id}}" method="POST">
                          {{ csrf_field() }}
                          {{ Method_field('DELETE') }}
                           <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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
  </div>
  <div class="modal fade" id="addclassmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog" style="background:white">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"> Add Class</h4>
            </div>
            <div class="modal-body">
              <form method="post" class="profile-wrapper" action="{{ url('admin/classes') }}" >
                 {{ csrf_field() }}
                  
                  <div class="form-group">
                      <label for="fname">Class Level</label>
                      <select name="name" class="form-control dynamic" id="class1" data-dependent="form">
                          <option value="AC">Activity class</option>
                          <option value="PNC">Pre-Nursery</option>
                          <option value="NC 1">Nursery 1</option>
                          <option value="NC 2">Nursery 2</option>
                          <option value="NC 3">Nursery 3</option>
                          <option value="P 1">Primary 1</option>
                          <option value="P 2">Primary 2</option>
                          <option value="P 3">Primary 3</option>
                          <option value="P 4">Primary 4</option>
                          <option value="P 5">Primary 5</option>
                          <option value="P 6">Primary 6</option>

                          <option value="JSS 1">JSS 1</option>
                          <option value="JSS 2">JSS 2</option>
                          <option value="JSS 3">JSS 3</option>
                          <option value="SSS 1">SSS 1</option>
                          <option value="SSS 2">SSS 2</option>
                          <option value="SSS 3">SSS 3</option>
                      </select>
                      <input type="hidden" name="school_code" value="{{ $setting->school_code }}">
                  </div>

                  <div class="form-group">
                      <label for="fname">Class Form</label>
                     
                      <input class="form-control" type="text" name="form" placeholder="A" required autofocus>
                      @if ($errors->has('form'))
                          <span class="help-block">
                              <strong>{{ $errors->first('form') }}</strong>
                          </span>
                      @endif
                  </div>                        

                  <div class="form-group">
                      <label for="fname">Class Title</label>
                     
                      <input class="form-control" type="text" name="title" placeholder="Eg. Junior Secondary School 1" required autofocus>
                      @if ($errors->has('title'))
                          <span class="help-block">
                              <strong>{{ $errors->first('title') }}</strong>
                          </span>
                      @endif
                  </div> 
                  <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button>                              
              </form>
            </div>
            
            <div class="modal-footer">
             
            </div>
          </div>                
      </div>
  </div>
@endsection
