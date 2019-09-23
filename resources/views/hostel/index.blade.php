@extends('layouts.admin')
@section('pageTitle', 'All Hostels')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <span style="font-size:20px">All Hostels</span>  
    </section>

    <section class="content">
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
              <div class="btn-group"> 
                <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#addhostelmodal" > 
                  <i class="fa fa-plus"></i>Add Hostel 
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
                <table id="example2" class="table table-bordered table-striped m-b-0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Gender</th>
                      <th>Category</th>
                      <th>No of Beds</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    @forelse($hostels as $hostel)
                    <tr>
                      <td>{{ $hostel->name }} </td> 
                      <td>{{ $hostel->gender }} </td> 
                      <td>{{ $hostel->category }} </td> 
                      <td>{{ $hostel->number_of_bed }} 
                        <a class="btn btn-danger btn-xs pull-right" href="{{ url('/admin/removebed') }}/?hostel_code={{ $hostel->code }}"><i class="fa fa-minus"></i>
                        </a>
                        <a class="btn btn-success btn-xs pull-right" href="{{ url('/admin/addbed') }}/?hostel_code={{ $hostel->code }}"><i class="fa fa-plus"></i></a>
                        <a class="btn btn-info btn-xs pull-right" href="{{ url('/admin/bed') }}/?hostel_code={{ $hostel->code }}">View</a>
                      </td>

                      <div class="modal fade" id="edithostelmodal{{ $hostel->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; height: auto;">
                        <div class="modal-dialog" style="background:white">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                              </div>
                              <div class="modal-body">
                                <form method="post" class="profile-wrapper" action="{{ url('admin/updatehostel') }}" >
                                 {{ csrf_field() }}
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group"> 
                                        <label for="fname">Name of hostel</label>
                                        <input type="hidden" name="id" value="{{ $hostel->id }}">
                                        <input class="form-control" type="text" name="name" value="{{ $hostel->name }}" required autofocus>
                                      </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                      <button type="submit" class="btn btn-success">Edit</button> 
                                    </div>
                                  </div> 
                                                               
                                </form>
                              </div>
                            </div><!-- /.modal-content -->                     
                        </div>
                      </div>


                      <td>
                        <a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="#edithostelmodal{{ $hostel->id }}" >Edit</a>

                        <a class="btn btn-danger btn-xs" href="#" data-toggle="modal" data-target="#deletemodal{{ $hostel->id }}">Delete</a>

                        <div class="modal fade" id="deletemodal{{ $hostel->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; height: auto;">
                          <div class="modal-dialog" style="background:white">
                            <div class="modal-content">
                              <div class="modal-body" style="padding: 10px; text-align: center">
                                <h4>Deleting this hostel will automatically delete all the bed allocations in this hostel</h4><br>
                                <p style="color: red; font-weight: bolder;">Are you sure you want to proceed?</p>
                                <form class="delete" action="{{ url('/admin/destroyhostel') }}/{{$hostel->id}}" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                {{ csrf_field() }}
                                {{ Method_field('DELETE') }}
                                <button type="button" class="btn btn-info" data-dismiss="modal" aria-label="Close">No</button> 
                                <input class="btn btn-danger" type="submit" value="Yes">
                              </form>
                              </div>
                            </div><!-- /.modal-content -->                     
                          </div>
                        </div>

                        
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
    <!-- /.content -->
  </div>
  <div class="modal fade" id="addhostelmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog" style="background:white">
          <div class="modal-content" style="width: 700px;float: left;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"> Add hostels</h4>
            </div>
            <div class="modal-body">
              <form method="post" class="profile-wrapper" action="{{ url('admin/hostels') }}" >
                {{ csrf_field() }}
                <div class="form-group">
                  <input type="hidden" name="school_code" value="{{ $setting->school_code }}">
                  <label for="fname">Name of Hostel</label>
                  <input class="form-control" type="name" name="name" required autofocus>
                </div> 
                <div class="form-group">
                  <label for="fname">Gender</label>
                  <select class="form-control" name="gender" required="">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>                     
                
                <div class="form-group">
                  <label for="fname">Category</label>
                  <select class="form-control" name="category" required="">
                    <option value="Junior">Junior</option>
                    <option value="Senior">Senior</option>
                  </select>
                </div> 

                <div class="form-group">
                  <label for="fname">Number of Beds</label>
                  <input class="form-control" type="number" name="number_of_bed" required autofocus> 
                </div>  
                <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button>                              
              </form>
            </div>
            
            <div class="modal-footer">
             
            </div>
          </div><!-- /.modal-content -->                     
      </div>
  </div>
@endsection
