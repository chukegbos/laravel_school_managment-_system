@extends('layouts.admin')
@section('pageTitle', 'All Notes')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px">My Notes </span>
      @if(Auth::user()->role=="Staff")<a class="btn btn-info btn-xs pull-right"  href="#" data-toggle="modal" data-target="#addnote"> Add Note</a>@endif
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
                      <th>Title</th>
                      <th>Action</th>
                      @if(Auth::user()->role=="Staff")
                        <th>Delete</th>
                      @endif
                      @if(Auth::user()->role=="Student")
                        <th>Teacher</th>
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
                      <td>{{ $note->title }}</td>
                      <td>
                        @if(Auth::user()->role=="Staff")<a href="#" data-toggle="modal" data-target="#editnote{{ $note->id }}">Edit Note</a> | @endif
                        <a href="{{ url('/admin/viewnote') }}/?id={{$note->id}}">View Note</a> 
                      </td>
                      @if(Auth::user()->role=="Staff")
                        <td>
                          <form action="{{ url('/admin/destroynote') }}/{{$note->id}}" method="POST">
                            {{ csrf_field() }}
                            {{ Method_field('DELETE') }}
                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                          </form>
                        </td>
                      @endif
                      @if(Auth::user()->role=="Staff")
                        <div class="modal fade" id="editnote{{ $note->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog" style="background:white">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title"> Edit Note</h4>
                              </div>
                              <div class="modal-body">
                                <form method="post" class="profile-wrapper" action="{{ url('admin/updatenote') }}" enctype="multipart/form-data">
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
                                      <label for="title" class="form-label">Title</label>
                                      <input type="text" class="form-control" value="{{ $note->title }}" name="title" required="">
                                    </div>

                                    <div class="form-group">
                                      <label for="your-label" class="form-label">Note</label>
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
                          @forelse($teachers as $teacher)
                            @if($teacher->roll==$note->teacher)
                              {{ $teacher->lastname }} {{ $teacher->firstname }} {{ $teacher->middlename }}
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
    <div class="modal fade" id="addnote" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="background:white">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> Add Note</h4>
              </div>
              <div class="modal-body">
                <form method="post" class="profile-wrapper" action="{{ url('admin/note') }}" enctype="multipart/form-data">
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
                      <label for="title" class="form-label">Title</label>
                      <input type="text" class="form-control" name="title" required="">
                    </div>

                    <div class="form-group">
                      <label for="your-label" class="form-label">Note</label>
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
