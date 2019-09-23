@extends('layouts.admin')
@section('pageTitle', 'Set School')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="header-icon">
          <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">  
        <h1>School</h1>
        <small>School Setting</small>
        <ol class="breadcrumb hidden-xs">
            <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
            <li class="active">Edit School</li>
        </ol>
      </div>
  </section>
  <!-- Main content -->
  <section class="content">
      <div class="row">
          <!-- Form controls -->
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
                      <form class="col-sm-12" method="POST" action="{{ url('admin/schoolsetting') }}"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-sm-4 form-group">
                            <label>School Code</label>
                            <input type="text" class="form-control" value="{{ $setting->school_code }}" readonly="true" name="school_code">
                        </div>
                        <div class="col-sm-8 form-group">
                            <label>Name of School</label>
                            <input type="text" class="form-control" value="{{ $setting->school_name }}" required name="school_name">
                        </div>

                        <div class="col-sm-3 form-group">
                            <label>School Initial</label>
                            <input type="text" class="form-control" value="{{ $setting->ini }}" required name="ini">
                        </div>

                          <div class="col-sm-3 form-group">
                              <label>Motto</label>
                              <input type="text" class="form-control" value="{{ $setting->slogan }}" name="slogan">
                          </div>


                          <div class="col-sm-3 form-group">
                              <label>School Email</label>
                              <input type="email" class="form-control"  value="{{ $setting->email }}" required name="email">
                          </div>
                        <div class="col-sm-3 form-group">
                              <label>Mobile Number</label>
                              <input type="tel" name="phone" class="form-control" value="{{ $setting->phone }}" required>
                          </div>

                          <div class="col-sm-12 form-group">
                              <label>Address</label>
                              <textarea id="some-textarea" name="address" class="form-control">{{ $setting->address }}
                              </textarea>
                          </div>

                          <div class="col-sm-3 form-group">
                            <label>Current Session</label>
                            <select class="form-control" name="current_session" required="">
                              <option @if($setting->current_session=="2018/2019") Selected @endif value="2018/2019">2018/2019</option>
                              <option @if($setting->current_session=="2019/2020") Selected @endif value="2019/2020">2019/2020</option>
                              <option @if($setting->current_session=="2020/2021") Selected @endif value="2020/2021">2020/2021</option>
                              <option @if($setting->current_session=="2021/2022") Selected @endif value="2021/2022">2021/2022</option>
                              <option @if($setting->current_session=="2022/2023") Selected @endif value="2022/2023">2022/2023</option>
                              <option @if($setting->current_session=="2023/2024") Selected @endif value="2023/2024">2023/2024</option>
                              <option @if($setting->current_session=="2024/2025") Selected @endif value="2024/2025">2024/2025</option>
                              <option @if($setting->current_session=="2025/2026") Selected @endif value="2025/2026">2025/2026</option>
                              <option @if($setting->current_session=="2026/2027") Selected @endif value="2026/2027">2026/2027</option>
                              <option @if($setting->current_session=="2027/2028") Selected @endif value="2027/2028">2027/2028</option>
                              <option @if($setting->current_session=="2028/2029") Selected @endif value="2028/2029">2028/2029</option>
                              <option @if($setting->current_session=="2029/2030") Selected @endif value="2029/2030">2029/2030</option>
                            </select>
                          </div>

                          <div class="col-sm-3 form-group">
                            <label>Current Term</label>
                            <select class="form-control" name="current_term" required="">
                                <option value="First Term" @if($setting->current_term=="First Term") Selected @endif>First Term</option>
                                <option value="Second Term" @if($setting->current_term=="Second Term") Selected @endif>Second Term</option>
                                <option value="Third Term" @if($setting->current_term=="Third Term") Selected @endif>Third Term</option>
                            </select>
                          </div>

                          <div class="col-sm-3 form-group">
                            <label>No of Assessment</label>
                            <select class="form-control" name="assessment" required="">
                                <option value="1" @if($setting->assessment=="1") Selected @endif>1</option>
                                <option value="2" @if($setting->assessment=="2") Selected @endif>2</option>
                                <option value="3" @if($setting->assessment=="3") Selected @endif>3</option>
                                <option value="4" @if($setting->assessment=="4") Selected @endif>4</option>
                                <option value="5" @if($setting->assessment=="5") Selected @endif>5</option>
                            </select>
                          </div>

                          <div class="col-sm-3 form-group">
                            <label>School Color</label>
                            <input type="text" name="color" class="form-control" value="{{ $setting->color }}">
                          </div>
                          <div class="col-sm-12 reset-button">
                            <button class="btn btn-success" type="submit">Update</button>
                          </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>   
  </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->
@endsection