@extends('layouts.admin')
@section('pageTitle', 'All Schools')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">  
            <h1>@if(isset($school_status)) {{ $school_status }} @endif Schools</h1>
            <small>@if(isset($school_status)) {{ $school_status }} @endif school list</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ url('/') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">@if(isset($school_status)) {{ $school_status }} @endif Schools</li>
            </ol>
        </div>
    </section>
    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-success" href="{{ url('admin/create-school') }}"> <i class="fa fa-plus"></i> Create School
                            </a>  
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

                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>School ID</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                        <th>Expiration Date</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($schoolss as $school)
                                    <tr>
                                        <td>
                                            <label>{{ $school->school_code }}</label>   
                                        </td>
                                        <td>{{ $school->school_name }}</td>
                                        <td>{{ $school->phone }}</td>
                                        <td><a href="mailto:{{ $school->email }}">{{ $school->email }}</a></td>
                                        <td>
                                            <!--<a href="{{ url('/admin/edit') }}/?school_code={{ $school->school_code }}" class="btn btn-success btn-xs">Edit</a>-->
                                            <a href="{{ url('/admin/visit') }}/?school_code={{ $school->school_code }}" class="btn btn-info btn-xs">View</a>

                                            @if($school->status=="Active")
                                                <a href="{{ url('/admin') }}/deactivate/?school_code={{ $school->school_code }}" class="btn btn-inverse btn-xs">Deactivate</a>
                                            @elseif($school->status=="Trial")
                                                <a href="{{ url('/admin') }}/activate/?school_code={{ $school->school_code }}" class="btn btn-warning btn-xs">Activate</a>

                                                <a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="#extendmodal{{ $school->id }}">Extend</a>

                                                {{ round((strtotime($school->trial_end) - strtotime($school->created_at))/60/60/24 )}} more days

                                                <div class="modal fade" id="extendmodal{{ $school->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog" style="background:white">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" class="profile-wrapper" action="{{ url('admin/extendtime') }}">
                                                             {{ csrf_field() }}
                                                              
                                                                <div class="form-group">
                                                                  <label for="fname">Add Extention</label>
                                                                  <input type="hidden" name="id" value="{{ $school->id }}">
                                                                  <input class="form-control" type="number" name="number" value="30" required>
                                                                </div>                    
                                                                <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button>                              
                                                            </form>
                                                        </div>
                                                      </div><!-- /.modal-content -->                     
                                                    </div>
                                                </div>
                                            @elseif($school->status=="Request")
                                                <a href="{{ url('/admin') }}/trial/?school_code={{ $school->school_code }}" class="btn btn-warning btn-xs">Put Trial</a>
                                            @else
                                                <a href="{{ url('/admin') }}/activate/?school_code={{ $school->school_code }}" class="btn btn-warning btn-xs">Activate</a>
                                            @endif
                                        </td>
                                        @if($school->status=="Active")
                                            <td>
                                                {{ round((strtotime($school->active_end) - strtotime($school->created_at))/60/60/24 )}} more days
                                                <a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="#extendactive{{ $school->id }}">Extend</a>


                                                <div class="modal fade" id="extendactive{{ $school->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog" style="background:white">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" class="profile-wrapper" action="{{ url('admin/extendactive') }}">
                                                             {{ csrf_field() }}
                                                              
                                                                <div class="form-group">
                                                                  <label for="fname">Add Extention</label>
                                                                  <input type="hidden" name="id" value="{{ $school->id }}">
                                                                  <input class="form-control" type="number" name="number" value="30" required>
                                                                </div>                    
                                                                <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button>                              
                                                            </form>
                                                        </div>
                                                      </div><!-- /.modal-content -->                     
                                                    </div>
                                                </div>
                                            </td>
                                        @else
                                        <td></td>
                                        @endif
                                        <td>
                                            <form action="{{ url('admin/deleteschool') }}/{{$school->id}}" method="POST">
                                              {{ csrf_field() }}
                                              {{ Method_field('DELETE') }}
                                              
                                               <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection