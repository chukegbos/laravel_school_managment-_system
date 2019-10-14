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
        <b>Term: </b>{{ $note->term }}
        @if(isset($note->pdf))<br> 
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
@endsection
