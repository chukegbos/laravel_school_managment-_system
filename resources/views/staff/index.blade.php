@extends('layouts.userpage')
@section('pageTitle', 'Staff Portal')
@section('content')
<!-- Content Wrapper. Contains page content -->


<div class="content-wrapper">
    @if(isset($error))
          <div class="alert alert-danger alert-dismissable" style="margin:20px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4>  <i class="icon fa fa-times"></i> Error!</h4>
              <h4>{{ $error}}</h4>
          </div>
        @endif
    <section class="content">
      <div class="row">
        
        <div class="col-lg-12 col-12">
          <div class="box box-solid bg-black">
            <div class="box-header with-border">
              <h4 class="box-title">School Information</h4>
            </div>
            <div class="box-body p-0">
              <div class="media-list media-list-hover media-list-divided text-center" style="padding: 10px;">
                <h3><span style="color: green">{{ $setting->sitename }}</span></h3>
                <h5><strong>{{ ucfirst($setting->address) }} </strong></h5>
                <h5><strong>{{ $setting->phone1 }} </strong></h5>              
                <h5><strong>{{ $setting->email }} </strong></h5>
                <hr>

                <h3><span style="color: green">Academic Info</span></h3>
                <p>Current Session: <span style="color: green"><strong>{{ $standards->session }} </strong></span></p>
                <p>Current Term: <span style="color: green"><strong>{{ $standards->term }} </strong></span></p>             
                @if($standards->term=="First Term")
                  <p>Term Starts: <span style="color: green"><strong>{{ $sessions->start_date->toFormattedDateString()}} </strong></span></p>
                  <p>Term Ends: <span style="color: green"><strong>{{ $sessions->end_date->toFormattedDateString()}} </strong></span></p>
                  <p>Mid Term Break: <span style="color: green"><strong> From {{ $sessions->firstterm_midterm_start->toFormattedDateString() }} to {{ $sessions->firstterm_midterm_end->toFormattedDateString() }}</strong></span></p>
                @elseif($standards->term=="Second Term")
                  <p>Term Starts: <span style="color: green"><strong>{{ $sessions->second_term_start->toFormattedDateString()}} </strong></span></p>
                  <p>Term Ends: <span style="color: green"><strong>{{ $sessions->second_term_end->toFormattedDateString()}} </strong></span></p>
                  <p>Mid Term Break: <span style="color: green"><strong> From {{ $sessions->secondterm_midterm_start->toFormattedDateString() }} to {{ $sessions->secondterm_midterm_end->toFormattedDateString() }}</strong></span></p>
                @else
                  <p>Term Starts: <span style="color: green"><strong>{{ $sessions->third_term_start->toFormattedDateString()}} </strong></span></p>
                  <p>Term Ends: <span style="color: green"><strong>{{ $sessions->third_term_end->toFormattedDateString()}} </strong></span></p>
                  <p>Mid Term Break: <span style="color: green"><strong> From {{ $sessions->thirdterm_midterm_start->toFormattedDateString() }} to {{ $sessions->thirdterm_midterm_end->toFormattedDateString() }}</strong></span></p>
                @endif
              </div>
            </div>
          </div>
        </div> 
      </div>
    </section>
</div>
@endsection
