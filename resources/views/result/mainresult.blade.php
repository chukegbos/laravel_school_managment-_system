@extends('layouts.admin')
@section('pageTitle', 'Result Sheet')
@section('content')
<div class="content-wrapper">
  <section class="content-header" style="height: auto; padding: 10px">
    <p style=" text-align: center; font-weight: bolder">
      <span style="color: green; font-size: 25px;">Result sheet</span><br>
      <span style="font-size: 16px">{{ $term }}</span><br>
      <span style="font-size: 16px"> {{ $sessionsname }} Academic Session</span><br>
      <span style="font-size: 16px">{{ $classname }}</span><br>
      <span style="font-size: 16px"> {{ $subjectname }}</span><br><br>
      </p>
      <p style=" text-align: center; font-weight: bolder">
      @if((!isset($ready)) || ($ready==NULL) )
        <a class="btn btn-primary btn-xs" href="{{ url('/admin/readyresult') }}/?session={{$session}}&term={{$term}}&class={{$class}}&subject={{$subject}}" style="margin-top: -20px;">Mark Result As Ready</a>
      @else
        <a class="btn btn-primary btn-xs" href="{{ url('/admin/readyresult') }}/?session={{$session}}&term={{$term}}&class={{$class}}&subject={{$subject}}" style="margin-top: -20px;">Mark Result As Not Ready</a>
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
                    <th>Action</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($results as $result)
                  <tr>                           
                    <td>{{ $result->fullname }}</td>
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
                 
                    
                      <td>
                        <a href="#" data-toggle="modal" data-target="#editmodal{{ $result->id }}" >
                          <i class="fa fa-edit"></i>  Edit
                        </a>
                      </td>  
                      <div class="modal fade" id="editmodal{{ $result->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog" style="background:white">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title"> Add <b><span id="mainname"></span></b>Result</h4>
                            </div>
                            <form method="post" class="profile-wrapper" action="{{ url('admin/storeresult') }}" >
                              <div class="modal-body">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                  <label for="fname">Student Roll</label>                     
                                  <input class="form-control" type="text" name="name" value="{{ $result->fullname }}" readonly="true">
                                  <input type="hidden" name="session" value="{{ $session}}">
                                  <input type="hidden" name="term" value="{{ $term}}">
                                </div>
                                @if($setting->assessment==1)
                                  <div class="form-group">
                                    <label for="fname">First Assessment ({{ $standard->test1}} Marks)</label>   
                                    <input type="hidden" name="id" value="{{ $result->id }}">
                                    <input id="myInput1" oninput="myFunction()" class="form-control" type="number" max="{{ $standard->test1 }}" name="first_test" value="{{ $result->first_test }}" required autofocus>                 
                                  </div>
                             
                                  <script>
                                    function myFunction() {
                                        var x = document.getElementById("myInput1").value;
                                        var exam = document.getElementById("exam").value;
                                        document.getElementById("demo").innerHTML = parseFloat(x) + parseFloat(exam);
                                    }
                                  </script>
                                @elseif($setting->assessment==2)
                                  <div class="form-group">
                                    <label for="fname">First Assessment ({{ $standard->test1}} Marks)</label>   
                                    <input type="hidden" name="id" value="{{ $result->id }}">                  
                                    <input  id="myInput1" oninput="myFunction()" class="form-control" type="number" max="{{ $standard->test1 }}" name="first_test" value="{{ $result->first_test }}" required autofocus>                     
                                  </div>
                                  
                                  <div class="form-group">
                                      <label for="fname">Second Assessment ({{ $standard->test2 }} Marks)</label>                   
                                      <input id="myInput2" oninput="myFunction()" class="form-control" type="number" max="{{ $standard->test2 }}" name="second_test" value="{{ $result->second_test }}" required autofocus>                     
                                  </div>
                                    <script>
                                      function myFunction() {
                                          var x = document.getElementById("myInput1").value;
                                          var y = document.getElementById("myInput2").value;
                                          var exam = document.getElementById("exam").value;
                                          document.getElementById("demo").innerHTML = parseFloat(x) + parseFloat(y) + parseFloat(exam);;
                                      }
                                    </script>
                                @elseif($setting->assessment==3)
                                  <div class="form-group">
                                    <label for="fname">First Assessment ({{ $standard->test1}} Marks)</label>   
                                    <input type="hidden" name="id" value="{{ $result->id }}">                  
                                    <input id="myInput1" oninput="myFunction()"  class="form-control" type="number" max="{{ $standard->test1 }}" name="first_test" value="{{ $result->first_test }}" required autofocus>                     
                                  </div>
                                  
                                  <div class="form-group">
                                      <label for="fname">Second Assessment ({{ $standard->test2 }} Marks)</label>                   
                                      <input id="myInput2" oninput="myFunction()" class="form-control" type="number" max="{{ $standard->test2 }}" name="second_test" value="{{ $result->second_test }}" required autofocus>                     
                                  </div>

                                  <div class="form-group">
                                      <label for="fname">Third Assessment ({{ $standard->test3 }} Marks)</label>                   
                                      <input id="myInput3" oninput="myFunction()" class="form-control" type="number" max="{{ $standard->test3 }}" name="third_test" value="{{ $result->third_test }}" required autofocus>                     
                                  </div>

                                  <script>
                                    function myFunction() {
                                      var x = document.getElementById("myInput1").value;
                                      var y = document.getElementById("myInput2").value;
                                      var z = document.getElementById("myInput3").value;
                                      var exam = document.getElementById("exam").value;
                                      document.getElementById("demo").innerHTML = parseFloat(x) + parseFloat(y) + parseFloat(z) + parseFloat(exam);
                                      }
                                    </script>
                                @elseif($setting->assessment==4)
                                  <div class="form-group">
                                    <label for="fname">First Assessment ({{ $standard->test1}} Marks)</label>   
                                    <input type="hidden" name="id" value="{{ $result->id }}">                  
                                    <input id="myInput1" oninput="myFunction()"  class="form-control" type="number" max="{{ $standard->test1 }}" name="first_test" value="{{ $result->first_test }}" required autofocus>                     
                                  </div>
                                  
                                  <div class="form-group">
                                      <label for="fname">Second Assessment ({{ $standard->test2 }} Marks)</label>                   
                                      <input id="myInput2" oninput="myFunction()"  class="form-control" type="number" max="{{ $standard->test2 }}" name="second_test" value="{{ $result->second_test }}" required autofocus>                     
                                  </div>

                                  <div class="form-group">
                                      <label for="fname">Third Assessment ({{ $standard->test3 }} Marks)</label>                   
                                      <input id="myInput3" oninput="myFunction()"  class="form-control" type="number" max="{{ $standard->test3 }}" name="third_test" value="{{ $result->third_test }}" required autofocus>                     
                                  </div>

                                  <div class="form-group">
                                      <label for="fname">Forth Assessment ({{ $standard->test4 }} Marks)</label>                   
                                      <input id="myInput4" oninput="myFunction()" class="form-control" type="number" max="{{ $standard->test4 }}" name="forth_test" value="{{ $result->forth_test }}" required autofocus>                     
                                  </div>

                                  <script>
                                    function myFunction() {
                                      var x = document.getElementById("myInput1").value;
                                      var y = document.getElementById("myInput2").value;
                                      var z = document.getElementById("myInput3").value;
                                      var a = document.getElementById("myInput4").value;
                                      var exam = document.getElementById("exam").value;
                                      document.getElementById("demo").innerHTML = parseFloat(x) + parseFloat(y) + parseFloat(z) + parseFloat(a) + parseFloat(exam);
                                      }
                                    </script>
                                @else
                                  <div class="form-group">
                                    <label for="fname">First Assessment ({{ $standard->test1}} Marks)</label>   
                                    <input type="hidden" name="id" value="{{ $result->id }}">                  
                                    <input id="myInput1" oninput="myFunction()" class="form-control" type="number" max="{{ $standard->test1 }}" name="first_test" value="{{ $result->first_test }}" required autofocus>                     
                                  </div>
                                  
                                  <div class="form-group">
                                      <label for="fname">Second Assessment ({{ $standard->test2 }} Marks)</label>                   
                                      <input id="myInput2" oninput="myFunction()" class="form-control" type="number" max="{{ $standard->test2 }}" name="second_test" value="{{ $result->second_test }}" required autofocus>                     
                                  </div>

                                  <div class="form-group">
                                      <label for="fname">Third Assessment ({{ $standard->test3 }} Marks)</label>                   
                                      <input id="myInput3" oninput="myFunction()" class="form-control" type="number" max="{{ $standard->test3 }}" name="third_test" value="{{ $result->third_test }}" required autofocus>                     
                                  </div>

                                  <div class="form-group">
                                      <label for="fname">Forth Assessment ({{ $standard->test4 }} Marks)</label>                   
                                      <input id="myInput4" oninput="myFunction()" class="form-control" type="number" max="{{ $standard->test4 }}" name="forth_test" value="{{ $result->forth_test }}"required autofocus>                     
                                  </div>

                                  <div class="form-group">
                                      <label for="fname">Fifth Assessment ({{ $standard->test5 }} Marks)</label>                   
                                      <input id="myInput5" oninput="myFunction()" class="form-control" type="number" max="{{ $standard->test5 }}" name="fifth_test" value="{{ $result->fifth_test }}" required autofocus>                     
                                  </div>

                                  <script>
                                    function myFunction() {
                                      var x = document.getElementById("myInput1").value;
                                      var y = document.getElementById("myInput2").value;
                                      var z = document.getElementById("myInput3").value;
                                      var a = document.getElementById("myInput4").value;
                                      var b = document.getElementById("myInput5").value;
                                      var exam = document.getElementById("exam").value;
                                      document.getElementById("demo").innerHTML = parseFloat(x) + parseFloat(y) + parseFloat(z) + parseFloat(a) + parseFloat(b) + parseFloat(exam);
                                      }
                                    </script>
                                @endif
                                <div class="form-group">
                                  <label for="fname">Examination ({{ $standard->exam }} Marks)</label>
                                  <input id="exam" oninput="myFunction()" class="form-control" type="number" max="{{ $standard->exam }}" name="exam" value="{{ $result->exam }}" required autofocus>                
                                </div>

                                

                                <div class="form-group">
                                  <label for="fname">Total</label>
                                  <p id="demo" style="font-size: 20px; font-weight: bolder;"></p>
                                </div>

                                <div class="form-group">
                                  <label for="fname">Comment</label>    
                                  <textarea class="form-control" name="comment" width="840px" height="1000px">
                                    {{ $result->comment }}
                                  </textarea>               
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-success pull-right">Save <i class="fa fa-save"></i></button> 
                              </div>
                            </form>
                          </div><!-- /.modal-content -->                     
                        </div>
                      </div>
                    @if($ready==NULL && $term!="Annual") 
                      <td><span style="color: red">Not Ready</span></td>             
                    @else
                      <td><span style="color: green">Ready</span></td>
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
  </section>
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
                    
                      <a href="{{ url('/staff/sign') }}/?session={{$session}}&term={{$term}}&class={{$class}}&subject={{$subject}}" class="btn btn-success"> Append Signature</a>
                  
                      <a href="{{ url('/admin/sign') }}/?session={{$session}}&term={{$term}}&class={{$class}}&subject={{$subject}}" class="btn btn-success"> Append Signature</a>
               
                  </span>
                </p>
              </div>

            </div>
          </div><!-- /.modal-content -->                     
      </div>
</div>
@endsection
