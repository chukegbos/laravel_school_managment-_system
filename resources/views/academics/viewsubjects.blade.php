@extends('layouts.userpage')
@section('pageTitle', 'Subjects' )
@section('content')
<!-- Content Wrapper. Contains page content -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        All Subjects Offered By {{ $class }} {{ $form }}
      </h1>
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

        @if(isset($error))
          <div class="alert alert-danger alert-dismissable" style="margin:20px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4>  <i class="icon fa fa-times"></i> Error!</h4>
              {{ $error}}
          </div>
        @endif
        <div class="row">
          <div class="col-md-2 col-md-offset-4">
          </div>
          <div class="col-md-8 col-md-offset-4">
            <div class="box box-solid">
              <div class="box-body">
                    <div class="table-responsive">
                      <table id="example2" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th> Subject Name</th>
                          </tr>
                        </thead>
                        <tbody>
                          @for ($i = 0; $i < $length; $i++)
                            <tr>
                              <td>{{ $exploded[$i]  }}</td>
                            </tr>
                          @endfor
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
@endsection
