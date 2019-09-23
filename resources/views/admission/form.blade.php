@extends('layouts.admin')
@section('pageTitle', 'Admission Forms')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <span style="font-size:20px">All Form</span>  
    </section>

    <section class="content">
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
              <div class="btn-group"> 
                <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#addmodal" > 
                  <i class="fa fa-plus"></i>Add Admission Form 
                </a>  
              </div>        
            </div>
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
                      <th>Form ID</th>
                      <th>Name</th>
                      <th>Session</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Fee</th>
                      <th>Status</th>
                      <th>Action</th>
                      <th>Delete</th>
                    </tr>
                  </thead>

                  <tbody>
                    @forelse($admissions as $admission)
                    <tr>
                      <td>{{ $admission->form_id }}</td>
                      <td>{{ $admission->form_name }} <br> 
                        @if($admission->Status=="Ongoing")
                          <span class="btn btn-success btn-xs">Ongoing</span>
                        @endif
                      </td>
                      <td>{{ $admission->session }}</td>
                      <td>{{ $admission->start_date->toFormattedDateString()}}</td>
                      <td>{{ $admission->end_date->toFormattedDateString()}}</td>
                      <td>{{ $admission->fee }}</td>
                      <td>{{ $admission->status}}</td>
                      <td><a  href="#" data-toggle="modal" data-target="#addformmodal{{ $admission->id }}">Edit</a> | <a href="{{ url('/admin/applicant') }}/?form_id={{ $admission->form_id }}">View Applicants</a> | <a href="{{ url('/admission') }}/?form_id={{ $admission->form_id }}">View Link</a></td>
                      
                      <td>
                        @if($admission->Status!="Ongoing")
                          <form action="{{ url('/admin/destroyadmission') }}/{{$admission->id}}" method="POST">
                            {{ csrf_field() }}
                            {{ Method_field('DELETE') }}
                             <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                          </form>
                        @endif
                      </td>
                    </tr>
                    <div class="modal fade" id="addformmodal{{ $admission->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                      <div class="modal-dialog" style="background:white">
                          <div class="modal-content" style="width: 900px; float: left;">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title"> Add New Admission Form</h4>
                            </div>
                            <div class="modal-body">
                              <form method="post" class="profile-wrapper" action="{{ url('admin/admissionform') }}" >
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="fname">Name of Form</label>
                                        <input type="text" name="form_name" value="{{ $admission->form_name }}"  required="" class="form-control">
                                        <input type="hidden" name="form_id" value="{{ $admission->form_id }}">
                                      </div>
                                    </div>


                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label>Session</label>
                                        <select class="form-control" name="session" required="">
                                          <option @if($admission->session=="2019/2020") Selected @endif value="2019/2020">2019/2020</option>
                                          <option @if($admission->session=="2020/2021") Selected @endif value="2020/2021">2020/2021</option>
                                          <option @if($admission->session=="2021/2022") Selected @endif value="2021/2022">2021/2022</option>
                                          <option @if($admission->session=="2022/2023") Selected @endif value="2022/2023">2022/2023</option>
                                          <option @if($admission->session=="2023/2024") Selected @endif value="2023/2024">2023/2024</option>
                                          <option @if($admission->session=="2019/2020") Selected @endif value="2024/2025">2024/2025</option>
                                          <option @if($admission->session=="2024/2025") Selected @endif value="2025/2026">2025/2026</option>
                                          <option @if($admission->session=="2026/2027") Selected @endif value="2026/2027">2026/2027</option>
                                          <option @if($admission->session=="2027/2028") Selected @endif value="2027/2028">2027/2028</option>
                                          <option @if($admission->session=="2028/2029") Selected @endif value="2028/2029">2028/2029</option>
                                          <option @if($admission->session=="2029/2020") Selected @endif value="2029/2020">2029/2020</option>
                                        </select>
                                      </div>
                                    </div> 

                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="fname">Admission Fee (Optional)</label>
                                        <input type="text" name="fee" value="{{ $admission->fee }}" class="form-control">
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="fname">Start Date</label>
                                        <input type="date" value="{{ $admission->start_date->format('Y-m-d') }}" name="start_date" required="" class="form-control">
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="fname">Deadline</label>
                                        <input type="date" name="end_date" value="{{ $admission->end_date->format('Y-m-d') }}" required="" class="form-control">
                                      </div>
                                    </div>
                                    <hr>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button> 
                                      </div>
                                    </div>
                                </div>                           
                              </form>
                            </div>
                            
                            <div class="modal-footer">
                             
                            </div>
                          </div><!-- /.modal-content -->                     
                      </div>
                    </div>
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
  <!-- /.content-wrapper -->
  <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog" style="background:white">
          <div class="modal-content" style="width: 900px; float: left;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"> Add New Admission Form</h4>
            </div>
            <div class="modal-body">
              <form method="post" class="profile-wrapper" action="{{ url('admin/admissionform') }}" >
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="fname">Name of Form</label>
                        <input type="text" name="form_name" title="name to be associated with this form" placeholder="Admission form into Jss 1" required="" class="form-control">
                        <input type="hidden" name="school_code" value="{{ $school_code }}">
                        <input type="hidden" name="status" value="Ongoing">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="fname">Form ID</label>
                        <input type="text" name="form_id" value="{{ $form_id }}" readonly="" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Session</label>
                        <select class="form-control" name="session" required="">
                          <option value="2019/2020">2019/2020</option>
                          <option value="2020/2021">2020/2021</option>
                          <option value="2021/2022">2021/2022</option>
                          <option value="2022/2023">2022/2023</option>
                          <option value="2023/2024">2023/2024</option>
                          <option value="2024/2025">2024/2025</option>
                          <option value="2025/2026">2025/2026</option>
                          <option value="2026/2027">2026/2027</option>
                          <option value="2027/2028">2027/2028</option>
                          <option value="2028/2029">2028/2029</option>
                          <option value="2029/2020">2029/2020</option>
                        </select>
                      </div>
                    </div> 

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="fname">Admission Fee (Optional)</label>
                        <input type="text" name="fee" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="fname">Start Date</label>
                        <input type="date" name="start_date" required="" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="fname">Deadline</label>
                        <input type="date" name="end_date" required="" class="form-control">
                      </div>
                    </div>
                    <hr>
                    <div class="col-md-6">
                      <div class="form-group">
                        <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button> 
                      </div>
                    </div>
                </div>                           
              </form>
            </div>
            
            <div class="modal-footer">
             
            </div>
          </div><!-- /.modal-content -->                     
      </div>
  </div>
@endsection
