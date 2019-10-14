@extends('layouts.userpage')
@section('pageTitle', 'Account Analysis')
@section('content')
<!-- Content Wrapper. Contains page content -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <section class="content-header">
  
        <span style="font-size:20px">Account Details</span>  
        <!--<a class="btn btn-primary pull-right" href="{{ url('/admin/addteacher') }}">Add Staff</a>-->
    
     </section>
        <!-- Main content -->
      <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="box box-solid">
             
              <div class="box-header">
                <form class="form-style form-style-2" action="{{ url('/admin/account') }}" method="POST" role="search">
                  {{ csrf_field() }}
                  <div class="row">
                  
                      <div class="col-md-5">
                        <label>Start Date</label>
                        <input  class="form-control" name="start_date" type="date" required>
                      </div>

                      <div class="col-md-5">
                        <label>End Date</label>
                        <input  class="form-control" name="end_date" type="date" required>
                      </div>

                      <div class="col-md-2">
                        <button class="btn btn-success" style="margin-top:25px"> <span>Sort by date</button>
                      </div>
                  </div> 
                </form>
              
              <div class="box-body">
                <div class="row">
                  <div class="col-12">
                    <div class="table-responsive">
                      <table id="example2" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Date Paid</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Income</th>                           
                            <th>Expenditure</th>
                            <th>View</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($accounts as $account)
                          <tr>
                            <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($account->created_at))->toDateString() }}</td>
                            <td>{{ $account->title }}</td>
                            <td>{{ $account->description }}</td>
                            <td>@if($account->type=='Credit') N{{$account->amount}} @else -- @endif</td>
                            <td>@if($account->type=='Debit') N{{$account->amount}} @else -- @endif</td>
                            <td><a href=""><i class="fa fa-pencil btn btn-warning "></i></a> </td>                            
                          </tr>
                          @empty
                          @endforelse
                        </tbody>  
                        <tft>
                          <tr>
                            <th></th>
                            <th></th>
                            <th><b><span class="pull-right">Total</span></b></th>
                            <th><b>N{{$income}}</b></th>                           
                            <th><b>N{{$expenditure}}</b></th>
                          </tr>
                          <tr>
                            <th></th>
                            <th></th>
                            <th><b><span class="pull-right">Balance</span></b></th>
                            <th><b>N{{$balance}}</b></th>                           
                            <th></th>
                          </tr>
                        </tft>                   
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
    <!-- /.content -->

@endsection
