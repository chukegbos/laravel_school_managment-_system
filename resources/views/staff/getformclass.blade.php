@extends('layouts.admin')
@section('pageTitle', 'My Form Class')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px">My Form Classes </span>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-bd lobidrag">
            <div class="panel-body">
              <div class="table-responsive">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Class Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($forms as $form)
                    <tr>
                      <td>
                        {{ $form->name }}{{ $form->form }}
                      </td>
                      <td><a href="{{ url('/admin/formclass') }}/?id={{ $form->id}}">View Class</a></td>
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
