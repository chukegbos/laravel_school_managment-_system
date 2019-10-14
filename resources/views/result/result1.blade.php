@extends('layouts.print')
@section('pageTitle', 'Result')
@section('content')
  <style>
    table, td, th {
      border: 1px solid black;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th {
      height: 20px;
    }
  </style>


  <section class="content portfolio-item" style="border-style: solid; border-color: {{ $setting->color }};">
  
    <div class="row" 
        style="color: #000; font-size: 13px; font-weight: bold; text-align: center; border-style: solid; border-color: #000; border-width: 1px; height: auto">
        <div class="col-md-2">
            <img src="{{ asset('storage') }}/{{ $setting->logo }}" alt="" style="width:105px; height: 100px; margin-top: 5px;">
        </div> 
      
        <div class="col-md-8">
            <p style="font-size: 22px; font-weight: bold">
                {{ strtoupper($setting->school_name) }}
            </p> 
            <p style="margin-top: 5px;">
                Motto: {{ $setting->slogan }}<br>
                Address: {{ ucwords($setting->address) }} <br>
                Email: {{ $setting->email }} <br>
                Tel: {{ $setting->phone }}
            </p>
        </div>   
        <div class="col-md-12">
            <div class="table-responsive" style="margin-left: -15px; margin-right: -15px;">
            <table>
              <thead style="font-weight: bold; color: #000; text-transform: uppercase;">
                <tr>
                  <th style="text-align: center;">Session</th>
                  <th style="text-align: center;">Term</th>
                  <th style="text-align: center;">Class</th>
                  <th style="text-align: center;">Admission Number</th>
                  <th style="text-align: center;">Sex:</th>
                  <th style="text-align: center;">Fullname</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ $sessionsname }}</td>
                  <td>{{ $term }}</td>
                  <td>{{ $profile->class }} {{ $profile->form }}</td>
                  <td>{{ $profile->roll }}</td>
                  <td>{{$profile->gender}}</td>
                  <td>{{ strtoupper($profile->lastname) }} {{ strtoupper($profile->firstname) }} {{ strtoupper($profile->middlename) }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
    </div>

    <div class="row" style="height: auto; margin-top: 10px">
      <div class="col-md-5">
        <p style="text-align: center; color:#63a4cc; font-weight: bold;">Attendance Record</p>
        <div class="table-responsive">
          <table style="text-align: center;">
            <thead style="font-weight: bold; color: #000; text-transform: uppercase;">
              <tr>
                <th>Times School Opened:</th>
                <th>Time Present:</th>
                <th>Time Absent:</th>
                
              </tr>
            </thead>
            <tbody>
              <tr>
                <td> 
                  @if(isset($assessgrade->present) && isset($assessgrade->absent))
                    {{ $assessgrade->present + $assessgrade->absent }}
                  @else
                    {{ $diff }}
                  @endif
                </td>
                <td>
                    @if(isset( $assessgrade->present))
                      {{ $assessgrade->present }}
                    @endif
                </td>
                <td>
                    @if(isset( $assessgrade->absent))
                      {{ $assessgrade->absent }}
                    @endif
                  </td>
                
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="col-md-7">
        <p style="text-align: center; color:#63a4cc; font-weight: bold;">CA CONVERSIONS: CA = {{ 100  - $standards->exam }}, EXAM = {{ $standards->exam }}, TOTAL = 100</p>
        <div class="table-responsive">
          <table  style="text-align: center;">
            <thead style="font-weight: bold; color: #000; text-transform: uppercase; text-align:center"> 
              <tr>
                <th>Total Score:</th>
                <th>Total Subject:</th>
                <th>Average Score:</th>
                <th>Class Average:</th>
                <th>Position</th>
                <th>Total Students:</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ $maintotal }}</td>
                <td>{{ $countresult }}</td>
                <td>{{ round($avgtotal,2) }}</td>
                <td>{{ round($classaverage,2) }}</td>
                <td>{{ $mainposition }}</td>
                <td>{{ $number_of_students }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>   
    </div>
 
    <div class="row" style="height: auto; margin-top: 10px">
      <div class="col-md-9">
        <p style="text-align: center; color:#63a4cc; font-weight: bold;">ACADEMIC RECORD:</p>
        <div class="table-responsive">
          <table style="color: #3a3434;">
            <thead style="color:blue; text-transform: uppercase; font-size: 13px; font-weight:bolder; text-align:center">
              <tr>
                <th style="text-align:center">Subject</th>
                @if($assessment==1)
                    <th style="text-align:center">1st CA</th> 
                @elseif($assessment==2)
                    <th style="text-align:center">1st CA</th> 
                    <th style="text-align:center">2nd CA</th> 
                @elseif($assessment==3)
                    <th style="text-align:center">1st CA</th> 
                    <th style="text-align:center">2nd CA</th> 
                    <th style="text-align:center">3rd CA</th> 
                @elseif($assessment==4)
                    <th style="text-align:center">1st CA</th> 
                    <th style="text-align:center">2nd CA</th> 
                    <th style="text-align:center">3rd CA</th> 
                    <th style="text-align:center">4th CA</th> 
                @else
                    <th style="text-align:center">1st CA</th> 
                    <th style="text-align:center">2nd CA</th> 
                    <th style="text-align:center">3rd CA</th> 
                    <th style="text-align:center">4th CA</th>
                    <th style="text-align:center">5thth CA</th>
                @endif
                <th style="text-align:center">Exams</th>
                <th style="text-align:center">Total</th>
                <th style="text-align:center">Grade</th>
                <th style="text-align:center">Remark</th>
              </tr>
            </thead>
            <tbody style="text-align: center;">
              @forelse($results as $result)
                <tr>
                    <td style="text-align: center;">
                        @forelse($subjects as $subjectt)
                            @if($subjectt->id==$result->subject)
                                {{ $subjectt->name }}
                            @endif
                        @empty
                        @endforelse
                    </td> 
                  @if($assessment==1)
                    <td>
                        @if(isset($result->total))
                            {{ $result->first_test }}
                        @endif
                    </td> 
                  @elseif($assessment==2)
                    
                    @if(isset($result->total))
                        <td>
                            {{ $result->first_test }}
                        </td> 
                        <td>
                            {{ $result->second_test}}
                        </td>
                      @endif
                    
               
                  @elseif($assessment==3)
                    
                    @if(isset($result->total))
                        <td>
                            {{ $result->first_test }}
                        </td> 
                        <td>
                            {{ $result->second_test}}
                        </td>
                        
                        <td>
                            {{ $result->third_test}}
                        </td>
                    @endif
            
                  @elseif($assessment==4)
                    @if(isset($result->total))
                        <td>
                            {{ $result->first_test }}
                        </td> 
                        <td>
                            {{ $result->second_test}}
                        </td>
                        
                        <td>
                            {{ $result->third_test}}
                        </td>
                        <td>
                            {{ $result->forth_test}}
                        </td>
                    @endif
                  @else
                    @if(isset($result->total))
                        <td>
                            {{ $result->first_test }}
                        </td> 
                        <td>
                            {{ $result->second_test}}
                        </td>
                        
                        <td>
                            {{ $result->third_test}}
                        </td>
                        <td>
                            {{ $result->forth_test}}
                        </td>
                        <td>
                            {{ $result->fifth_test }}
                        </td>
                    @endif
                  @endif
                  <td>{{ $result->exam }}</td>
                  <td>{{ $result->total }}</td>
                  <!--<td>
                    @if(isset($result->total))
                      {{ $position }}
                    @endif
                  </td>
                  <td>
                    @if($result->subject==$sub)
                      {{ $highest }}
                    @endif
                  </td>
                  <td>{{ $lowest }}</td>-->
                  @if($result->grade=="F")
                  <td style="color:red">{{ $result->grade }} </td> 
                  @else
                  <td style="color:green">{{ $result->grade }} </td> 
                  @endif

                  @if( $result->total==NULL)
                    <td></td>
                  @elseif( $result->total< $standards->f_max)
                    <td style="font-weight: bolder; text-align: center; color:red">FAIL</td>
                  @elseif( $result->total <= $standards->e_max)
                    <td style="font-weight: bolder; text-align: center; color:green">POOR</td>
                  @elseif( $result->total <= $standards->D_max)
                    <td style="font-weight: bolder; text-align: center; color:green">PASS</td>
                  @elseif( $result->total <= $standards->c_max)
                    <td style="font-weight: bolder; text-align: center; color:green">GOOD</td>
                  @elseif( $result->total <= $standards->b_max)
                    <td style="font-weight: bolder; text-align: center; color:green">VERY GOOD</td>
                  @else
                    <td style="font-weight: bolder; text-align: center; color:green">EXCELLENT</td>
                  @endif
                </tr>
              @empty
              @endforelse
            </tbody>                                    
          </table>
        </div>
      </div>

      <div class="col-md-3">
        <p style="text-align: center; color:#63a4cc; font-weight: bold;">PERSONAL ANALYSIS:</p>
        <div class="table-responsive" style="">
          <table style="color: #3a3434; border: 1px green;">
            <tr>
              <th style="color:blue; font-size:20px; font-weight:bolder">PSYCHOMOTOR:</th>
              <td></td>
            </tr>
            <tr>
              <th>HANDWRITING: </th>
              <td style="width:50px">
                @if(isset( $assessgrade->handwriting))
                  <span style="padding:5px">{{ $assessgrade->handwriting }}</span> 
                @endif
              </td>
            </tr>
            <tr>
              <th>VERBAL FLUENCY:</th>
              <td>
                @if(isset( $assessgrade->verbal_fluency))
                  <span style="padding:5px">{{ $assessgrade->verbal_fluency }}</span> @endif
                </td>
            </tr>
            <tr>
              <th>GAMES, SPORTS:</th>
              <td>
                @if(isset( $assessgrade->games ))
                  <span style="padding:5px">{{ $assessgrade->games }}</span> @endif
                </td>
            </tr>
            <tr>
              <th>CONSTRUCTION:</th>
              <td>
                @if(isset( $assessgrade->construction))
                  <span style="padding:5px">{{ $assessgrade->construction }}</span> @endif
                </td>
            </tr>
            <tr>
              <th>DRAWING, PAINTING & CRAFT:</th>
              <td>
                @if(isset( $assessgrade->drawing))
                  <span style="padding:5px">{{ $assessgrade->drawing }}</span> @endif

                </td>
            </tr>
            <tr>
              <th>MUSICAL SKILLS:</th>
              <td>
                @if(isset( $assessgrade->musical))
                  <span style="padding:5px">{{ $assessgrade->musical }}</span> @endif</td>
            </tr>
            <tr>
              <th></th>
            </tr>
            <tr>
              <th style="color:blue; font-size:20px; font-weight:bolder">EFFECTIVE AREAS:</th>
              <td></td>
            </tr>
            <tr>
              <th>PUNCTUALITY:</th>
              <td>
                @if(isset( $assessgrade->punctiality))
                  <span style="padding:5px">{{ $assessgrade->punctiality }}</span> @endif</td>
            </tr>
            <tr>
              <th>ALERTNESS:</th>
              <td>
                @if(isset( $assessgrade->alertness))
                  <span style="padding:5px">{{ $assessgrade->alertness }}</span> @endif</td>
            </tr>
            <tr>
              <th>ATTENDANCE:</th>
              <td>
                @if(isset( $assessgrade->attendance))
                  <span style="padding:5px">{{ $assessgrade->attendance }}</span> @endif</td>
            </tr>
            <tr>
              <th>NEATNESS:</th>
              <td>
                @if(isset( $assessgrade->neatness))
                  <span style="padding:5px">{{ $assessgrade->neatness }}</span> @endif</td>
            </tr>
            <tr>
              <th>POLITENESS:</th>
              <td>
                @if(isset( $assessgrade->politeness ))
                  <span style="padding:5px">{{ $assessgrade->politeness }}</span> @endif</td>
            </tr>
            <tr>
              <th>HONESTY:</th>
              <td>
                @if(isset( $assessgrade->honesty))
                  <span style="padding:5px">{{ $assessgrade->honesty }}</span> @endif</td>
            </tr>
           
            <tr>
              <th>PHYSICAL DEVELOPMENT:</th>
              <td>
                @if(isset( $assessgrade->physical_development))
                  <span style="padding:5px">{{ $assessgrade->physical_development }}</span> @endif</td>
            </tr>
            
            <tr>
              <th>FRIENDSHIP:</th>
              <td>
                @if(isset( $assessgrade->friendship))
                  <span style="padding:5px">{{ $assessgrade->friendship }}</span> @endif</td>
            </tr>
            <tr>
              <th>SELF CONTROL:</th>
              <td>
                @if(isset( $assessgrade->self_control))
                  <span style="padding:5px">{{ $assessgrade->self_control }}</span> @endif</td>
            </tr>

            <tr>
              <th>INDUSTRIOUS:</th>
              <td>
                @if(isset( $assessgrade->industrious))
                  <span style="padding:5px">{{ $assessgrade->industrious }}</span> @endif</td>
            </tr>

            <tr>
              <th>GENEROUSITY:</th>
              <td>
                @if(isset( $assessgrade->generousity))
                  <span style="padding:5px">{{ $assessgrade->generousity }}</span> @endif</td>
            </tr>

             <tr>
              <th>ADJUSTMENT:</th>
              <td>
                @if(isset( $assessgrade->adjustment))
                  <span style="padding:5px">{{ $assessgrade->adjustment }}</span> @endif</td>
            </tr>
          </table>
        </div>
      </div>
    </div>

    <hr>
    <div class="row">
      <div class="col-md-1">
        <h4 style="padding: 10px; margin-top: 80px">KEYS</h4>
      </div>

      <div class="col-md-3">
        <div class="table-responsive">
          <table>
            <tr>
              <th>{{$standards->a_min}} - {{$standards->a_max}}</th>
              <td>Excellent</td>
              <td>A</td>
            </tr>
            <tr>
              <th>{{$standards->b_min}} - {{$standards->b_max}}</th>
              <td>Very Good</td>
              <td>B</td>
            </tr>
            <tr>
              <th>{{$standards->c_min}} - {{$standards->c_max}}</th>
              <td>Good</td>
              <td>C</td>
            </tr>
            <tr>
              <th>{{$standards->d_min}} - {{$standards->d_max}}</th>
              <td>Pass</td>
              <td>D</td>
            </tr>
            <tr>
              <th>{{$standards->e_min}} - {{$standards->e_max}}</th>
              <td>Weak Pass</td>
              <td>E</td>
            </tr>
            <tr>
              <th>{{$standards->f_min}} - {{$standards->f_max}}</th>
              <td>Fail</td>
              <td>F</td>
            </tr>
          </table>
        </div>
      </div>

      <div class="col-md-5">
        <p>CLASS TEACHER'S COMMENT: 
          <span style="font-weight: bolder; font-size: 12px; margin-left:5px">
          @if(isset($assessgrade->teacher_comment))
            <u>{{ $assessgrade->teacher_comment }}</u>
          @endif
          </span>
        </p>

        <p>SIGN/DATE:  
          <span style="font-weight: bolder; font-size: 12px; margin-left:5px">
          @if(isset($assessgrade->teacher_sign))
           <u> {{ $assessgrade->teacher_sign->toFormattedDateString() }}</u>
          @endif
          </span>
        </p>

        <br>
        <p>HEAD TEACHER'S COMMENT:
          <span style="font-weight: bolder; font-size: 13px; margin-left:5px">
            @if(isset($assessgrade->principal_comment))
               <u>{{ $assessgrade->principal_comment }}</u>
            @endif
          </span>
        </p>

        <p>SIGN/DATE: 
          <span style="font-weight: bolder; font-size: 13px; margin-left:5px">
            @if(isset($assessgrade->principal_sign))
               <u>{{ $assessgrade->principal_sign->toFormattedDateString() }}</u>
            @endif
            </span>
          </p>
      </div> 

      <div class="col-md-3">
        <div style="padding-top: 10px; margin-top: 10px">
          <p style="font-size: 12px; text-align: center">COMPUTER OVERALL REMARK</p>
          @if($avgtotal <= $standards->f_max)
            <h3 style="font-weight: bolder; text-align: center; color:red">FAIL</h3>
          @elseif($avgtotal <= $standards->e_max)
            <h3 style="font-weight: bolder; text-align: center; color:green">WEAK PASS</h3>
          @elseif($avgtotal <= $standards->D_max)
            <h3 style="font-weight: bolder; text-align: center; color:green">PASS</h3>
          @elseif($avgtotal <= $standards->c_max)
            <h3 style="font-weight: bolder; text-align: center; color:green">GOOD</h3>
          @elseif($avgtotal <= $standards->b_max)
            <h3 style="font-weight: bolder; text-align: center; color:green">VERY GOOD</h3>
          @else
            <h3 style="font-weight: bolder; text-align: center; color:green">EXCELLENT</h3>
          @endif
        </div>
        <div style="padding-top: 10px; margin-top: 10px">
          <p style="font-size: 13px; text-align: center">SCHOOL RESUMES ON:</p>              
          <h3 style="font-weight: bolder; text-align: center">{{ $next_term_start->toFormattedDateString() }}</h3>
        </div>
      </div> 
    </div>
  </section>

@endsection
