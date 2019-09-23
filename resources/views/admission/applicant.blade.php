@extends('layouts.admin')
@section('pageTitle', 'Applicants')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <span style="font-size:20px">All Applicants</span>  
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
                      <th>Name</th>
                      <th>Application ID</th>
                      <th>Gender</th>
                      <th>DOB</th>
                      <!--<th>Address</th>
                      <th>Present School</th>
                      <th>Present Class</th>
                      <th>Class of Interest</th>-->
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    @forelse($applicants as $applicant)
                    <tr>
                      <td>{{ $applicant->lastname }} {{ $applicant->firstname }} {{ $applicant->middlename }}
                      </td>
                      <td>{{ $applicant->application_id }}</td>
                      <td>{{ $applicant->gender }}</td>
                      <td>{{ $applicant->dob->toFormattedDateString() }}</td>
                      <!--<td>{{ $applicant->address }}</td>
                      <td>{{ $applicant->present_school }}</td>
                      <td>{{ $applicant->present_class }}</td>
                      <td>{{ $applicant->class_of_interest }}</td>-->

                      <td>{{ $applicant->status}}</td>

                      <td>
                        <a href="{{ url('admin/applicantprofile') }}/?id={{ $applicant->id }}">View Applicant</a> |
                        <a href="{{ url('admin/condition') }}/?condition=Admitted&id={{ $applicant->id }}">Accept</a> |
                        <a href="{{ url('admin/condition') }}/?condition=Rejected&id={{ $applicant->id }}">Reject</a>
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
