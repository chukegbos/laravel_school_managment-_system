@extends('layouts.admin')
@section('pageTitle', 'Staff List')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px">All @if(isset($subject)){{$subject}}@endif Teachers</span>  
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
@endsection
