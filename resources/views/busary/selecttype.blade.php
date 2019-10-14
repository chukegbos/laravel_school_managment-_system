@extends('layouts.admin')
@section('pageTitle', 'Add Payment')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px">Add Payment</span>  
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

              @if($cat=='Credit')
                @if($type=='Others')
                  <form method="post" action="{{ url('admin/storepayment') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="fname">Type of Payment</label>
                          <input class="form-control" type="text" name="title" value="{{ $type }}" readonly="True" autofocus> 
                          <input type="hidden" value="{{ $cat }}" name="type"  required autofocus>                     
                          <input type="hidden" value="{{ $track_id }}" name="track_id"  required autofocus> 
                          <input type="hidden" value="{{ Auth::user()->name }}" name="adminname"  required autofocus> 
                          <input type="hidden" value="{{ Auth::user()->email }}" name="adminemail"  required autofocus> 
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="fname">Amount Paid</label>
                          <input class="form-control" type="number" name="amount" required autofocus> 
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="fname">Payee</label>
                          <input class="form-control" type="text" name="payee" required autofocus>
                        </div> 
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="fname">Teller ID</label>
                          <input class="form-control" type="text" name="teller_id" required autofocus>
                        </div> 
                      </div>

                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="experience" class="control-label"><b>Short Description of Payment</b></label>
                          <textarea class="form-control"  name="description">2018/2019 Third term school fees payement of ..... </textarea>
                        </div>
                      </div>
                    </div>                            
                    <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button>                              
                  </form>
                @else
                  <form method="post" action="{{ url('admin/storepayment') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="fname">Type of Payment</label>
                          <input type="hidden" value="{{ $track_id }}" name="track_id"  required autofocus> 
                          <input class="form-control" type="text" name="title" value="{{ $type }}" readonly="True" autofocus> 
                          <input type="hidden" value="{{ $cat }}" name="type"  required autofocus>                     
                          <input type="hidden" value="{{ Auth::user()->name }}" name="adminname"  required autofocus> 
                          <input type="hidden" value="{{ Auth::user()->email }}" name="adminemail"  required autofocus> 
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="fname">Amount Paid</label>
                          <input class="form-control" type="number" name="amount" required autofocus> 
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="fname">Payee</label>
                          <input class="form-control" type="text" name="payee" required autofocus>
                        </div> 
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="fname">Teller ID</label>
                          <input class="form-control" type="text" name="teller_id" required autofocus>
                        </div> 
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="fname">Student's Name</label>
                          <input class="form-control" type="text" name="student_name" required autofocus>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="fname">Student Roll Number</label>
                          <input class="form-control" type="text" name="student_roll" required autofocus>                       
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="fname">Session Paid For</label>
                          <select name="session" class="form-control">
                            <option>Select Session</option>
                            @forelse($sessions as $sessionss)
                              <option value="{{ $sessionss->name }}">{{ $sessionss->name }}</option>
                            @empty
                            @endforelse
                          </select>
                        </div>                 
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="fname">Term Paid For</label>
                          <select name="term" class="form-control dynamic">
                            <option>Select Term</option>
                            <option value="First Term">First Term</option>
                            <option value="Second Term">Second Term</option>
                            <option value="Third Term">Third Term</option>
                          </select>
                        </div> 
                      </div>

                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="experience" class="control-label"><b>Short Description of Payment</b></label>
                          <textarea class="form-control" name="description">2018/2019 Third term school fees payement of ..... </textarea>
                        </div>
                      </div>
                    </div>                            
                    <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button>                              
                  </form>
                @endif
              @else
                @if($type=='Others')
                  <form method="post" action="{{ url('admin/storepayment') }}"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">                        
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="fname">Type of Payment</label>
                          <input type="hidden" value="{{ $track_id }}" name="track_id"  required autofocus> 
                          <input class="form-control" type="text" name="title" value="{{ $type }}" readonly="True" autofocus> 
                          <input type="hidden" value="{{ $cat }}" name="type"  required autofocus>                     
                          <input type="hidden" value="{{ Auth::user()->name }}" name="adminname"  required autofocus> 
                          <input type="hidden" value="{{ Auth::user()->email }}" name="adminemail"  required autofocus> 
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="fname">Amount Paid</label>
                          <input class="form-control" type="number" name="amount" required autofocus> 
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="fname">Paid To</label>
                          <input class="form-control" type="text" name="paid_to" required autofocus>
                        </div> 
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="experience" class="control-label"><b>Short Description of Payment</b></label>
                          <textarea class="form-control"  name="description">Payment for the collection of... </textarea>
                        </div>
                      </div>
                    </div>  

                    <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button>
                  </form>
                @else
                  <form method="post" action="{{ url('admin/storepayment') }}"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="fname">Type of Payment</label>
                          <input type="hidden" value="{{ $track_id }}" name="track_id"  required autofocus> 
                          <input class="form-control" type="text" name="title" value="{{ $type }}" readonly="True" autofocus> 
                          <input type="hidden" value="{{ $cat }}" name="type"  required autofocus>                     
                          <input type="hidden" value="{{ Auth::user()->name }}" name="adminname"  required autofocus> 
                          <input type="hidden" value="{{ Auth::user()->email }}" name="adminemail"  required autofocus> 
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="fname">Amount Paid</label>
                          <input class="form-control" type="number" name="amount" required autofocus> 
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="fname">Paid To</label>
                          <input class="form-control" type="text" name="paid_to" required autofocus>
                        </div> 
                      </div>                                
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="fname">Staff Number</label>
                          <input class="form-control" type="text" name="staff_roll" required autofocus>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="fname">Month Paid For</label>
                          <input class="form-control" type="date" name="month" required autofocus>
                        </div> 
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="experience" class="control-label"><b>Short Description of Payment</b></label>
                          <textarea class="form-control"  name="description">Salary payment for the month of ...</textarea>
                        </div>
                      </div>
                    </div>                            
                    <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button>
                  </form>
                @endif
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
