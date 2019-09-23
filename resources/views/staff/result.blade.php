@extends('layouts.userpage')
@section('pageTitle', 'Results' )
@section('content')
<!-- Content Wrapper. Contains page content -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
 

    <section class="content printableArea">
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
              <div class="box-header" style="text-align:center">
                  <h3 style="color:green; font-size:25px; font-weigh:bolder">{{ $session }} - {{ $term }} {{ $subject }} Result</h3>
                  <h3 style="color:green; font-size:20px; font-weigh:bolder">{{ $class}} {{ $form }} </h3>
                  <div class="no-print">  
                    <button id="print" class="btn btn-warning pull-left" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                  </div>
              </div>
              
              <div class="box-body">
                <div class="row">
                  <div class="col-12">
                    <div class="table-responsive">
                     <table id="example2" class="table table-bordered table-hover">
                        <thead>
                          <tr>  
                            <th>Fullname</th>
                            <th>Roll NO</th>
                            <th>1st Assessment <span style="color:green">({{ $standard->test1 }}%)</span></th>
                            <th>2nd Assessment  <span style="color:green">({{ $standard->test2 }}%)</span></th>
                            <th>Exam  <span style="color:green">({{ $standard->exam }}%)</span></th>
                            <th>Total  <span style="color:green">(100%)</span></th>
                            <th>Grade</th>
                            <th style="display: none" >Position</th> 
                            <th>Teacher's Comment</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($results as $key => $result)
                          <tr>
                            <td>{{ $result->lastname }} {{ $result->firstname }} {{ $result->middlename }}</td>
                            <td>{{ $result->roll }}</td>
                            <td>{{ $result->first_test }}</td>
                            <td>{{ $result->second_test }} </td> 
                            <td>{{ $result->exam }} </td>
                            <td>{{ $result->total }}</td>
                            <td>{{ $result->grade }} </td>
                            <td style="display: none" >{{ ($key+1) }}</td>
                            <td>{{ $result->comment }}</td>
                          </tr>
                          @empty
                              <p style="text-align:center; color:#465161">Yet to upload result by the subject teacher</p>
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
