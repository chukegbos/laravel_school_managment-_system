@extends('layouts.userpage')
@section('pageTitle', 'Students' )
@section('content')
<div class="content-wrapper">


  <section class="content printableArea">
      @if(isset($status))
        <div class="alert alert-success alert-dismissable" style="margin:20px">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4>  <i class="icon fa fa-check"></i> Success!</h4>
            {{ $status}}
        </div>
      @endif
      <div class="row">
        <div class="col-12">
          <div class="box box-solid">
            <div class="box-header" style="text-align:center">
                <h3 style="color:green; font-size:25px; font-weigh:bolder">{{ $session }} - {{ $term }} {{ $subject }} Result</h3>
                <h3 style="color:green; font-size:20px; font-weigh:bolder">{{ $class}} {{ $form }} </h3>
                @if (Auth::guard('teacher')->check()) 
                  <p>Subject Teacher: {{ Auth::user()->lastname }} {{ Auth::user()->firstname }} {{ Auth::user()->middlename }}<b></b></p>
                @endif
                <div class="no-print">
                  @if (Auth::guard('teacher')->check()) 
                    @if($standard->session==$session && $standard->term==$term) 
                    <p>
                      <a href="{{ url('/staff/generate') }}/?session={{$session}}&term={{$term}}&class={{$class}}&form={{$form}}&subject={{$subject}}" class="btn btn-primary pull-right"> Regenerate Result Sheet</a>
                    </p>
                    @endif
                  @else
                    @if($standard->session==$session && $standard->term==$term) 
                    <p>
                      <a href="{{ url('/admin/generate') }}/?session={{$session}}&term={{$term}}&class={{$class}}&form={{$form}}&subject={{$subject}}" class="btn btn-primary pull-right"> Regenerate Result Sheet</a>
                    </p>
                    @endif
                  @endif


                    @if(!isset($ready))
                    <p>
                      <a  href="#" 
                          data-toggle="modal" 
                          data-target="#readyresult" 
                          class="btn btn-success pull-right"> Mark Result As Ready</a>
                    </p>
                    @endif
                  <button id="print" class="btn btn-warning pull-left" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                </div>
            </div>
            
            <div class="box-body">
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                     <table id="example2" class="table table-bordered table-hover">
                      <thead>
                        <tr>                           
                          <th>Fullname</th>
                          <th>Roll N0</th>

                          @if($setting->assessment==1)
                            <th>1st Assessment <span style="color:green">({{ $standard->test1 }}%)</span></th>
                          @elseif($setting->assessment==2)
                            <th>1st Assessment <span style="color:green">({{ $standard->test1 }}%)</span></th>
                            <th>2nd Assessment  <span style="color:green">({{ $standard->test2 }}%)</span></th>
                          @elseif($setting->assessment==3)
                            <th>1st Assessment <span style="color:green">({{ $standard->test1 }}%)</span></th>
                            <th>2nd Assessment <span style="color:green">({{ $standard->test2 }}%)</span></th>
                            <th>3rd Assessment <span style="color:green">({{ $standard->test3 }}%)</span></th>
                          @elseif($setting->assessment==4)
                            <th>1st Assessment <span style="color:green">({{ $standard->test1 }}%)</span></th>
                            <th>2nd Assessment <span style="color:green">({{ $standard->test2 }}%)</span></th>
                            <th>3rd Assessment <span style="color:green">({{ $standard->test3 }}%)</span></th>
                            <th>4th Assessment <span style="color:green">({{ $standard->test4 }}%)</span></th>
                          @else
                            <th>1st Assessment <span style="color:green">({{ $standard->test1 }}%)</span></th>
                            <th>2nd Assessment <span style="color:green">({{ $standard->test2 }}%)</span></th>
                            <th>3rd Assessment <span style="color:green">({{ $standard->test3 }}%)</span></th>
                            <th>4th Assessment <span style="color:green">({{ $standard->test4 }}%)</span></th>
                            <th>5th Assessment <span style="color:green">({{ $standard->test5 }}%)</span></th>
                          @endif

                          <th>Exam  <span style="color:green">({{ $standard->exam }}%)</span></th>
                          <th>Total  <span style="color:green">(100%)</span></th>
                          <th>Grade</th>
                          <th>Teacher's Comment</th>
                          @if(!isset($ready))
                            @if($standard->session==$session && $standard->term==$term)
                            <th>Edit Record</th>
                            @endif
                          @endif
                          @if(isset($ready))
                          <th>Signature</th>
                          @endif
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($results as $result)
                        <tr>                           
                          <td>{{ $result->lastname }} {{ $result->firstname }} {{ $result->middlename }}</td>
                          <td>{{ $result->roll }}</td>
                          @if($setting->assessment==1)
                            <td>{{ $result->first_test }}</td>
                          @elseif($setting->assessment==2)
                            <td>{{ $result->first_test }}</td>
                            <td>{{ $result->second_test }} </td> 
                          @elseif($setting->assessment==3)
                            <td>{{ $result->first_test }}</td>
                            <td>{{ $result->second_test }} </td> 
                            <td>{{ $result->third_test }}</td>
                          @elseif($setting->assessment==4)
                            <td>{{ $result->first_test }}</td>
                            <td>{{ $result->second_test }} </td> 
                            <td>{{ $result->third_test }}</td>
                            <td>{{ $result->forth_test }}</td>
                          @else
                            <td>{{ $result->first_test }}</td>
                            <td>{{ $result->second_test }} </td> 
                            <td>{{ $result->third_test }}</td>
                            <td>{{ $result->forth_test }}</td>
                            <td>{{ $result->fifth_test }}</td>
                          @endif
                          <td>{{ $result->exam }} </td>
                          <td>{{ $result->total }}</td>
                          <td>{{ $result->grade }} </td>
                          <td>{{ $result->comment }}</td>
                          @if($ready==NULL)
                            @if($standard->session==$session && $standard->term==$term) 
                              <td>
                                <a 
                                  class="open-AddBookDialog" 
                                  href="#" 
                                  data-toggle="modal" 
                                  data-target="#scoremodal" 
                                  data-id="{{$result->id}}"
                                  data-first="{{$result->first_test}}"
                                  data-second="{{$result->second_test}}"
                                  data-third="{{$result->third_test}}"
                                  data-forth ="{{$result->forth_test}}"
                                  data-fifth="{{$result->fifth_test}}"
                                  data-exam="{{$result->exam}}"
                                  data-name="{{$result->lastname}} {{$result->firstname}} {{$result->middlename}}"
                                  data-comment="{{$result->comment}}"> 
                                  <i class="fa fa-edit"></i> 
                                </a>
                              </td>                          
                            @endif
                          @endif
                          @if($ready!=NULL)
                          <td>{{ $result->sign }}</td>
                        @endif
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
        </div>
      </div>        
  </section>
  <!-- /.content -->
</div>

<div class="modal fade" id="readyresult" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog" style="background:white">
          <div class="modal-content">
            <div class="modal-body">
              <div style="text-align: center;">                
                <h4>
                  <span style="color: blue">Are You Sure?</span><hr>
                  Note that once you append your signature, you are agreeing that the result is set to be published and as such cannot be editted by you again. <br><br> If you wish to edit the result again, you have to contact the school admin.
                </h4>
                <p>
                  <span>
                    <a href="" class="btn btn-danger"> Cancel</a>
                  </span>
                  <span>
                    @if (Auth::guard('teacher')->check())
                      <a href="{{ url('/staff/sign') }}/?session={{$session}}&term={{$term}}&class={{$class}}&form={{$form}}&subject={{$subject}}" class="btn btn-success"> Append Signature</a>
                    @else
                      <a href="{{ url('/admin/sign') }}/?session={{$session}}&term={{$term}}&class={{$class}}&form={{$form}}&subject={{$subject}}" class="btn btn-success"> Append Signature</a>
                    @endif
                  </span>
                </p>
              </div>

            </div>
          </div><!-- /.modal-content -->                     
      </div>
  </div>


    <div class="modal fade" id="scoremodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog" style="background:white">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"> Add <b><span id="mainname"></span></b>Result</h4>
            </div>
            <div class="modal-body">
              @if (Auth::guard('teacher')->check()) 
                <form method="post" class="profile-wrapper" action="{{ url('staff/storeresult') }}" >
                   {{ csrf_field() }}
                   {{ method_field('PUT') }}
                    <span id="mainname"></span>
                    <div class="form-group">
                        <label for="fname">Student Name</label>                     
                        <input class="form-control" type="text" name="name" id="mainname" readonly="true">                     
                    </div>

                    @if($setting->assessment==1)
                      <div class="form-group">
                        <label for="fname">First Assessment ({{ $standard->test1}} Marks)</label>   
                        <input type="hidden" name="id" id="mainid">                   
                        <input class="form-control" type="number" max="{{ $standard->test1 }}" name="first_test" id="mainfirst" required autofocus>                     
                      </div>
                    @elseif($setting->assessment==2)
                      <div class="form-group">
                        <label for="fname">First Assessment ({{ $standard->test1}} Marks)</label>   
                        <input type="hidden" name="id" id="mainid">                   
                        <input class="form-control" type="number" max="{{ $standard->test1 }}" name="first_test" id="mainfirst" required autofocus>                     
                      </div>
                      
                      <div class="form-group">
                          <label for="fname">Second Assessment ({{ $standard->test2 }} Marks)</label>                   
                          <input class="form-control" type="number" max="{{ $standard->test2 }}" name="second_test" id="mainsecond" required autofocus>                     
                      </div>
                    @elseif($setting->assessment==3)
                    <div class="form-group">
                        <label for="fname">First Assessment ({{ $standard->test1}} Marks)</label>   
                        <input type="hidden" name="id" id="mainid">                   
                        <input class="form-control" type="number" max="{{ $standard->test1 }}" name="first_test" id="mainfirst" required autofocus>                     
                      </div>
                      
                      <div class="form-group">
                          <label for="fname">Second Assessment ({{ $standard->test2 }} Marks)</label>                   
                          <input class="form-control" type="number" max="{{ $standard->test2 }}" name="second_test" id="mainsecond" required autofocus>                     
                      </div>

                      <div class="form-group">
                          <label for="fname">Third Assessment ({{ $standard->test3 }} Marks)</label>                   
                          <input class="form-control" type="number" max="{{ $standard->test3 }}" name="third_test" id="mainthird" required autofocus>                     
                      </div>
                    @elseif($setting->assessment==4)
                      <div class="form-group">
                        <label for="fname">First Assessment ({{ $standard->test1}} Marks)</label>   
                        <input type="hidden" name="id" id="mainid">                   
                        <input class="form-control" type="number" max="{{ $standard->test1 }}" name="first_test" id="mainfirst" required autofocus>                     
                      </div>
                      
                      <div class="form-group">
                          <label for="fname">Second Assessment ({{ $standard->test2 }} Marks)</label>                   
                          <input class="form-control" type="number" max="{{ $standard->test2 }}" name="second_test" id="mainsecond" required autofocus>                     
                      </div>

                      <div class="form-group">
                          <label for="fname">Third Assessment ({{ $standard->test3 }} Marks)</label>                   
                          <input class="form-control" type="number" max="{{ $standard->test3 }}" name="third_test" id="mainthird" required autofocus>                     
                      </div>

                      <div class="form-group">
                          <label for="fname">Forth Assessment ({{ $standard->test4 }} Marks)</label>                   
                          <input class="form-control" type="number" max="{{ $standard->test4 }}" name="forth_test" id="mainforth" required autofocus>                     
                      </div>
                    @else
                    <div class="form-group">
                        <label for="fname">First Assessment ({{ $standard->test1}} Marks)</label>   
                        <input type="hidden" name="id" id="mainid">                   
                        <input class="form-control" type="number" max="{{ $standard->test1 }}" name="first_test" id="mainfirst" required autofocus>                     
                      </div>
                      
                      <div class="form-group">
                          <label for="fname">Second Assessment ({{ $standard->test2 }} Marks)</label>                   
                          <input class="form-control" type="number" max="{{ $standard->test2 }}" name="second_test" id="mainsecond" required autofocus>                     
                      </div>

                      <div class="form-group">
                          <label for="fname">Third Assessment ({{ $standard->test3 }} Marks)</label>                   
                          <input class="form-control" type="number" max="{{ $standard->test3 }}" name="third_test" id="mainthird" required autofocus>                     
                      </div>

                      <div class="form-group">
                          <label for="fname">Forth Assessment ({{ $standard->test4 }} Marks)</label>                   
                          <input class="form-control" type="number" max="{{ $standard->test4 }}" name="forth_test" id="mainforth" required autofocus>                     
                      </div>

                      <div class="form-group">
                          <label for="fname">Fifth Assessment ({{ $standard->test5 }} Marks)</label>                   
                          <input class="form-control" type="number" max="{{ $standard->test5 }}" name="fifth_test" id="mainfifth" required autofocus>                     
                      </div>
                    @endif
                    

                    <div class="form-group">
                        <label for="fname">Examination ({{ $standard->exam }} Marks)</label>                   
                        <input class="form-control" type="number" max="{{ $standard->exam }}" name="exam" id="mainexam" required autofocus>                     
                    </div>

                    <div class="form-group">
                        <label for="fname">Comment</label>    
                        <textarea class="form-control" id="maincomment" name="comment" width="840px" height="1000px"></textarea>               
                    </div>

                    <button type="submit" class="btn btn-success pull-right">Save <i class="fa fa-save"></i></button>                              
                </form>
              @else
                 <form method="post" class="profile-wrapper" action="{{ url('admin/storeresult') }}" >
                 {{ csrf_field() }}
                 {{ method_field('PUT') }}
                  <span id="mainname"></span>
                  <div class="form-group">
                      <label for="fname">Student Name</label>                     
                      <input class="form-control" type="text" name="name" id="mainname" readonly="true">                     
                  </div>

                  @if($setting->assessment==1)
                    <div class="form-group">
                      <label for="fname">First Assessment ({{ $standard->test1}} Marks)</label>   
                      <input type="hidden" name="id" id="mainid">                   
                      <input class="form-control" type="number" max="{{ $standard->test1 }}" name="first_test" id="mainfirst" required autofocus>                     
                    </div>
                  @elseif($setting->assessment==2)
                    <div class="form-group">
                      <label for="fname">First Assessment ({{ $standard->test1}} Marks)</label>   
                      <input type="hidden" name="id" id="mainid">                   
                      <input class="form-control" type="number" max="{{ $standard->test1 }}" name="first_test" id="mainfirst" required autofocus>                     
                    </div>
                    
                    <div class="form-group">
                        <label for="fname">Second Assessment ({{ $standard->test2 }} Marks)</label>                   
                        <input class="form-control" type="number" max="{{ $standard->test2 }}" name="second_test" id="mainsecond" required autofocus>                     
                    </div>
                  @elseif($setting->assessment==3)
                  <div class="form-group">
                      <label for="fname">First Assessment ({{ $standard->test1}} Marks)</label>   
                      <input type="hidden" name="id" id="mainid">                   
                      <input class="form-control" type="number" max="{{ $standard->test1 }}" name="first_test" id="mainfirst" required autofocus>                     
                    </div>
                    
                    <div class="form-group">
                        <label for="fname">Second Assessment ({{ $standard->test2 }} Marks)</label>                   
                        <input class="form-control" type="number" max="{{ $standard->test2 }}" name="second_test" id="mainsecond" required autofocus>                     
                    </div>

                    <div class="form-group">
                        <label for="fname">Third Assessment ({{ $standard->test3 }} Marks)</label>                   
                        <input class="form-control" type="number" max="{{ $standard->test3 }}" name="third_test" id="mainthird" required autofocus>                     
                    </div>
                  @elseif($setting->assessment==4)
                    <div class="form-group">
                      <label for="fname">First Assessment ({{ $standard->test1}} Marks)</label>   
                      <input type="hidden" name="id" id="mainid">                   
                      <input class="form-control" type="number" max="{{ $standard->test1 }}" name="first_test" id="mainfirst" required autofocus>                     
                    </div>
                    
                    <div class="form-group">
                        <label for="fname">Second Assessment ({{ $standard->test2 }} Marks)</label>                   
                        <input class="form-control" type="number" max="{{ $standard->test2 }}" name="second_test" id="mainsecond" required autofocus>                     
                    </div>

                    <div class="form-group">
                        <label for="fname">Third Assessment ({{ $standard->test3 }} Marks)</label>                   
                        <input class="form-control" type="number" max="{{ $standard->test3 }}" name="third_test" id="mainthird" required autofocus>                     
                    </div>

                    <div class="form-group">
                        <label for="fname">Forth Assessment ({{ $standard->test4 }} Marks)</label>                   
                        <input class="form-control" type="number" max="{{ $standard->test4 }}" name="forth_test" id="mainforth" required autofocus>                     
                    </div>
                  @else
                  <div class="form-group">
                      <label for="fname">First Assessment ({{ $standard->test1}} Marks)</label>   
                      <input type="hidden" name="id" id="mainid">                   
                      <input class="form-control" type="number" max="{{ $standard->test1 }}" name="first_test" id="mainfirst" required autofocus>                     
                    </div>
                    
                    <div class="form-group">
                        <label for="fname">Second Assessment ({{ $standard->test2 }} Marks)</label>                   
                        <input class="form-control" type="number" max="{{ $standard->test2 }}" name="second_test" id="mainsecond" required autofocus>                     
                    </div>

                    <div class="form-group">
                        <label for="fname">Third Assessment ({{ $standard->test3 }} Marks)</label>                   
                        <input class="form-control" type="number" max="{{ $standard->test3 }}" name="third_test" id="mainthird" required autofocus>                     
                    </div>

                    <div class="form-group">
                        <label for="fname">Forth Assessment ({{ $standard->test4 }} Marks)</label>                   
                        <input class="form-control" type="number" max="{{ $standard->test4 }}" name="forth_test" id="mainforth" required autofocus>                     
                    </div>

                    <div class="form-group">
                        <label for="fname">Fifth Assessment ({{ $standard->test5 }} Marks)</label>                   
                        <input class="form-control" type="number" max="{{ $standard->test5 }}" name="fifth_test" id="mainfifth" required autofocus>                     
                    </div>
                  @endif
                  

                  <div class="form-group">
                      <label for="fname">Examination ({{ $standard->exam }} Marks)</label>                   
                      <input class="form-control" type="number" max="{{ $standard->exam }}" name="exam" id="mainexam" required autofocus>                     
                  </div>

                  <div class="form-group">
                      <label for="fname">Comment</label>    
                      <textarea class="form-control" id="maincomment" name="comment" width="840px" height="1000px"></textarea>               
                  </div>

                  <button type="submit" class="btn btn-success pull-right">Save <i class="fa fa-save"></i></button>                              
              </form>
              @endif
            </div>
            
            <div class="modal-footer">
             
            </div>
          </div><!-- /.modal-content -->                     
      </div>
    </div>
      <script>
  //result modal
  $(document).on("click", ".open-AddBookDialog", function () {
     var studentId = $(this).data('id');
     var studentname = $(this).data('name');
     var studentfirst = $(this).data('first');
     var studentsecond = $(this).data('second');
     var studentthird = $(this).data('third');
     var studentforth = $(this).data('forth');
     var studentfifth = $(this).data('fifth');
     var studentexam = $(this).data('exam');
     var studentcomment = $(this).data('comment');

     $(".modal-body #mainid").val( studentId );
     $(".modal-body #mainname").val( studentname );

     $(".modal-body #mainfirst").val( studentfirst );
     $(".modal-body #mainsecond").val( studentsecond );
     $(".modal-body #mainthird").val( studentthird );
     $(".modal-body #mainforth").val( studentforth );
     $(".modal-body #mainfifth").val( studentfifth );
     
     $(".modal-body #mainexam").val( studentexam );
     $(".modal-body #maincomment").val( studentcomment );
    $('#scoremodal').modal('show');
  });
</script>
@endsection
