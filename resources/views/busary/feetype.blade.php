@extends('layouts.admin')
@section('pageTitle', 'Payment Type')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px">Types of Payment</span>  
    </section>

    <section class="content">
      <div class="panel panel-bd lobidrag">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-4">
              @if(isset($status))
                <div class="alert alert-success alert-dismissable" style="margin:20px">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4>  <i class="icon fa fa-check"></i> Success!</h4>
                    {{ $status}}
                </div>
              @endif
              <form role="form" action="{{ url('/admin/feetype') }}" method="POST" >
                {{ csrf_field() }}
                <!-- text input -->
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" class="form-control" name="title" Required/>
                  <input type="hidden" name="school_code" value="{{ Auth::user()->school_code }}">
                </div>

                <!--<div class="form-group">
                  <label for="experience" class="control-label"><b> Short Description</b></label>
                  <textarea class="form-control"  name="description"></textarea>                
                </div>-->

                <div class="form-group">
                  <label for="fname">Category</label>
                  <select name="type" class="form-control dynamic" id="class1" data-dependent="form">
                      <option value="Credit">Credit (Pay In)</option>
                      <option value="Debit">Debit (Pay Out)</option>
                  </select>
                </div>

                <div class="form-group">
                  <input type="submit" value="Add" class="btn btn-success">
                </div>
              </form>
            </div>

            <div class="col-md-8">
              <div class="table-responsive">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Fee Type</th>
                      <th>Price in Naira</th>
                      <th>Type</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($feetypes as $feetype)
                      <tr>
                        <td>{{ $feetype->title }}</td>
                        <td>{{ $feetype->description }}</td>
                        <td>{{ $feetype->type }}</td>
                        <td>
                          <form action="{{ url('admin/deletefeetype') }}/{{$feetype->id}}" method="POST">
                            {{ csrf_field() }}
                            {{ Method_field('DELETE') }}
                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                          </form>
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
  </div>
@endsection

