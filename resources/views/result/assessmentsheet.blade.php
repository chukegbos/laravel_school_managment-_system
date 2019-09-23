@extends('layouts.admin')
@section('pageTitle', 'Assessment Grading' )
@section('content')

<div class="content-wrapper">
  <section class="content-header" style="height: auto padding: 10px">
    <p style=" text-align: center; font-weight: bolder">
      <span style="color: green; font-size: 25px">BEHAVIOURAL ASSESSMENT</span><br>
      <span style="font-size: 16px">{{ $term }}</span><br>
      <span style="font-size: 16px"> {{ $sessionsname }} Academic Session</span><br>
      <span style="font-size: 16px">{{ $classname }}</span>
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
                    <th>Student</th>
                    <th>Teachers Comment</th>
                    <th>Head Teacher/Principal Comment</th>
                    <th>No of Days Present</th>
                    <th>No of Days Absent</th>
                  
                    <th>Handwriting</th>
                    <th>Verbal Fluency</th>
                    <th>Games/Sports</th>

                    <th>Construction</th>
                    <th>Drawing</th>
                    <th>Musicals</th>
                    

                    <th>Punctuality</th>
                    <th>Alertness</th>
                    <th>Attendance</th>
                    <th>Neatness</th>
                    <th>Politness</th>

                    <th>Honesty</th>
                    <th>Physical Development</th>
                    <th>Friendship</th>
                    <th>Self Control</th>

                    <th>Industrious</th>
                    <th>Generousity</th>
                    <th>Adjustment</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($results as $assessment)
                    <tr>
                      <td>{{ $assessment->fullname }} <br> {{ $assessment->roll }}</td>
                      <td>{{ $assessment->teacher_comment}}<br>
                        <a href="#" data-toggle="modal" data-target="#editmodal{{ $assessment->id }}"><i class="fa fa-edit">Edit</i> </a>
                      </td>
                      <td>{{ $assessment->principal_comment}}</td>
                      <td>{{ $assessment->present}}</td>
                      <td>{{ $assessment->absent}}</td>
                      
                      <td>{{ $assessment->handwriting }} </td>
                      <td>{{ $assessment->verbal_fluency }} </td>
                      <td>{{ $assessment->games }} </td>
                      <td>{{ $assessment->construction }} </td>
                      <td>{{ $assessment->drawing }} </td>
                      <td>{{ $assessment->musical }} </td>
                    
                      <td>{{ $assessment->punctiality }} </td>
                      <td>{{ $assessment->alertness }} </td>
                      <td>{{ $assessment->attendance }} </td>
                      <td>{{ $assessment->neatness }} </td>
                      <td>{{ $assessment->politeness }} </td>
                      <td>{{ $assessment->honesty }} </td>
                      <td>{{ $assessment->physical_development }} </td>
                      <td>{{ $assessment->friendship }} </td>
                      <td>{{ $assessment->self_control }} </td>
                      <td>{{ $assessment->industrious }} </td>
                      <td>{{ $assessment->generousity }} </td>
                      <td>{{ $assessment->adjustment }} </td>
                    </tr>


                    <div class="modal fade" id="editmodal{{ $assessment->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                      <div class="modal-dialog" style="background:white; width: 900px">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title"> Edit <b>{{ $assessment->fullname }}'s </b>Assessment</h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" class="profile-wrapper" action="{{ url('admin/assessmentsheet') }}">
                                  {{ csrf_field() }}            
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="fname"> Head Teacher/Principal's Comment</label>
                                              <textarea name="principal_comment" class="form-control">{{ $assessment->principal_comment }}</textarea>
                                          </div>
                                      </div>

                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="fname"> Teacher's Comment</label>
                                              <input type="hidden" name="id" value="{{ $assessment->id}}">
                                              <textarea name="teacher_comment" class="form-control">{{ $assessment->teacher_comment }}</textarea>
                                          </div>
                                      </div>

                                      <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname"> Append Principal/Head Teacher's Signature With Date</label>
                                                @if($assessment->principal_sign!=NULL)
                                                    <input type="date" name="principal_sign" value="{{ $assessment->principal_sign->format('Y-m-d') }}" class="form-control" required="">
                                                @else
                                                    <input type="date" name="principal_sign" class="form-control" required="">
                                                @endif
                                          </div>
                                      </div>

                                      <div class="col-md-6">
                                          <div class="form-group">
                                                <label for="fname">  Append Teacher's Signature With Date</label>
                                                @if($assessment->teacher_sign!=NULL)
                                                    <input type="date" name="teacher_sign" value="{{ $assessment->teacher_sign->format('Y-m-d') }}" class="form-control" required="">
                                                @else
                                                    <input type="date" name="teacher_sign" class="form-control" required="">
                                                @endif
                                          </div>
                                      </div>

                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="fname"> No of Days Present</label>
                                              <input type="number" name="present" value="{{ $assessment->present }}" class="form-control" required="">
                                          </div>
                                      </div>

                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="fname"> No of Days Absent</label>
                                              <input type="number" name="absent" value="{{ $assessment->absent }}" class="form-control" required="">
                                          </div>
                                      </div>


                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="fname"> Hand Writing</label>
                                              <select name="handwriting" class="form-control">
                                                  <option {{ $assessment->handwriting == 'A' ? 'selected' : '' }}  value="A">A</option>
                                                  <option {{ $assessment->handwriting == 'B' ? 'selected' : '' }}  value="B">B</option>
                                                  <option {{ $assessment->handwriting == 'C' ? 'selected' : '' }}  value="C">C</option>
                                                  <option {{ $assessment->handwriting == 'D' ? 'selected' : '' }}  value="D">D</option>
                                                  <option {{ $assessment->handwriting == 'E' ? 'selected' : '' }}  value="E">E</option>
                                                  <option {{ $assessment->handwriting == 'F' ? 'selected' : '' }}  value="F">F</option>
                                                  <option {{ $assessment->handwriting == NULL ? 'selected' : '' }} value="">Select</option>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="fname"> Verbal Fluency</label>
                                              <select name="verbal_fluency" class="form-control">
                                                  <option {{ $assessment->verbal_fluency == 'A' ? 'selected' : '' }}  value="A">A</option>
                                                  <option {{ $assessment->verbal_fluency == 'B' ? 'selected' : '' }}  value="B">B</option>
                                                  <option {{ $assessment->verbal_fluency == 'C' ? 'selected' : '' }}  value="C">C</option>
                                                  <option {{ $assessment->verbal_fluency == 'D' ? 'selected' : '' }}  value="D">D</option>
                                                  <option {{ $assessment->verbal_fluency == 'E' ? 'selected' : '' }}  value="E">E</option>
                                                  <option {{ $assessment->verbal_fluency == 'F' ? 'selected' : '' }}  value="F">F</option>
                                                  <option {{ $assessment->verbal_fluency == NULL ? 'selected' : '' }} value="">Select</option>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="fname"> Games</label>
                                              <select name="games" class="form-control">
                                                  <option {{ $assessment->games == 'A' ? 'selected' : '' }}  value="A">A</option>
                                                  <option {{ $assessment->games == 'B' ? 'selected' : '' }}  value="B">B</option>
                                                  <option {{ $assessment->games == 'C' ? 'selected' : '' }}  value="C">C</option>
                                                  <option {{ $assessment->games == 'D' ? 'selected' : '' }}  value="D">D</option>
                                                  <option {{ $assessment->games == 'E' ? 'selected' : '' }}  value="E">E</option>
                                                  <option {{ $assessment->games == 'F' ? 'selected' : '' }}  value="F">F</option>
                                                  <option {{ $assessment->games == NULL ? 'selected' : '' }} value="">Select</option>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="fname"> Construction</label>
                                              <select name="construction" class="form-control">
                                                  <option {{ $assessment->construction == 'A' ? 'selected' : '' }}  value="A">A</option>
                                                  <option {{ $assessment->construction == 'B' ? 'selected' : '' }}  value="B">B</option>
                                                  <option {{ $assessment->construction == 'C' ? 'selected' : '' }}  value="C">C</option>
                                                  <option {{ $assessment->construction == 'D' ? 'selected' : '' }}  value="D">D</option>
                                                  <option {{ $assessment->construction == 'E' ? 'selected' : '' }}  value="E">E</option>
                                                  <option {{ $assessment->construction == 'F' ? 'selected' : '' }}  value="F">F</option>
                                                  <option {{ $assessment->construction == NULL ? 'selected' : '' }} value="">Select</option>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="fname"> Drawing</label>
                                              <select name="drawing" class="form-control">
                                                  <option {{ $assessment->drawing == 'A' ? 'selected' : '' }}  value="A">A</option>
                                                  <option {{ $assessment->drawing == 'B' ? 'selected' : '' }}  value="B">B</option>
                                                  <option {{ $assessment->drawing == 'C' ? 'selected' : '' }}  value="C">C</option>
                                                  <option {{ $assessment->drawing == 'D' ? 'selected' : '' }}  value="D">D</option>
                                                  <option {{ $assessment->drawing == 'E' ? 'selected' : '' }}  value="E">E</option>
                                                  <option {{ $assessment->drawing == 'F' ? 'selected' : '' }}  value="F">F</option>
                                                  <option {{ $assessment->drawing == NULL ? 'selected' : '' }} value="">Select</option>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="fname"> musical</label>
                                              <select name="musical" class="form-control">
                                                  <option {{ $assessment->musical == 'A' ? 'selected' : '' }}  value="A">A</option>
                                                  <option {{ $assessment->musical == 'B' ? 'selected' : '' }}  value="B">B</option>
                                                  <option {{ $assessment->musical == 'C' ? 'selected' : '' }}  value="C">C</option>
                                                  <option {{ $assessment->musical == 'D' ? 'selected' : '' }}  value="D">D</option>
                                                  <option {{ $assessment->musical == 'E' ? 'selected' : '' }}  value="E">E</option>
                                                  <option {{ $assessment->musical == 'F' ? 'selected' : '' }}  value="F">F</option>
                                                  <option {{ $assessment->musical == NULL ? 'selected' : '' }} value="">Select</option>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="fname"> Punctuality</label>
                                              <select name="punctiality" class="form-control">
                                                  <option {{ $assessment->punctiality == 'A' ? 'selected' : '' }}  value="A">A</option>
                                                  <option {{ $assessment->punctiality == 'B' ? 'selected' : '' }}  value="B">B</option>
                                                  <option {{ $assessment->punctiality == 'C' ? 'selected' : '' }}  value="C">C</option>
                                                  <option {{ $assessment->punctiality == 'D' ? 'selected' : '' }}  value="D">D</option>
                                                  <option {{ $assessment->punctiality == 'E' ? 'selected' : '' }}  value="E">E</option>
                                                  <option {{ $assessment->punctiality == 'F' ? 'selected' : '' }}  value="F">F</option>
                                                  <option {{ $assessment->punctiality == NULL ? 'selected' : '' }} value="">Select</option>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="fname"> Alertness</label>
                                              <select name="alertness" class="form-control">
                                                  <option {{ $assessment->alertness == 'A' ? 'selected' : '' }}  value="A">A</option>
                                                  <option {{ $assessment->alertness == 'B' ? 'selected' : '' }}  value="B">B</option>
                                                  <option {{ $assessment->alertness == 'C' ? 'selected' : '' }}  value="C">C</option>
                                                  <option {{ $assessment->alertness == 'D' ? 'selected' : '' }}  value="D">D</option>
                                                  <option {{ $assessment->alertness == 'E' ? 'selected' : '' }}  value="E">E</option>
                                                  <option {{ $assessment->alertness == 'F' ? 'selected' : '' }}  value="F">F</option>
                                                  <option {{ $assessment->alertness == NULL ? 'selected' : '' }} value="">Select</option>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="fname"> Attendance</label>
                                              <select name="attendance" class="form-control">
                                                  <option {{ $assessment->attendance == 'A' ? 'selected' : '' }}  value="A">A</option>
                                                  <option {{ $assessment->attendance == 'B' ? 'selected' : '' }}  value="B">B</option>
                                                  <option {{ $assessment->attendance == 'C' ? 'selected' : '' }}  value="C">C</option>
                                                  <option {{ $assessment->attendance == 'D' ? 'selected' : '' }}  value="D">D</option>
                                                  <option {{ $assessment->attendance == 'E' ? 'selected' : '' }}  value="E">E</option>
                                                  <option {{ $assessment->attendance == 'F' ? 'selected' : '' }}  value="F">F</option>
                                                  <option {{ $assessment->attendance == NULL ? 'selected' : '' }} value="">Select</option>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="fname"> Neatness</label>
                                              <select name="neatness" class="form-control">
                                                  <option {{ $assessment->neatness == 'A' ? 'selected' : '' }}  value="A">A</option>
                                                  <option {{ $assessment->neatness == 'B' ? 'selected' : '' }}  value="B">B</option>
                                                  <option {{ $assessment->neatness == 'C' ? 'selected' : '' }}  value="C">C</option>
                                                  <option {{ $assessment->neatness == 'D' ? 'selected' : '' }}  value="D">D</option>
                                                  <option {{ $assessment->neatness == 'E' ? 'selected' : '' }}  value="E">E</option>
                                                  <option {{ $assessment->neatness == 'F' ? 'selected' : '' }}  value="F">F</option>
                                                 <option {{ $assessment->neatness == NULL ? 'selected' : '' }} value="">Select</option>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="fname"> Politeness</label>
                                              <select name="politeness" class="form-control">
                                                  <option {{ $assessment->politeness == 'A' ? 'selected' : '' }}  value="A">A</option>
                                                  <option {{ $assessment->politeness == 'B' ? 'selected' : '' }}  value="B">B</option>
                                                  <option {{ $assessment->politeness == 'C' ? 'selected' : '' }}  value="C">C</option>
                                                  <option {{ $assessment->politeness == 'D' ? 'selected' : '' }}  value="D">D</option>
                                                  <option {{ $assessment->politeness == 'E' ? 'selected' : '' }}  value="E">E</option>
                                                  <option {{ $assessment->politeness == 'F' ? 'selected' : '' }}  value="F">F</option>
                                                  <option {{ $assessment->politeness == NULL ? 'selected' : '' }} value="">Select</option>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="fname"> Honesty</label>
                                              <select name="honesty" class="form-control">
                                                  <option {{ $assessment->honesty == 'A' ? 'selected' : '' }}  value="A">A</option>
                                                  <option {{ $assessment->honesty == 'B' ? 'selected' : '' }}  value="B">B</option>
                                                  <option {{ $assessment->honesty == 'C' ? 'selected' : '' }}  value="C">C</option>
                                                  <option {{ $assessment->honesty == 'D' ? 'selected' : '' }}  value="D">D</option>
                                                  <option {{ $assessment->honesty == 'E' ? 'selected' : '' }}  value="E">E</option>
                                                  <option {{ $assessment->honesty == 'F' ? 'selected' : '' }}  value="F">F</option>
                                                  <option {{ $assessment->honesty == NULL ? 'selected' : '' }} value="">Select</option>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="fname"> Physical Development</label>
                                              <select name="physical_development" class="form-control">
                                                  <option {{ $assessment->physical_development == 'A' ? 'selected' : '' }}  value="A">A</option>
                                                  <option {{ $assessment->physical_development == 'B' ? 'selected' : '' }}  value="B">B</option>
                                                  <option {{ $assessment->physical_development == 'C' ? 'selected' : '' }}  value="C">C</option>
                                                  <option {{ $assessment->physical_development == 'D' ? 'selected' : '' }}  value="D">D</option>
                                                  <option {{ $assessment->physical_development == 'E' ? 'selected' : '' }}  value="E">E</option>
                                                  <option {{ $assessment->physical_development == 'F' ? 'selected' : '' }}  value="F">F</option>
                                                  <option {{ $assessment->physical_development == NULL ? 'selected' : '' }} value="">Select</option>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="fname"> Friendship</label>
                                              <select name="friendship" class="form-control">
                                                  <option {{ $assessment->friendship == 'A' ? 'selected' : '' }}  value="A">A</option>
                                                  <option {{ $assessment->friendship == 'B' ? 'selected' : '' }}  value="B">B</option>
                                                  <option {{ $assessment->friendship == 'C' ? 'selected' : '' }}  value="C">C</option>
                                                  <option {{ $assessment->friendship == 'D' ? 'selected' : '' }}  value="D">D</option>
                                                  <option {{ $assessment->friendship == 'E' ? 'selected' : '' }}  value="E">E</option>
                                                  <option {{ $assessment->friendship == 'F' ? 'selected' : '' }}  value="F">F</option>
                                                  <option {{ $assessment->friendship == NULL ? 'selected' : '' }} value="">Select</option>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="fname"> Self Control</label>
                                              <select name="self_control" class="form-control">
                                                  <option {{ $assessment->self_control == 'A' ? 'selected' : '' }}  value="A">A</option>
                                                  <option {{ $assessment->self_control == 'B' ? 'selected' : '' }}  value="B">B</option>
                                                  <option {{ $assessment->self_control == 'C' ? 'selected' : '' }}  value="C">C</option>
                                                  <option {{ $assessment->self_control == 'D' ? 'selected' : '' }}  value="D">D</option>
                                                  <option {{ $assessment->self_control == 'E' ? 'selected' : '' }}  value="E">E</option>
                                                  <option {{ $assessment->self_control == 'F' ? 'selected' : '' }}  value="F">F</option>
                                                  <option {{ $assessment->self_control == NULL ? 'selected' : '' }} value="">Select</option>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="fname"> Industrious</label>
                                              <select name="industrious" class="form-control">
                                                  <option {{ $assessment->industrious == 'A' ? 'selected' : '' }}  value="A">A</option>
                                                  <option {{ $assessment->industrious == 'B' ? 'selected' : '' }}  value="B">B</option>
                                                  <option {{ $assessment->industrious == 'C' ? 'selected' : '' }}  value="C">C</option>
                                                  <option {{ $assessment->industrious == 'D' ? 'selected' : '' }}  value="D">D</option>
                                                  <option {{ $assessment->industrious == 'E' ? 'selected' : '' }}  value="E">E</option>
                                                  <option {{ $assessment->industrious == 'F' ? 'selected' : '' }}  value="F">F</option>
                                                  <option {{ $assessment->industrious == NULL ? 'selected' : '' }} value="">Select</option>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="fname"> Generousity</label>
                                              <select name="generousity" class="form-control">
                                                  <option {{ $assessment->generousity == 'A' ? 'selected' : '' }}  value="A">A</option>
                                                  <option {{ $assessment->generousity == 'B' ? 'selected' : '' }}  value="B">B</option>
                                                  <option {{ $assessment->generousity == 'C' ? 'selected' : '' }}  value="C">C</option>
                                                  <option {{ $assessment->generousity == 'D' ? 'selected' : '' }}  value="D">D</option>
                                                  <option {{ $assessment->generousity == 'E' ? 'selected' : '' }}  value="E">E</option>
                                                  <option {{ $assessment->generousity == 'F' ? 'selected' : '' }}  value="F">F</option>
                                                  <option {{ $assessment->generousity == NULL ? 'selected' : '' }} value="">Select</option>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="fname"> Adjustment</label>
                                              <select name="adjustment" class="form-control">
                                                  <option {{ $assessment->adjustment == 'A' ? 'selected' : '' }}  value="A">A</option>
                                                  <option {{ $assessment->adjustment == 'B' ? 'selected' : '' }}  value="B">B</option>
                                                  <option {{ $assessment->adjustment == 'C' ? 'selected' : '' }}  value="C">C</option>
                                                  <option {{ $assessment->adjustment == 'D' ? 'selected' : '' }}  value="D">D</option>
                                                  <option {{ $assessment->adjustment == 'E' ? 'selected' : '' }}  value="E">E</option>
                                                  <option {{ $assessment->adjustment == 'F' ? 'selected' : '' }}  value="F">F</option>
                                                  <option {{ $assessment->adjustment == NULL ? 'selected' : '' }} value="">Select</option>
                                              </select>
                                          </div>
                                          <button type="submit" class="btn btn-success pull-right"> Edit <i class="fa fa-save"></i></button> 
                                      </div>      
                                  </div>                           
                                </form>  
                            </div>
                            
                            <div class="modal-footer">
                             
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
@endsection
