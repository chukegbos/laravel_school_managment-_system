@extends('layouts.admin')
@section('pageTitle', 'Select')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px; text-align: center;">Choose Destination </span>
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

                        <form method="post" class="profile-wrapper" action="{{ url('admin/addresult')}}">
                            {{ csrf_field() }}
                          
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">Select Class</label>
                                        <select name="class" class="form-control" required="">
                                            @forelse($classes as $class)
                                                <option value="{{ $class->id}}">{{ $class->name }} {{ $class->form }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">Select Subject</label>
                                        <select name="subject" class="form-control" required="">
                                            @forelse($subjects as $subject)
                                                <option value="{{ $subject->id}}">{{ $subject->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">Select Session</label>
                                        <select name="session" class="form-control" required="">
                                            @forelse($sessions as $session)
                                                <option value="{{ $session->id}}">{{ $session->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">Select Term</label>
                                        <select name="term" class="form-control" required="">
                                            <option value="First Term">First Term</option>
                                            <option value="Second Term">Second Term</option>
                                            <option value="Third Term">Third Term</option>
                                            <option value="Annual">Annual</option>
                                        </select>
                                    </div>
                                </div>
                            </div>                        
                            <button type="submit" class="btn btn-success pull-right">Select <i class="fa fa-save"></i></button>                              
                        </form>
                    </div> 
                </div> 
            </div>
        </div>     
    </section>
</div>
@endsection
