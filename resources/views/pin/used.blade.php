@extends('layouts.admin')
@section('pageTitle', 'Used Pins')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px">Used PINs</span> 
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
                      <th>PIN</th>
                      <th>Serial Number</th>
                      <th>Used By</th>
                      <th>From</th>
                      <th>Session Used</th>
                      <th>Term</th>
                      <th>Count</th>
                      <th>Date Last Used</th>
                      <!--<th>Delete</th>-->
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($cards as $card)
                    <tr>
                      <td> {{ $card->token }}</td>                        
                      <td> {{ $card->serial_number }}</td>
                      <td> {{ $card->roll }}</td>
                      <td> {{ $card->school_code }}</td>
                      <td> {{ $card->session }}</td>
                      <td> {{ $card->term }}</td>
                      <td> {{ $card->count}}</td>
                      <td> {{ $card->updated_at}}</td>
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
