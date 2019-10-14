@extends('layouts.admin')
@section('pageTitle', 'Fee Types')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px">Choose Your @if(isset($type)) {{ ucfirst($type) }} @endif Category</span>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6">
          <div class="panel panel-bd lobidrag">
            <div class="panel-body">
              <ul>
                @forelse($feetypes as $feetype)
                  <i class="icon fa fa-check"></i><a href="{{ url('/admin/selecttype') }}/?type={{ $feetype->title}}&cat={{ $feetype->type}}"> {{ $feetype->title}}</a><br><br>
                @empty
                @endforelse
                <i class="icon fa fa-check"></i><a href="{{ url('/admin/selecttype') }}/?type=Others"> Others</a>
              </ul>
            </div>
          </div>
        </div>
      </div>     
    </section>
  </div>
@endsection
