@extends('layouts.admin')
@section('pageTitle', 'Admin')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px">All Admins</span> 
      <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#addadminmodal" >Add Admin</a>
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
                      <th>Username</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($admins as $admin)
                    <tr>
                      <td>{{ $admin->username }}</td>
                      <td>{{ $admin->email }}</td>
                      <td>{{ $admin->role }}</td>
                     <td>
                      @if($admin->username!=Auth::user()->username)
                        <form action="{{ url('/admin/destroyadmin') }}/{{$admin->id}}" method="POST">
                          {{ csrf_field() }}
                          {{ Method_field('DELETE') }}
                           <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                      @endif
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

  <div class="modal fade" id="addadminmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog" style="background:white">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"> Add Admin</h4>
            </div>
            <div class="modal-body">
              <form method="post" class="profile-wrapper" action="{{ url('admin/admin') }}" >
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="fname">Username</label>
                  <input class="form-control" type="text" name="username" required autofocus>
                </div>                        
                <div class="form-group">
                  <label for="fname">Email</label>
                  <input class="form-control" type="email" name="email" required autofocus>
                </div> 
                <div class="form-group">
                  <label for="fname">Password</label>
                  <input type="hidden" name="school_code" value="{{ $setting->school_code }}">
                  <input type="hidden" name="role" value="Admin">
                  <input class="form-control" type="password" name="password" required>
                </div> 
                <div class="form-group">
                  <label for="fname">Role</label>
                  <select class="form-control" required="" name="sub_role">
                    <option value="School Admin">Admin</option>
                    <option value="Editor">Admin</option>
                  </select>
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
