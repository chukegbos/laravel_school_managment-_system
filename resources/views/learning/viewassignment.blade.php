@extends('layouts.admin')
@section('pageTitle', $note->title)
@section('content')
  <div class="content-wrapper">
    <section class="content-header" style="text-align: center;">
      <span style="font-size:20px">{{ $note->title }}</span>      
      <p>
        <b>Teacher: </b>{{ $name }} <br>
        <b>Class: </b>
        @forelse($classes as $class)
          @if($class->id==$note->class)
            {{ $class->name }}{{ $class->form }}
          @endif
        @empty
        @endforelse
        <br> 
        <b>Subject: </b>{{ $note->subject }}<br>
        <b>Session: </b>{{ $note->session }}<br>
        <b>Term: </b>{{ $note->term }}<br> 
        <b>Submission Date: </b>{{ $note->submission_date->toFormattedDateString() }}<br>
        <b>Status: </b> @if($note->status==NULL) Ongoing @else Closed @endif <br>

        @if(Auth::user()->role=="Student")

          <b>Report: </b> 
          @if($note->status==NULL) 
            @if(isset($assignment))
              <a href="#" data-toggle="modal" data-target="#reuploadassignment" class="btn btn-info btn-xs">Re-Submit Assignment</a> 
            @else
              <a href="#" data-toggle="modal" data-target="#addassignment" class="btn btn-info btn-xs">Submit Assignment</a> 
            @endif
          @else 
            @if(isset($assignment))
              {{ $assignment->score }} 
            @else
              <span style="color: red">You did not submit your assignment!!</span>
            @endif
          @endif 

          <br>
          <b>Remark: </b> 
            @if(isset($assignment))
              {{ $assignment->remark }}
            @endif 


        @endif
        <br>
        @if(isset($note->pdf))
          <a href="{{ asset('storage') }}/{{ $note->pdf }}" class="btn btn-success btn-xs">View/Download
          </a>
        @endif
      </p>
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

              <p>{!!html_entity_decode( $note->note  )!!}</p>
            </div>
          </div>
        </div>
      </div>        
    </section>
    <!-- /.content -->
  </div>

  @if(Auth::user()->role=="Student")
    <div class="modal fade" id="addassignment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog" style="background:white">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"> Submit Assignment</h4>
            </div>
            <div class="modal-body">
              <form method="post" class="profile-wrapper" action="{{ url('admin/submitassignment') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                  <input type="hidden" name="school_code" value="{{ Auth::user()->school_code }}">
                  <input type="hidden" name="roll" value="{{ Auth::user()->username }}">
                  <input type="hidden" name="assignment_id" value="{{ $note->id }}">
               
                
                  <div class="form-group">
                    <label for="title" class="form-label">Upload Assignment (PDF or MSWord)</label>
                    <input type="file" class="form-control" name="pdf" required="">
                  </div>

                  <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button>                              
              </form>
            </div>
            
            <div class="modal-footer">
             
            </div>
          </div><!-- /.modal-content -->                     
      </div>
    </div>

    @if(isset($assignment))
      <div class="modal fade" id="reuploadassignment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog" style="background:white">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Re-Submit Assignment</h4>
            </div>
            <div class="modal-body">
              <form method="post" class="profile-wrapper" action="{{ url('admin/submitassignment') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                  <input type="hidden" name="school_code" value="{{ Auth::user()->school_code }}">
                  <input type="hidden" name="roll" value="{{ Auth::user()->username }}">
                  <input type="hidden" name="assignment_id" value="{{ $note->id }}">
                  <input type="hidden" name="id" value="{{ $assignment->id }}">
                
                  <div class="form-group">
                    <label for="title" class="form-label">Upload Assignment (PDF or MSWord)</label>
                    <input type="file" class="form-control" name="pdf" required="">
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
  @endif
@endsection
