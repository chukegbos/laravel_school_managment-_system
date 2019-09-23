@extends('layouts.userpage')
@section('pageTitle', 'Students' )
@section('content')
<!-- Content Wrapper. Contains page content -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        All Students
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

        @if(isset($error))
          <div class="alert alert-danger alert-dismissable" style="margin:20px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4>  <i class="icon fa fa-times"></i> Error!</h4>
              {{ $error}}
          </div>
        @endif
        <div class="row">
          <div class="col-12">
            <div class="box box-solid">
              <div class="box-body">
                <div class="row">
                  <div class="col-12">
                    <div class="table-responsive">
                      <table id="mainTable" class="table editable-table table-bordered table-striped m-b-0">
                        <thead>
                          <tr>
                            <th>Roll NO</th>
                            <th>Surname</th>
                            <th>Firsname</th>
                            <th>Middlename</th>
                            <th>Edit</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($students as $student)
                          <tr>
                            <td>{{ $student->roll }}</td>
                            <td>{{ $student->lastname }} </td> 
                            <td>{{ $student->firstname }} </td>
                            <td>{{ $student->middlename }}</td>
                            <td><a href="{{ url('/admin/studentprofile') }}/?roll={{$student->roll}}&firstname={{ $student->firstname }}&lastname={{ $student->lastname }}&middlename={{ $student->middlename }}"><i class="fa fa-pencil btn btn-warning "></i></a> </td>
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
          </div>
        </div>        
    </section>
    <!-- /.content -->
  </div>
@endsection
