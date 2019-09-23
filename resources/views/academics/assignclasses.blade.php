@extends('layouts.userpage')
@section('pageTitle', 'All Subjects')
@section('content')
<!-- Content Wrapper. Contains page content -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3>
       {{$subject}} class(es)  assigned to <b> <span style="color: green">{{$teacher->lastname}} {{$teacher->firstname}}</span></b>
      </h3>
     
    </section>


      <!-- Main content -->
      <!-- Main content -->
    <section class="content">
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
            
            <div class="box-body">
              <div class="row">
                <div class="col-12">
                    @forelse($classes as $class)
                    <h4><a href="{{ url('/admin/subjectstudents') }}/?class={{ $class->class }}&form={{$class->form}}&subject={{$subject}}"><i class="fa fa-check"></i> {{ $class->class}} {{ $class->form}}</a></h4>
                          
                    @empty
                      No Class Found.
                    @endforelse
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
