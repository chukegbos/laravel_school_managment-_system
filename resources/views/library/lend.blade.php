@extends('layouts.admin')
@section('pageTitle', 'Borrowed Books')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px">Borrowed Books</span> 
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
                      <th>Book</th>
                      <th>Borrower</th>
                      <th>Date Borrowed</th>
                      <th>Date to return</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($lends as $book)
                    <tr>
                      <td>
                        @forelse($books as $have)
                          @if($have->book_code==$book->book_code)
                            {{ $have->name }}
                          @endif
                        @empty
                        @endforelse
                      </td>
                      <td>{{ $book->lender }}</td>
                      <td> {{ $book->created_at->toFormattedDateString() }}</td>
                      <td> {{ $book->return_date->toFormattedDateString() }}</td>
                     
                      <td>
                        @if($book->status==0)
                          Pending 
                        @else
                          Returned
                        @endif
                      </td>
                      <td><a href="{{ url('/admin/marksuccess') }}/?id={{ $book->id }}" class="btn btn-success btn-xs">Mark as returned</a></td>
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
