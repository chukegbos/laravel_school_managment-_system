@extends('layouts.admin')
@section('pageTitle', 'All Students')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px">Add Student </span>
      <a class="btn btn-primary pull-right" href="{{ url('/admin/addstudent') }}">Add Student</a>
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
                      <th>Class</th>
                      <th>Fullname</th>
                      <th>Roll NO</th>                            
                      <th>Gender</th>
                      <th>Age</th>
                      <th>View</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($allstudents as $student)
                    <tr>
                      <td>{{ $student->class }} {{ $student->form }}</td>                            
                      <td>{{ $student->lastname}} {{ $student->firstname }} {{$student->middlename}}</td>
                      <td>{{ $student->roll }}</td>
                      <td>{{ $student->gender }}</td>
                      <td>{{ $student->age }}</td>
                      <td><a href="{{ url('/admin/studentprofile') }}/?roll={{ $student->roll }}"><i class="fa fa-pencil btn btn-warning "></i></a> </td>
                      <td>
                        <form action="{{ url('/admin/destroystudent') }}/{{$student->id}}" method="POST">
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
