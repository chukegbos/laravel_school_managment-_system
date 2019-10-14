@extends('layouts.admin')
@section('pageTitle', 'Staff List')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px">All @if(isset($subject)){{$subject}}@endif Teachers</span>  
      @if(!isset($subject))<a class="btn btn-success pull-right" href="#" data-toggle="modal" data-target="#addsalary" >Record Month Salary</a> | @endif 
      <a class="btn btn-primary pull-right" href="{{ url('/admin/addteacher') }}">Add Staff</a>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-bd lobidrag">
            <div class="panel-body">
              @if(isset($status))
                <div class="alert alert-success alert-dismissable" style="margin:20px">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-check"></i> Success!</h4>
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
                      <th>Staff ID</th>
                      <th>Category</th>
                      <th>Designation</th>
                      <th>Grade Level</th>
                      <th>Salary</th>
                      <th>Form Class</th>
                      <th>Subject Taught</th>
                      <th>Class Taught</th>
                      <th>View/Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($teachers as $teacher)
                    <tr>
                      <td>{{ $teacher->lastname}} {{ $teacher->firstname }} {{$teacher->middlename}}</td>
                      <td>{{ $teacher->roll }}</td>
                      <td>{{ $teacher->category }}</td>
                      <td>{{ $teacher->post }}</td>
                      <td>{{ $teacher->level }}</td>
                      <td>{{ $teacher->salary }}</td>
                      <td>
                        @forelse($classes as $class)
                          @if($teacher->lastname.' '.$teacher->firstname.' '.$teacher->middlename==$class->form_teacher)
                            {{$class->name}}{{$class->form}} <a href="{{ url('/admin/students') }}/?class_id={{ $class->id }}">View</a><br>
                          @endif
                        @empty
                        @endforelse
                      </td>
                      <td>{{ $teacher->subject }}</td>
                      <td>
                        @forelse($subjectteachers as $subjectteacher)
                          @if($subjectteacher->roll == $teacher->roll)
                            @forelse($classes as $class)
                              @if($subjectteacher->class==$class->id)
                                {{ $class->name }}{{ $class->form }},<span style="margin-right: 10px"> </span> 
                              @endif
                            @empty
                            @endforelse
                          @endif
                        @empty
                        @endforelse
                      </td>
                      <td>
                        <a href="{{ url('/admin/teacherprofile') }}/?roll={{ $teacher->roll }}">
                        <i class="fa fa-pencil btn btn-warning btn-xs"></i></a> </td>
                      <td>
                        <form action="{{ url('/admin/destroyteacher') }}/{{$teacher->id}}" method="POST">
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


  <div class="modal fade" id="addsalary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog" style="background:white">
          <div class="modal-content" style="">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"> Record Salary</h4>
            </div>
            <div class="modal-body">
              <form method="post" action="{{ url('admin/paysalary') }}" >
                 {{ csrf_field() }}
                  <div class="panel-body">
                    <div class="form-group">
                      <label for="fname">Select Month of Salary</label>
                      <input class="form-control" type="date" name="month" required autofocus>
                    </div> 

                      <ul class="todo-list">
                        <div class="panel-heading">
                          <h4>Select Paid Teachers</h4>
                        </div>
                        @forelse($teachers as $teacher)
                          <!--<input type="hidden" name="track_id"  value="{{ rand(0,20000) }}">-->
                          <li>
                            <div class="checkbox checkbox-success">
                              <input id="todo1{{ $teacher->id }}" type="checkbox" name="paid_to[]" value="{{ $teacher->roll }}">
                              <label for="todo1{{ $teacher->id }}" style="text-decoration: none;">{{ $teacher->lastname }} {{ $teacher->firstname }} {{ $teacher->middlename }} ({{ $teacher->roll }})- N{{ $teacher->salary }}</label>
                            </div>
                          </li>
                        @empty
                      @endforelse
                      </ul>
                  </div>
                  <button type="submit" class="btn btn-success pull-right">Record <i class="fa fa-save"></i></button>                              
              </form>

            </div>
            
            <div class="modal-footer">
             
            </div>
          </div><!-- /.modal-content -->                     
      </div>
  </div>
@endsection
