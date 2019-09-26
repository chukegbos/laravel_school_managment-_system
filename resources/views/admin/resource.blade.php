@extends('layouts.admin')
@section('pageTitle', 'Resources')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px">All {{ ucfirst($role) }}s</span> 
      <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#addresourcemodal" >Add {{ ucfirst($role) }}s</a>
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
              
              <div class="table-responsive">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Schools</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($resources as $resource)
                    <tr>
                      <td>{{ $resource->name }}</td>
                      <td>{{ $resource->username }}</td>
                      <td>{{ $resource->email }}</td>
                      <td>{{ $resource->phone }}</td>
                      <td>{{ $resource->address}}</td>
                      <th></th>
                     <td>
                        <form action="{{ url('/resource/destroyresource') }}/{{$resource->id}}" method="POST">
                          {{ csrf_field() }}
                          {{ Method_field('DELETE') }}
                           <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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

  <div class="modal fade" id="addresourcemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog" style="background:white">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"> Add resource</h4>
            </div>
            <div class="modal-body">
              <form method="post" class="profile-wrapper" action="{{ url('admin/resource') }}" >
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="fname">Name</label>
                  <input type="hidden" name="school_code" value="{{ $setting->school_code }}">
                  <input class="form-control" type="text" name="name" required autofocus>
                </div>                        
                <div class="form-group">
                  <label for="fname">Username</label>
                  <input class="form-control" type="text" name="username" required autofocus>
                </div> 
                <div class="form-group">
                  <label for="fname">Phone</label>
                  <input type="hidden" name="role" value="{{ $role }}">
                  <input class="form-control" type="text" name="phone" autofocus>
                </div>  
                <div class="form-group">
                  <label for="fname">Email</label>
                  <input type="hidden" name="password" value="$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm">
                  <input class="form-control" type="email" name="email" autofocus>
                </div> 

                <div class="form-group">
                  <label for="fname">Address</label>
                  <textarea class="form-control" name="address"></textarea>
                </div> 

                <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button>                              
              </form>
            </div>
            
            <div class="modal-footer">
             
            </div>
          </div>                
      </div>
  </div>
@endsection
