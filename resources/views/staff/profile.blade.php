@extends('layouts.userpage')
@section('pageTitle', 'Staff Profile')
@section('content')
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <section class="invoice printableArea">
      <div class="row">
        <div class="col-md-5">
          <div class="box-header">
              <h3 style="color:green; font-size:25px; font-weigh:bolder">{{ $profile->lastname }} {{ $profile->firstname }} {{ $profile->middlename }}</h3>
              <p>Staff Number: {{ $profile->roll }} ({{ $profile->category }} staff)</p>
              <p>Subject Specialization: {{ $profile->subject }}</p>
          </div> 
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-6">
          <div class="box-header pull-right">
              <h3><b>{{ $setting->sitename }}</b></h3>
              <h6>School Address: <b>{{ ucfirst($setting->address) }}</b></h6>
              <h6>School Email: <b>{{ $setting->email }}</b></h6>
              <h6>School Tel.: <b>{{ $setting->phone1 }}</b></h6>
          </div> 
        </div>      
      </div> 
      <hr>


      <div class="row">
        <div class="col-md-4" style="text-align:center">
          <img class="profile-user-img rounded img-fluid mx-auto d-block" src="{{ asset('storage') }}/{{ $profile->image }}" alt="User profile picture">
          <p>Phone Number:<br> <strong style="color:green;">{{ $profile->phone }}</strong><p>
          <p>Email Address:<br> <strong style="color:green;">{{ $profile->email }}</strong><p>
          <p>Gender<br><strong style="color:green;">{{ $profile->gender }}</strong><p>
          <p>Date of Birth<br><strong style="color:green;">{{ $profile->dob->toFormattedDateString() }} ({{ $profile->age }} Years)</strong><p>
          
                
        </div>

        <div class="col-md-8" style="text-align:center">
         
          <div class="row">
            <div class="col-md-6">
              <div style="font-size:15px">
                <p>Current Address<br><strong style="color:green;">{{ $profile->current_address }}</strong><p>
                <p>Parmanent Address<br><strong style="color:green;">{{ $profile->parmanent_address }}</strong><p>
                <p>Nationality (State of Origin)<br><strong style="color:green;">{{ $profile->country }} ({{ $profile->state }})</strong><p>
                <p>Religion<br><strong style="color:green;">{{ $profile->religion}} </strong><p>
              </div>
            </div>
            <div class="col-md-6">
              <div style="font-size:15px">
                <p>Position/Rank<br><strong style="color:green;">{{ $profile->position }}</strong><p>
                <p>Current Class<br><strong style="color:green;">{{ $profile->class }} {{ $profile->form }}</strong><p>
                <p>Recent Degree<br><strong style="color:green;">{{ $profile->last_degree }}</strong><p>
                <p>University Attended<br><strong style="color:green;">{{ $profile->university_attended }} </strong><p> 
                        
              </div>
            </div>
            
          </div>
        </div>

      </div> 
 <hr>
      <!-- this row will not appear when printing -->
      <div class="row no-print">
       
        <div class="col-12">
          <button id="print" class="btn btn-warning" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
          @if(Auth::guard('admin')->check())
          <a href="{{ url('/admin/editstaff') }}/?roll={{$profile->roll}}" class="btn btn-danger pull-right" style="margin-right: 5px;">
            <i class="fa fa-edit"></i> Edit Profile
          </a>
          @endif
        </div>
      </div>
    </section>
  </div>
@endsection
