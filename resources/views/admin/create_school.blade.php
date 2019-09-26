@extends('layouts.admin')
@section('pageTitle', 'Create School')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="header-icon">
          <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">  
        <h1>School</h1>
        <small>Create School</small>
        <ol class="breadcrumb hidden-xs">
            <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
            <li class="active">Create School</li>
        </ol>
      </div>
  </section>
  <!-- Main content -->
  <section class="content">
      <div class="row">
          <!-- Form controls -->
          <div class="col-sm-12">
              <div class="panel panel-bd lobidrag">
                  <div class="panel-heading">
                      <div class="btn-group"> 
                          <a class="btn btn-primary" href="{{ url('/admin/schools') }}"> <i class="fa fa-list"></i>  All Schools </a>  
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
                      <form class="col-sm-12" method="POST" action="{{ url('admin/create-school') }}"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-sm-3 form-group">
                            <label>School Code</label>
                            <input type="text" class="form-control" value="{{ $school_code }}" readonly="true" name="school_code">
                        </div>
                        <div class="col-sm-7 form-group">
                            <label>Name of School</label>
                            <input type="text" class="form-control" required name="school_name">
                        </div>

                        <div class="col-sm-2 form-group">
                            <label>School Initial</label>
                            <input type="text" class="form-control" required name="ini">
                        </div>

                          <div class="col-sm-3 form-group">
                              <label>Motto</label>
                              <input type="text" class="form-control" name="slogan">
                          </div>

                          <div class="col-sm-3 form-group">
                              <label>Username</label>
                              <input type="text" class="form-control" name="username" required="">
                          </div>

                          <div class="col-sm-3 form-group">
                              <label>Email</label>
                              <input type="email" class="form-control" placeholder="Enter Email" required name="email">
                          </div>
                        <div class="col-sm-3 form-group">
                              <label>Mobile Number</label>
                              <input type="tel" name="phone" class="form-control" placeholder="Enter Mobile" required>
                          </div>

                          <div class="col-sm-12 form-group">
                              <label>Address</label>
                              <textarea id="some-textarea" name="address" class="form-control" placeholder="Enter text ..."></textarea>
                          </div>

                          <div class="col-sm-3 form-group">
                            <label>Current Session</label>
                            <select class="form-control" name="current_session" required="">
                              <option value="2018/2019">2018/2019</option>
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

                          <div class="col-sm-3 form-group">
                            <label>Current Term</label>
                            <select class="form-control" name="current_term" required="">
                                <option value="First Term">First Term</option>
                                <option value="Second Term">Second Term</option>
                                <option value="Third Term">Third Term</option>
                            </select>
                          </div>

                          <div class="col-sm-3 form-group">
                            <label>No of Assessment</label>
                            <select class="form-control" name="assessment" required="">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                          </div>

                          
                          @if((Auth::user()->role=="Sales Rep") || (Auth::user()->role=="Marketer"))
                            <input type="hidden" name="representative_type" value="{{ Auth::user()->role }}">
                            <input type="hidden" name="representative" value="{{ Auth::user()->username }}">
                            <input type="hidden" name="status" value="Inactive">
                          @else

                          <div class="col-sm-3 form-group">
                            <label>Account Status</label>
                            <select class="form-control" name="status">
                              <option>Select</option>
                              <option value="Active">Active</option>
                              <option value="Trial">Trial</option>
                              <option value="Inactive">Inactive</option>
                            </select>
                          </div>

                          <div class="col-sm-4 form-group">
                            <label>Trial Duration In days (Optional)</label>
                            <input type="Number" value="30" name="trial_duration" class="form-control">
                          </div>



                          <div class="col-sm-4 form-group">
                            <label>Resentative Type</label>
                            <select class="form-control" name="representative_type">
                              <option>Select</option>
                              <option value="Sales Rep">Sales Rep</option>
                              <option value="Marketer">Marketer</option>
                            </select>
                          </div>


                          <div class="col-sm-4 form-group">
                            <label>Select</label>
                            <select class="form-control" name="representative">
                              @forelse($marketers as $resource)
                                <option value="{{ $resource->username }}">{{ $resource->name }}</option>
                              @empty
                              @endforelse
                            </select>
                          </div>
                          @endif
                          <div class="col-sm-12 reset-button">
                            <button class="btn btn-warning" type="reset">Reset</button>
                            <button class="btn btn-success" type="submit">Save</button>
                          </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>   
  </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->
@endsection