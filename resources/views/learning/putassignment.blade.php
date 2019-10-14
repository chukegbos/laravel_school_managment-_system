@extends('layouts.admin')
@section('pageTitle', 'All Assignments')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px">All Assignments</span>
      @if(Auth::user()->role=="Staff")<a class="btn btn-info btn-xs pull-right"  href="#" data-toggle="modal" data-target="#addassignment"> Add Assignment</a>@endif
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
                      <th>Class</th>                          
                      <th>Session</th>
                      <th>Term</th>
                      <th>Subject</th>
                      <th>Submission Date</th>
                      <th>Grade Score</th>
                      @if(Auth::user()->role=="Staff")<th>Total Student</th>
                      <th>Submited Assigments</th>@endif
                      <th>Status</th>
                      <th>Action</th>
                      @if(Auth::user()->role=="Staff")<th>Delete</th>@endif
                      @if(Auth::user()->role=="Student")
                        <th>Remark</th>
                        <th>Score</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($notes as $note)
                    <tr>                     
                      <td>
                        @forelse($classes as $class)
                          @if($class->id==$note->class)
                            {{ $class->name }}{{ $class->form }}
                          @endif
                        @empty
                        @endforelse
                      </td>
                      <td>{{ $note->session }}</td>
                      <td>{{ $note->term }}</td>
                      <td>{{ $note->subject }}</td>
                      <td>{{ $note->submission_date->toFormattedDateString() }}</td>
                      <td>{{ $note->grade_score }}</td>
                      @if(Auth::user()->role=="Staff")<td>{{ $note->number_of_students }}</td>
                      <td>{{ $note->number_of_submit }} <a href="{{ url('admin/viewsubmitted') }}/?id={{ $note->id }}">view</a></td>@endif
                      <td>
                        @if($note->status==NULL) <span class="btn btn-info btn-xs">Still Open </span> @else <span class="btn btn-danger btn-xs">Closed</span> @endif</td>
                      <td>
                        @if(Auth::user()->role=="Staff")<a href="#" data-toggle="modal" data-target="#editnote{{ $note->id }}">Edit</a> | @endif
                        <a href="{{ url('/admin/viewassignment') }}/?id={{$note->id}}">View</a> 
                      </td>
                      @if(Auth::user()->role=="Staff")
                        <td>
                          <form action="{{ url('/admin/destroyassignment') }}/{{$note->id}}" method="POST">
                            {{ csrf_field() }}
                            {{ Method_field('DELETE') }}
                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                          </form>
                        </td>
                        <div class="modal fade" id="editnote{{ $note->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                          <div class="modal-dialog" style="background:white">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title"> Edit Assignment</h4>
                                </div>
                                <div class="modal-body">
                                  <form method="post" class="profile-wrapper" action="{{ url('admin/updateassignment') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                      <input type="hidden" name="school_code" value="{{ Auth::user()->school_code }}">
                                      <input type="hidden" name="teacher" value="{{ Auth::user()->username }}">
                                      <input type="hidden" name="session" value="{{ $setting->current_session }}">
                                      <input type="hidden" name="term" value="{{ $setting->current_term }}">
                                      <input type="hidden" name="id" value="{{ $note->id }}">
                                      <input type="hidden" name="subject" value="{{ $subject }}">
                                      
                                      <div class="form-group">
                                        <label for="title" class="form-label">Select Class</label>
                                        <select class="form-control" name="class" required="">
                                          @forelse($subject_teachers as $form)
                                            @forelse($classes as $class)
                                              @if($class->id==$form->class)
                                                <option @if($class->id==$note->class) Selected @endif value="{{ $class->id }}">{{ $class->name }}{{ $class->form }}</option>
                                              @endif
                                            @empty
                                            @endforelse
                                          @empty
                                          @endforelse
                                        </select>
                                      </div>

                                      <div class="form-group">
                                        <label for="title" class="form-label">Submission Dealine</label>
                                        <input type="text" class="form-control" value="{{ $note->submission_date->format('Y-m-d') }}" name="submission_date" required="">
                                      </div>

                                      <div class="form-group">
                                        <label for="your-label" class="form-label">Assignment</label>
                                        <textarea  class="form-control" id="edito{{ $note->id }}" rows="2" name="note">
                                          {!!html_entity_decode( $note->note  )!!}
                                        </textarea>      
                                        <script>
                                            // Replace the <textarea id="editor1"> with a CKEditor
                                            // instance, using default configuration.
                                            CKEDITOR.replace( 'edito{{ $note->id }}' );
                                        </script> 
                                      </div>
                                      <div class="form-group">
                                        <label for="title" class="form-label">Upload Note PDF or MSWord (<span style="color: green">Optional</span>)</label>
                                        <input type="file" class="form-control" name="pdf">
                                      </div>
                                      <div class="form-group">
                                        <label for="title" class="form-label">Grade Score</label>
                                        <input type="number" class="form-control" value="{{ $note->grade_score }}" name="grade_score" required="">
                                      </div>
                                      <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button>                              
                                  </form>
                                </div>
                                
                                <div class="modal-footer">
                                 
                                </div>
                              </div><!-- /.modal-content -->                     
                          </div>
                        </div>
                      @endif
                      <td>
                        @if(Auth::user()->role=="Student")
                          @forelse($myassignment as $theassignment)
                            @if($theassignment->assignment_id==$note->id)
                              {{ $theassignment->remark }}
                            @endif
                          @empty
                          @endforelse
                        @endif
                      </td>
                      <td>
                        @if(Auth::user()->role=="Student")
                          @forelse($myassignment as $theassignment)
                            @if($theassignment->assignment_id==$note->id)
                              {{ $theassignment->score }}
                            @endif
                          @empty
                          @endforelse
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
  @if(Auth::user()->role=="Staff")
    <div class="modal fade" id="addassignment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog" style="background:white">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"> Add Assignment</h4>
            </div>
            <div class="modal-body">
              <form method="post" class="profile-wrapper" action="{{ url('admin/putassignment') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                  <input type="hidden" name="school_code" value="{{ Auth::user()->school_code }}">
                  <input type="hidden" name="teacher" value="{{ Auth::user()->username }}">
                  <input type="hidden" name="session" value="{{ $setting->current_session }}">
                  <input type="hidden" name="term" value="{{ $setting->current_term }}">
                  <input type="hidden" name="subject" value="{{ $subject }}">
                  <div class="form-group">
                    <label for="title" class="form-label">Select Class</label>
                    <select class="form-control" name="class" required="">
                      @forelse($subject_teachers as $form)
                        @forelse($classes as $class)
                          @if($class->id==$form->class)
                            <option value="{{ $class->id }}">{{ $class->name }}{{ $class->form }}</option>
                          @endif
                        @empty
                        @endforelse
                      @empty
                      @endforelse
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="title" class="form-label">Submission Deadline</label>
                    <input type="date" class="form-control" name="submission_date" required="">
                  </div>

                  <div class="form-group">
                    <label for="your-label" class="form-label">Assignment</label>
                    <textarea  class="form-control" id="editor4" rows="2" name="note">
                    </textarea>      
                    <script>
                        // Replace the <textarea id="editor1"> with a CKEditor
                        // instance, using default configuration.
                        CKEDITOR.replace( 'editor4' );
                    </script> 
                  </div>
                  <div class="form-group">
                    <label for="title" class="form-label">Upload Note PDF or MSWord (<span style="color: green">Optional</span>)</label>
                    <input type="file" class="form-control" name="pdf">
                  </div>

                  <div class="form-group">
                    <label for="title" class="form-label">Grade Score</label>
                    <input type="number" class="form-control" name="grade_score" required="">
                  </div>

                  <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button>                              
              </form>
            </div>
            
            <div class="modal-footer">
             
            </div>
          </div><!-- /.modal-content -->                     
      </div>
    </div>
  @endif
@endsection
