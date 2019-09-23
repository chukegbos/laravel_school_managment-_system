@extends('layouts.userpage')
@section('pageTitle', 'Manage Subjects')
@section('content')
<!-- Content Wrapper. Contains page content -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <span>{{ ucfirst($name) }} Department Staff </span> 
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
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>Lastname</th>
                          <th>Firstname</th>
                          <th>Middlename</th>
                          <th>Subject Class</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($teachers as $teacher)
                        <tr>
                          <td>{{ $teacher->lastname }}</td>
                          <td>{{ $teacher->firstname }}</td>
                          <td>{{ $teacher->middlename }}</td>
                          <th>{{ $teacher->subject_class }} 
                            <a href="{{ url('/admin/assignclass1') }}/?id={{ $teacher->id}}&subject={{$name}}" class="btn btn-primary"> View Assigned Class</a>                         
                            <a href="{{ url('/admin/assignclass') }}/?id={{ $teacher->id}}&subject={{$name}}" class="btn btn-info">Assign Class</a>
                          
                          </th>
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
