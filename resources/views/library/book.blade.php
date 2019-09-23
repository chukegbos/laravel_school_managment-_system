@extends('layouts.admin')
@section('pageTitle', 'Books')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px">All Books</span> 
      <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#addbookmodal" >Add Book</a>
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
                      <th>Book Code</th>
                      <th>Name</th>
                      <th>Author</th>
                      <th>ISBN</th>
                      <th>Total Copy</th>
                      <th>Available Copy</th>
                      <th>Action</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($books as $book)
                    <tr>
                      <td>{{ $book->book_code }}</td>
                      <td>{{ $book->name }}</td>
                      <td>{{ $book->author }}</td>
                      <td>{{ $book->isbn }}</td>
                      <td>{{ $book->copies_have }}</td>
                      <td>{{ $book->copies_available }}</td>
                      <td>
                        <a href="{{ url('/admin/addbook') }}/?book_code={{ $book->book_code }}" class="btn btn-info btn-xs"><i class="fa fa-plus"></i></a>
                        <a href="{{ url('/admin/reducebook') }}/?book_code={{ $book->book_code }}" class="btn btn-danger btn-xs"><i class="fa fa-minus"></i></a>
                        @if($book->copies_available == 0)
                        @else
                        <a href="#" data-toggle="modal" data-target="#lendmodal{{ $book->id }}" class="btn btn-warning btn-xs">Lend</a> 
                        @endif
                        <a href="#" data-toggle="modal" data-target="#edit{{ $book->id }}"  class="btn btn-primary btn-xs">Edit</a>
                      </td>

                      <div class="modal fade" id="lendmodal{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; height: auto;">
                        <div class="modal-dialog" style="background:white">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                              </div>
                              <div class="modal-body">
                                <form method="post" class="profile-wrapper" action="{{ url('admin/lend') }}" >
                                 {{ csrf_field() }}
                                  <div class="row">

                                    <div class="col-md-12">
                                      <div class="form-group"> 
                                        <label for="fname">Student Admission Number or Staff ID</label>
                                        <input type="hidden" name="school_code" value="{{ $setting->school_code }}">
                                        <input type="hidden" name="status" value="0">
                                        <input type="hidden" name="book_code" value="{{ $book->book_code }}">
                                        <input class="form-control" type="text" name="lender" required="">
                                      </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                      <div class="form-group"> 
                                        <label for="fname">Book</label>
                                        <input class="form-control" type="text" name="name" value="{{ $book->name }}" readonly="True" autofocus>
                                      </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                      <div class="form-group"> 
                                        <label for="fname">Duration (In days)</label>
                                        <input class="form-control" type="number" name="duration" required="" autofocus>
                                      </div>
                                    </div>

                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                      <button type="submit" class="btn btn-success"> Lend </button> 
                                    </div>
                                  </div> 
                                                               
                                </form>
                              </div>
                            </div><!-- /.modal-content -->                     
                        </div>
                      </div>


                      <td>
                        @if($book->copies_available==$book->copies_have)
                        <form action="{{ url('/book/destroybook') }}/{{$book->id}}" method="POST">
                          {{ csrf_field() }}
                          {{ Method_field('DELETE') }}
                           <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                        @endif
                      </td>
                    </tr>
                    
                    
                    
                    <div class="modal fade" id="edit{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; height: auto;">
                        <div class="modal-dialog" style="background:white">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                              </div>
                              <div class="modal-body">
                                <form method="post" class="profile-wrapper" action="{{ url('admin/editbook') }}" >
                                 {{ csrf_field() }}
                                  <div class="row">

                                    <div class="col-md-12">
                                      <div class="form-group"> 
                                        <label for="fname">Book</label>
                                       
                                        <input type="hidden" name="id" value="{{ $book->id }}">
                                        <input class="form-control" type="text" name="name" value="{{ $book->name }}" required autofocus>
                                      </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                      <div class="form-group"> 
                                        <label for="fname">Author</label>
                                        <input class="form-control" type="text" name="author" value="{{ $book->author }}" required autofocus>
                                      </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                      <div class="form-group"> 
                                        <label for="fname">ISBN</label>
                                        <input class="form-control" type="text" name="isbn" value="{{ $book->isbn }}" required autofocus>
                                      </div>
                                    </div>
                                    

                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                      <button type="submit" class="btn btn-success"> Edit </button> 
                                    </div>
                                  </div> 
                                                               
                                </form>
                              </div>
                            </div><!-- /.modal-content -->                     
                        </div>
                      </div>
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

  <div class="modal fade" id="addbookmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog" style="background:white">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"> Add book</h4>
            </div>
            <div class="modal-body">
              <form method="post" class="profile-wrapper" action="{{ url('admin/books') }}" >
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="fname">Book Code</label>
                  <input class="form-control" type="text" value="{{ $book_code }}" name="book_code" readonly="true" autofocus>
                </div>                        
                <div class="form-group">
                  <label for="fname">Book Name</label>
                  <input class="form-control" type="text" name="name" required autofocus>
                </div> 

                <div class="form-group">
                  <label for="fname">Author</label>
                  <input type="hidden" name="school_code" value="{{ $setting->school_code }}">
                  <input class="form-control" type="text" name="author" required autofocus>
                </div> 

                <div class="form-group">
                  <label for="fname">ISDN</label>
                  <input class="form-control" type="text" name="isbn">
                </div>

                <div class="form-group">
                  <label for="fname">Number Purchased</label>
                  <input class="form-control" type="number" name="copies_have" required autofocus>
                </div>

                <button type="submit" class="btn btn-success pull-right">Add <i class="fa fa-save"></i></button>                              
              </form>
            </div>
            
            <div class="modal-footer">
             
            </div>
          </div>                
      </div>
  </div>
@endsection
