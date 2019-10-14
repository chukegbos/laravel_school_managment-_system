@extends('layouts.admin')
@section('pageTitle', 'School Fees Report')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px">School Fees Report @if(isset($term)) History @endif</span>
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
                      <th>Session</th>
                      <th>Term</th>
                      <th>Class</th>
                      <th>Fullname</th>
                      <th>Amount</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($allstudents as $student)
                    <tr>
                      <td>{{$student->session}}</td> 
                      <td>{{$student->term}}</td>                            
                      <td>{{$student->class}}</td> 
                      <td>
                        @forelse($paidstudent as $paid)
                          @if($paid->roll==$student->payee)
                            {{ $paid->lastname}} {{ $paid->firstname }} {{$paid->middlename}}
                          @endif
                        @empty
                        @endforelse
                      </td>
                      <td>{{ $student->amount }}</td>
                      <td>
                        @if($student->status==NULL)
                          <span style="color: red">Not Paid</span>
                          @if(!isset($term))
                            <a class="pull-right"  href="#" data-toggle="modal" data-target="#paidmodal{{ $student->id }}">Mark As Paid</a> <!--| <a href="">Generate Invoice</a>-->
                            <div class="modal fade" id="paidmodal{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; height: auto;">
                              <div class="modal-dialog" style="background:white">
                                <div class="modal-content">
                                  <div class="modal-body" style="padding: 10px; text-align: center">
                                    <h4>By marking this student as paid, you will not be able to reverse it. </h4><br>
                                    <p style="color: red; font-weight: bolder;">Are you sure you want to proceed?</p>
                                      
                                    <button type="button" class="btn btn-info" data-dismiss="modal" aria-label="Close">No</button> 
                                    <a href="{{ url('/admin/markfee') }}/?id={{ $student->id }}" class="btn btn-danger">Yes</a>
                                  </div>
                                </div><!-- /.modal-content -->                     
                              </div>
                            </div>
                          @endif
                        @else
                          <span style="color: green">Paid</span>
                          <!--<br><a href="">Print Reciept</a>-->
                        @endif
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
