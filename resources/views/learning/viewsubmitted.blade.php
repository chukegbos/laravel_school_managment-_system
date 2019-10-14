@extends('layouts.admin')
@section('pageTitle', 'Submited Assignments')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px">Submited Assignments</span>
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
                      <th>Student</th>
                      <th>Class</th>                          
                      <th>Session</th>
                      <th>Term</th>
                      <th>Subject</th>
                      <th>View Answer</th>
                      <th>Score</th>
                      <th>Grade Score</th>
                      <th>Teacher's Remark</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($allassignment as $note)
                    <tr>  
                      <td>
                        @forelse($students as $student)
                          @if($student->roll==$note->roll)
                            {{ $student->lastname }} {{ $student->firstname }} {{ $student->middlename }}
                          @endif
                        @empty
                        @endforelse 
                      </td>                   
                      <td>
                        @forelse($classes as $class)
                          @if($class->id==$assignment->class)
                            {{ $class->name }}{{ $class->form }}
                          @endif
                        @empty
                        @endforelse
                      </td>
                      <td>{{ $assignment->session }}</td>
                      <td>{{ $assignment->term }}</td>
                      <td>{{ $assignment->subject }}</td>
                      <td>
                        <a href="{{ asset('storage') }}/{{ $note->pdf }}">View/Download
                        </a>
                      </td>
                      <td>
                        {{ $note->score }} <br>
                        <a href="#" data-toggle="modal" data-target="#addscore{{ $note->id }}">Add Score</a>
                      </td>
                      <td>{{ $assignment->grade_score }}</td>
                      <div class="modal fade" id="addscore{{ $note->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog" style="background:white">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              </div>
                              <div class="modal-body">
                                <form method="post" class="profile-wrapper" action="{{ url('admin/addscore') }}" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{ $note->id }}">
                                    <div class="form-group">
                                      <label for="title" class="form-label">Add Score</label>
                                      <input type="number" class="form-control" value="{{ $note->score }}" name="score" required="">
                                    </div>
                                    <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button>                              
                                </form>
                              </div>
                              
                              <div class="modal-footer">
                               
                              </div>
                            </div><!-- /.modal-content -->                     
                        </div>
                      </div>


                      <td>
                        {{ $note->remark }} <br>
                        <a href="#" data-toggle="modal" data-target="#addremark{{ $note->id }}">Add Remark</a>
                      </td>
                      <div class="modal fade" id="addremark{{ $note->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog" style="background:white">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                              <form method="post" class="profile-wrapper" action="{{ url('admin/addscore') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $note->id }}">
                                <div class="form-group">
                                  <label for="your-label" class="form-label">Your Remark</label>
                                  <textarea  class="form-control" rows="2" name="remark">
                                    {!!html_entity_decode( $note->remark  )!!}
                                  </textarea> 
                                </div>
                                <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button>                              
                              </form>
                            </div>
                            <div class="modal-footer">
                               
                            </div>
                          </div><!-- /.modal-content -->                     
                        </div>
                      </div>
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
