@extends('layouts.admin')
@section('pageTitle', 'E-Learning')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px">E- Learning </span>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-bd lobidrag">
            <div class="panel-body">
              <div class="row">
                  <!--<div class="col-xs-6 col-sm-6 col-md-6">
                      <a href="{{ url('/admin/curriculum') }}">
                          <div class="panel panel-bd cardbox ">
                              <div class="panel-body">
                                  <div class="statistic-box">
                                      <h2><span class="count-number"></span>
                                      </h2>
                                  </div>
                                  <div class="items pull-left">
                                      <i class="fa fa-users fa-2x"></i>
                                      <h4>My Curriculum </h4>
                                  </div>
                              </div>
                          </div>
                      </a>
                  </div>-->
                                 
                  <div class="col-xs-6 col-sm-6 col-md-6">
                      <a href="{{ url('/admin/notes') }}">
                          <div class="panel panel-bd cardbox" style="background: #FFB61E">
                              <div class="panel-body">
                                  <div class="statistic-box">
                                      <h2><span class="count-number"></span>
                                      </h2>
                                  </div>
                                  <div class="items pull-left">
                                      <i class="fa fa-users fa-2x"></i>
                                      <h4>My Notes</h4>
                                  </div>
                              </div>
                          </div>
                      </a>
                  </div>
                  
                  <div class="col-xs-6 col-sm-6 col-md-6">
                      <a href="{{ url('/admin/putassignment') }}">
                          <div class="panel panel-bd cardbox" style="background: #E5343D">
                              <div class="panel-body">
                                  <div class="statistic-box">
                                      <h2><span class="count-number"></span>
                                      </h2>
                                  </div>
                                  <div class="items pull-left">
                                      <i class="fa fa-user-circle fa-2x"></i>
                                      <h4>@if(Auth::user()->role=="Student") My @else Publish @endif Assignments</h4>
                                  </div>
                              </div>
                          </div>
                      </a>
                  </div>
                  
                  <!--<div class="col-xs-6 col-sm-6 col-md-6">
                      <a href="{{ url('/admin/subject') }}">
                          <div class="panel panel-bd cardbox" style="background: #58C9F3">
                              <div class="panel-body">
                                  <div class="statistic-box">
                                      <h2><span class="count-number"></span>
                                      </h2>
                                  </div>
                                  <div class="items pull-left">
                                      <i class="fa fa-users fa-2x"></i>
                                      <h4>View Students Assignment</h4>
                                  </div>
                              </div>
                          </div>
                      </a>
                  </div>

                  <div class="col-xs-6 col-sm-6 col-md-6">
                      <a href="{{ url('/admin/bed') }}">
                          <div class="panel panel-bd cardbox" style="background: #474751">
                              <div class="panel-body">
                                  <div class="statistic-box">
                                      <h2></span>
                                      </h2>
                                  </div>
                                  <div class="items pull-left">
                                      <i class="fa fa-bed fa-2x"></i>
                                      <h4>Hostels</h4>
                                  </div>
                              </div>
                          </div>
                      </a>
                  </div>

                  <div class="col-xs-6 col-sm-6 col-md-6">
                      <a href="{{ url('/admin/books') }}">
                          <div class="panel panel-bd cardbox" style="background: #DC2D2D">
                              <div class="panel-body">
                                  <div class="statistic-box">
                                      <h2><span class="count-number"></span>
                                      </h2>
                                  </div>
                                  <div class="items pull-left">
                                      <i class="fa fa-book fa-2x"></i>
                                      <h4>Library</h4>
                                  </div>
                              </div>
                          </div>
                      </a>
                  </div>-->
              </div>
            </div>
          </div>
        </div>  
      </div>     
    </section>
  </div>
@endsection
