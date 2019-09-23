@extends('layouts.admin')
@section('pageTitle', 'All Bed Soace')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <span style="font-size:20px">All Bed Spaces</span>  
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
                <table id="example2" class="table table-bordered table-striped m-b-0">
                  <thead>
                    <tr>
                      <th>Hostel</th>
                      <th>Category</th>
                      <th>Gender</th>
                      <th>Bed Number</th>
                      <th>Occupant</th>
                    </tr>
                  </thead>

                  <tbody>
                    @forelse($beds as $bed)
                    <tr>
                        @forelse($hostels as $hostel)
                          @if($hostel->code==$bed->hostel_code)
                            <td>{{ $hostel->name }}</td>
                            <td>{{ $hostel->category }}</td>
                            <td>{{ $hostel->gender }}</td>
                          @endif
                        @empty
                        @endforelse

                        <td>{{ $bed->bed_number }}</td>
                        <td>
                          @forelse($students as $student)
                            @if($bed->occupant == $student->roll)
                              {{ $student->lastname }} {{ $student->firstname }} {{ $student->middlename }} 
                            @endif
                          @empty
                          @endforelse
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
@endsection
