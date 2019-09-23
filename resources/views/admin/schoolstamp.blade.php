@extends('layouts.admin')
@section('pageTitle', 'Set School Stamp')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="header-icon">
          <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">  
        <h1>School</h1>
        <small>School Stamp Setting</small>
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
                      <form class="col-sm-12" method="POST" action="{{ url('admin/schoolstamp') }}"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-sm-12 form-group" style="padding: 15px">
                          NB: <span style="text-align: center; font-weight: bolder;"><i>This is the official signatory stamp that will be used by the school for confirmation where and when neccesary</i></span>
                        </div>

                        <div class="col-sm-4 form-group">
                        </div>

                        <div class="col-sm-4 form-group">
                          @if($setting->school_stamp==NULL)
                            <img src="{{ asset('images/school_stamp.png') }}" style="height: 200px;width: 300px">
                          @else
                            <img class="img-fluid img-responsive" src="{{ asset('storage') }}/{{ $setting->school_stamp }}" alt="User profile picture" style="height: 200px;width: 300px">
                          @endif
                          <br><br>
                          <label>Select School Stamp</label>
                          <input type="hidden" value="{{ $setting->school_code }}" name="school_code">
                          <input type="file" class="form-control" name="school_stamp">
                        </div>

                        <div class="col-sm-12 reset-button">
                          <button class="btn btn-success" type="submit">Upload</button>
                        </div>
                      </form>
                   </div>
               </div>
           </div>
       </div>   
  </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->
@endsection