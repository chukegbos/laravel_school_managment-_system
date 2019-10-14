@extends('layouts.admin')
@section('pageTitle', 'Generate Pins')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px">Generate PINs</span> 
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
              
              <form method="post" class="profile-wrapper" action="{{ url('admin/generatepin') }}">
                {{ csrf_field() }}
                <p style="color:green; text-align: center; font-size: 25px; text-transform: uppercase;">
                  <strong>Generate PINS</strong>
                </p>
                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="fname">No of PIN</label>
                          <input class="form-control" type="number" name="number" required autofocus>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="fname">Select Schools</label>
                          <select class="form-control" name="school_code" required>
                            @forelse($schoolss as $school)
                              <option value="{{ $school->school_code }}"> {{ $school->school_name}} </option>
                            @empty
                            @endforelse
                          </select>
                        </div>
                      </div>
                  </div>                         
                  <button type="submit" class="btn btn-success pull-right">Generate <i class="fa fa-save"></i></button>                              
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
