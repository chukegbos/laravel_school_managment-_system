@extends('layouts.userpage')
@section('pageTitle', 'All Subjects')
@section('content')
<!-- Content Wrapper. Contains page content -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3>
        Select form from {{$class}}
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
                   <form method="post" class="profile-wrapper" action="{{ url('admin/assignform') }}" >
                     <!-- {{ method_field('PUT') }}-->
                      {{ csrf_field() }}
                     <div class="form-group">
                            <input type="hidden" value="{{$standard->session}}" name="session">
                            <input type="hidden" value="{{$standard->term}}" name="term">
                            <input type="hidden" value="{{$subject}}" name="subject">
                            <input type="hidden" value="{{$class}}" name="class">
                            <input type="hidden" value="{{$teacher->lastname}}" name="lastname">
                            <input type="hidden" value="{{$teacher->firstname}}" name="firstname">
                            <input type="hidden" value="{{$teacher->middlename}}" name="middlename">
                            <input type="hidden" value="{{$teacher->lastname}} {{$teacher->firstname}} {{$teacher->middlename}}" name="fullname">
                      
                          @forelse($classes as $class)
                          <div class="c-inputs-stacked">
                            
                            <input type="checkbox" id="checkbox_{{ $class->id}}" name="form[]" value="{{ $class->form_name}}"/>
                            <label for="checkbox_{{ $class->id}}" class="block"> {{ $class->form_name}}</label> 
                          </div>
                          @empty
                            No Form Found.
                          @endforelse
                      </div>
                      @if(isset($classes ))                    
                      <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button>
                      @endif                             
                  </form>
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
