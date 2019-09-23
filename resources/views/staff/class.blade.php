@extends('layouts.admin')
@section('pageTitle', 'My Class')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px">My Classes </span>
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
                      <th>Class Name</th>
                      <th>Subject</th>
                      <th>Section</th>
                      <th>Term</th>
                      <th>View Students</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($subject_teachers as $form)
                    <tr>
                      <td>
                        @forelse($classes as $class)
                          @if($class->id==$form->class)
                            {{ $class->name }}{{ $class->form }}
                          @endif
                        @empty
                        @endforelse
                      </td>
                      <td>{{ $form->subject }}</td>
                      <td>{{ $form->session }}</td>
                      <td>{{ $form->term }}</td>
                      <td>
                        <form method="POST" action="{{ url('admin/addresult')}}">
                          {{ csrf_field() }}
                          <input type="hidden" name="term" value="{{$form->term}}">
                          <input type="hidden" name="class" value="{{$form->class}}">
                          <input type="hidden" name="session" value="{{$mainsession->id}}">
                          @forelse($subjects as $subject)
                            @if($subject->name==$form->subject)
                            <input type="hidden" name="subject" value="{{$subject->id}}">
                            @endif
                          @empty
                          @endforelse
                          <button type="submit" class="btn btn-success btn-xs">View <i class="fa fa-save"></i></button> 
                        </form>
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
