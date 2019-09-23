@extends('layouts.admin')
@section('pageTitle', 'All Sessions')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <span style="font-size:20px">All Sessions</span>  
    </section>

    <section class="content">
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
              <div class="btn-group"> 
                <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#addsessionmodal" > 
                  <i class="fa fa-plus"></i>Add Sessions 
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
                      <th>First Term Start</th>
                      <th>First Term End</th>
                      <th>Second Term Start</th>
                      <th>Second Term End</th>
                      <th>Third Term Start</th>
                      <th>Third Term End</th>
                      <th>Action</th>
                      <th>Delete</th>
                    </tr>
                  </thead>

                  <tbody>
                    @forelse($sessions as $session)
                    <tr>
                      <td>{{ $session->name }} <br> 
                        @if($setting->current_session==$session->name)
                        <span class="btn btn-success btn-xs">Current Session</span>
                        @endif
                      </td>
                      <td>
                        @if(isset($session->start_date))
                          {{ $session->start_date->toFormattedDateString() }}
                        @endif
                      </td>
                      <td>
                        @if(isset($session->end_date))
                          {{ $session->end_date->toFormattedDateString() }}
                        @endif
                      </td>
                      <td>
                        @if(isset($session->second_term_start))
                          {{ $session->second_term_start->toFormattedDateString() }}
                        @endif
                      </td>
                      <td>
                        @if(isset($session->second_term_end))
                          {{ $session->second_term_end->toFormattedDateString() }}
                        @endif
                      </td>
                      <td>
                        @if(isset($session->third_term_start))
                          {{ $session->third_term_start->toFormattedDateString() }}
                        @endif
                      </td>
                      <td>
                        @if(isset($session->third_term_end))
                          {{ $session->third_term_end->toFormattedDateString() }}
                        @endif
                      </td>
                      
                      <td>
                        <a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="#editformmodal{{ $session->id }}" >Edit</a>


                        @if($setting->current_session!=$session->name)
                          <a class="btn btn-info btn-xs" href="{{ url('/admin/activate-session') }}/?school_code={{ $session->school_code }}&current_session={{ $session->name }}">Activate</a>
                        @endif
                      </td>
                      <div class="modal fade" id="editformmodal{{ $session->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; height: auto;">
                        <div class="modal-dialog" style="background:white">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                              </div>
                              <div class="modal-body">
                                <form method="post" class="profile-wrapper" action="{{ url('admin/updatesession') }}" >
                                 {{ csrf_field() }}
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group"> 
                                        <label for="fname">Name of Session</label>
                                        <input type="hidden" name="id" value="{{ $session->id }}">
                                        <input class="form-control" type="text" name="name" value="{{ $session->name }}" readonly="True" autofocus>
                                      </div>
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">

                                          <input type="hidden" name="school_code" value="{{ $setting->school_code }}">
                                          
                                          <label for="fname">First Term Start Date</label>
                                          <input class="form-control" type="date" name="start_date" required autofocus value="{{ $session->start_date->format('Y-m-d') }}">                     
                                      </div> 
                                      <div class="form-group">
                                          <label for="fname">First Term End Date</label>
                                          <input class="form-control" type="date" name="end_date" required autofocus value="{{ $session->end_date->format('Y-m-d') }}">    
                                      </div> 

                                      <div class="form-group">
                                          <label for="fname">First Term Mid-Term Break Start</label>
                                          <input class="form-control" type="date" name="firstterm_midterm_start" required autofocus value="{{ $session->firstterm_midterm_start->format('Y-m-d') }}">                      
                                      </div> 
                                      <div class="form-group">
                                          <label for="fname">First Term Mid-Term Break End</label>
                                          <input class="form-control" type="date" name="firstterm_midterm_end" required autofocus  value="{{ $session->firstterm_midterm_start->format('Y-m-d') }}">                      
                                      </div>
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="fname">Second Term Start Date</label>
                                          <input class="form-control" type="date" name="second_term_start" required autofocus value="{{ $session->second_term_start->format('Y-m-d') }}">                     
                                      </div> 
                                      <div class="form-group">
                                          <label for="fname">Second Term End Date</label>
                                          <input class="form-control" type="date" name="second_term_end" required autofocus  value="{{ $session->second_term_end->format('Y-m-d') }}">                      
                                      </div> 

                                      <div class="form-group">
                                          <label for="fname">Second Term Mid-Term Break Start</label>
                                          <input class="form-control" type="date" name="secondterm_midterm_start" required autofocus value="{{ $session->secondterm_midterm_start->format('Y-m-d') }}">                      
                                      </div> 
                                      <div class="form-group">
                                          <label for="fname">Second Term Mid-Term Break End</label>
                                          <input class="form-control" type="date" name="secondterm_midterm_end" required autofocus value="{{ $session->secondterm_midterm_end->format('Y-m-d') }}">                      
                                      </div>
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="fname">Third Term Start Date</label>
                                          <input class="form-control" type="date" name="third_term_start" required autofocus value="{{ $session->third_term_start->format('Y-m-d') }}">                     
                                      </div> 
                                      <div class="form-group">
                                          <label for="fname">Third Term End Date</label>
                                          <input class="form-control" type="date" name="third_term_end" required autofocus value="{{ $session->third_term_end->format('Y-m-d') }}">                      
                                      </div> 

                                      <div class="form-group">
                                          <label for="fname">Third Term Mid-Term Break Start</label>
                                          <input class="form-control" type="date" name="thirdterm_midterm_start" required autofocus value="{{ $session->thirdterm_midterm_start->format('Y-m-d') }}">                      
                                      </div> 
                                      <div class="form-group">
                                          <label for="fname">Third Term Mid-Term Break End</label>
                                          <input class="form-control" type="date" name="thirdterm_midterm_end" required autofocus value="{{ $session->thirdterm_midterm_end->format('Y-m-d') }}">                      
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
                      @if($setting->current_session!=$session->name)
                        <form action="{{ url('/admin/destroysession') }}/{{$session->id}}" method="POST">
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="addsessionmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog" style="background:white">
          <div class="modal-content" style="width: 700px;float: left;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"> Add Sessions</h4>
            </div>
            <div class="modal-body">
              <form method="post" class="profile-wrapper" action="{{ url('admin/sessions') }}" >
                 {{ csrf_field() }}
                  
                  <div class="form-group">
                      <select class="form-control" name="name" required="">
                        <option value="2019/2020">2019/2020</option>
                        <option value="2020/2021">2020/2021</option>
                        <option value="2021/2022">2021/2022</option>
                        <option value="2022/2023">2022/2023</option>
                        <option value="2023/2024">2023/2024</option>
                        <option value="2024/2025">2024/2025</option>
                        <option value="2025/2026">2025/2026</option>
                        <option value="2026/2027">2026/2027</option>
                        <option value="2027/2028">2027/2028</option>
                        <option value="2028/2029">2028/2029</option>
                        <option value="2029/2020">2029/2020</option>
                      </select>
                  </div> 
                  <div class="row">
                    <div class="col-md-4">                 
                      <div class="form-group">

                          <input type="hidden" name="school_code" value="{{ $setting->school_code }}">
                          
                          <label for="fname">First Term Start Date</label>
                          <input class="form-control" type="date" name="start_date" required autofocus>                     
                      </div> 
                      <div class="form-group">
                          <label for="fname">First Term End Date</label>
                          <input class="form-control" type="date" name="end_date" required autofocus>                      
                      </div> 

                      <div class="form-group">
                          <label for="fname">First Term Mid-Term Break Start</label>
                          <input class="form-control" type="date" name="firstterm_midterm_start" required autofocus>                      
                      </div> 
                      <div class="form-group">
                          <label for="fname">First Term Mid-Term Break End</label>
                          <input class="form-control" type="date" name="firstterm_midterm_end" required autofocus>                      
                      </div>
                    </div>


                    <div class="col-md-4">                 
                      <div class="form-group">
                          <label for="fname">Second Term Start Date</label>
                          <input class="form-control" type="date" name="second_term_start" required autofocus>                     
                      </div> 
                      <div class="form-group">
                          <label for="fname">Second Term End Date</label>
                          <input class="form-control" type="date" name="second_term_end" required autofocus>                      
                      </div> 

                      <div class="form-group">
                          <label for="fname">Second Term Mid-Term Break Start</label>
                          <input class="form-control" type="date" name="secondterm_midterm_start" required autofocus>                      
                      </div> 
                      <div class="form-group">
                          <label for="fname">Second Term Mid-Term Break End</label>
                          <input class="form-control" type="date" name="secondterm_midterm_end" required autofocus>                      
                      </div>
                    </div>


                    <div class="col-md-4">                 
                      <div class="form-group">
                          <label for="fname">Third Term Start Date</label>
                          <input class="form-control" type="date" name="third_term_start" required autofocus>                     
                      </div> 
                      <div class="form-group">
                          <label for="fname">Third Term End Date</label>
                          <input class="form-control" type="date" name="third_term_end" required autofocus>                      
                      </div> 

                      <div class="form-group">
                          <label for="fname">Third Term Mid-Term Break Start</label>
                          <input class="form-control" type="date" name="thirdterm_midterm_start" required autofocus>                      
                      </div> 
                      <div class="form-group">
                          <label for="fname">Third Term Mid-Term Break End</label>
                          <input class="form-control" type="date" name="thirdterm_midterm_end" required autofocus>                      
                      </div>
                    </div>
                  </div> 
                  <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button>                              
              </form>
            </div>
            
            <div class="modal-footer">
             
            </div>
          </div><!-- /.modal-content -->                     
      </div>
  </div>

  <div class="modal fade" id="newtermmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog" style="background:white">
        <div class="modal-content" style="width: 700px;float: left;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title"> Pick Term</h4>
          </div>
          <div class="modal-body">
            <form method="post" class="profile-wrapper" action="{{ url('admin/newsession') }}" >
              {{ csrf_field() }}              
              <div class="form-group">
                <input type="hidden" name="id" id="mainid">
                <input type="hidden" name="current_session" id="mainsession">
                  <select class="form-control" name="current_term" required="">
                    <option value="First Term">First Term</option>
                    <option value="Second Term">Second Term</option>
                    <option value="Third Term">Third Term</option>
                  </select>
              </div> 
              <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button>
            </form>
          </div>
        </div><!-- /.modal-content -->                     
      </div>
  </div>


  <script>
    $(document).on("click", ".open-AddBookDialog", function () {
         var mainId = $(this).data('id');
         var mainSession = $(this).data('current_session');
         $(".modal-body #mainid").val( mainId );
         $(".modal-body #mainsession").val( mainSession );
        $('#newtermmodal').modal('show');
    });
  </script>


@endsection
