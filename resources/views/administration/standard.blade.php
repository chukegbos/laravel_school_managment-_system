@extends('layouts.admin')
@section('pageTitle', 'Set Standard')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <span style="font-size:20px">School Standard</span>  
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

                        <form method="post" class="profile-wrapper" action="{{ url('admin/standard') }}" enctype="multipart/form-data">
                           {{ method_field('PUT') }}
                                    {{ csrf_field() }}
                            <!--<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">Set Term</label>
                                        <select name="term" class="form-control dynamic" id="class1" data-dependent="form">
                                            <option>Select Term</option>
                                            <option {{ $standards->term == 'First Term' ? 'selected' : '' }}  value="First Term">First Term</option>
                                            <option {{ $standards->term == 'Second Term' ? 'selected' : '' }} value="Second Term">Second Term</option>
                                            <option {{ $standards->term == 'Third Term' ? 'selected' : '' }} value="Third Term">Third Term</option>
                                        </select>
                                    </div>
                                </div>
                            </div>-->
                            <div class="row"> 
                                @if($setting->assessment==1)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>1st Assessment:</label>  
                                            <input class="form-control" type="number" name="test1" value="{{$standards->test1}}" required autofocus>  
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Exam:</label> 
                                            <input type="hidden" name="school_code" value="{{ $setting->school_code }}">
                                            <input type="hidden" name="siteini" value="{{ $setting->siteini }}"> 
                                            <input class="form-control" type="number" name="exam" value="{{$standards->exam}}" required autofocus>  
                                        </div>
                                    </div>
                                @elseif($setting->assessment==2)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>1st Assessment:</label>  
                                            <input class="form-control" type="number" name="test1" value="{{$standards->test1}}" required autofocus>  
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>2nd Assessment:</label>  
                                            <input class="form-control" type="number" name="test2" value="{{$standards->test2}}" required autofocus>  
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Exam:</label> 
                                            <input type="hidden" name="school_code" value="{{ $setting->school_code }}">
                                            <input type="hidden" name="siteini" value="{{ $setting->siteini }}"> 
                                            <input class="form-control" type="number" name="exam" value="{{$standards->exam}}" required autofocus>  
                                        </div>
                                    </div>
                                @elseif($setting->assessment==3)
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>1st Assessment:</label>  
                                            <input class="form-control" type="number" name="test1" value="{{$standards->test1}}" required autofocus>  
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>2nd Assessment:</label>  
                                            <input class="form-control" type="number" name="test2" value="{{$standards->test2}}" required autofocus>  
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>3rd Assessment:</label>  
                                            <input class="form-control" type="number" name="test3" value="{{$standards->test3}}" required autofocus>  
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Exam:</label> 
                                            <input type="hidden" name="school_code" value="{{ $setting->school_code }}">
                                            <input type="hidden" name="siteini" value="{{ $setting->siteini }}"> 
                                            <input class="form-control" type="number" name="exam" value="{{$standards->exam}}" required autofocus>  
                                        </div>
                                    </div> 
                                @elseif($setting->assessment=4)
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>1st Assessment:</label>  
                                            <input class="form-control" type="number" name="test1" value="{{$standards->test1}}" required autofocus>  
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>2nd Assessment:</label>  
                                            <input class="form-control" type="number" name="test2" value="{{$standards->test2}}" required autofocus>  
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>3rd Assessment:</label>  
                                            <input class="form-control" type="number" name="test3" value="{{$standards->test3}}" required autofocus>  
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>4th Assessment:</label>  
                                            <input class="form-control" type="number" name="test4" value="{{$standards->test4}}" required autofocus>  
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Exam:</label> 
                                            <input type="hidden" name="school_code" value="{{ $setting->school_code }}">
                                            <input type="hidden" name="siteini" value="{{ $setting->siteini }}"> 
                                            <input class="form-control" type="number" name="exam" value="{{$standards->exam}}" required autofocus>  
                                        </div>
                                    </div> 
                                @elseif($setting->assessment=="5")
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>1st Assessment:</label>  
                                                <input class="form-control" type="number" name="test1" value="{{$standards->test1}}" required autofocus>  
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>2nd Assessment:</label>  
                                                <input class="form-control" type="number" name="test2" value="{{$standards->test2}}" required autofocus>  
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>3rd Assessment:</label>  
                                                <input class="form-control" type="number" name="test3" value="{{$standards->test3}}" required autofocus>  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>4th Assessment:</label>  
                                                <input class="form-control" type="number" name="test4" value="{{$standards->test4}}" required autofocus>  
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>5th Assessment:</label>  
                                                <input class="form-control" type="number" name="test5" value="{{$standards->test5}}" required autofocus>  
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Exam:</label> 
                                                <input type="hidden" name="school_code" value="{{ $setting->school_code }}">
                                                <input type="hidden" name="siteini" value="{{ $setting->siteini }}"> 
                                                <input class="form-control" type="number" name="exam" value="{{$standards->exam}}" required autofocus>  
                                            </div>
                                        </div> 
                                    </div>
                                @elseif($setting->assessment=="6")
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>1st Assessment:</label>  
                                            <input class="form-control" type="number" name="test1" value="{{$standards->test1}}" required autofocus>  
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>2nd Assessment:</label>  
                                            <input class="form-control" type="number" name="test2" value="{{$standards->test2}}" required autofocus>  
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>3rd Assessment:</label>  
                                            <input class="form-control" type="number" name="test3" value="{{$standards->test3}}" required autofocus>  
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>4th Assessment:</label>  
                                            <input class="form-control" type="number" name="test4" value="{{$standards->test4}}" required autofocus>  
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>5th Assessment:</label>  
                                            <input class="form-control" type="number" name="test5" value="{{$standards->test5}}" required autofocus>  
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>6th Assessment:</label>  
                                            <input class="form-control" type="number" name="test6" value="{{$standards->test6}}" required autofocus>  
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Exam:</label> 
                                            <input type="hidden" name="school_code" value="{{ $setting->school_code }}">
                                            <input type="hidden" name="siteini" value="{{ $setting->siteini }}"> 
                                            <input class="form-control" type="number" name="exam" value="{{$standards->exam}}" required autofocus>  
                                        </div>
                                    </div> 
                                @endif                
                            </div>  

                            <div class="box-header">
                                <h3>Grade A</h3>
                            </div>                          
                            <div class="row">        
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>From:</label>  
                                        <input class="form-control" type="number" name="a_min" value="{{$standards->a_min}}" required autofocus>  
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>To:</label>  
                                        <input class="form-control" type="number" name="a_max" value="{{$standards->a_max}}" required autofocus>  
                                    </div>
                                </div>
                            </div>   

                            <div class="box-header">
                                <h3>Grade B</h3>
                            </div>                          
                            <div class="row">        
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>From:</label>  
                                        <input class="form-control" type="number" name="b_min" value="{{$standards->b_min}}" required autofocus>  
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>To:</label>  
                                        <input class="form-control" type="number" name="b_max" value="{{$standards->b_max}}" required autofocus>  
                                    </div>
                                </div>
                            </div> 

                            <div class="box-header">
                                <h3>Grade C</h3>
                            </div>                          
                            <div class="row">        
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>From:</label>  
                                        <input class="form-control" type="number" name="c_min" value="{{$standards->c_min}}" required autofocus>  
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>To:</label>  
                                        <input class="form-control" type="number" name="c_max" value="{{$standards->c_max}}" required autofocus>  
                                    </div>
                                </div>
                            </div> 

                            <div class="box-header">
                                <h3>Grade D</h3>
                            </div>                          
                            <div class="row">        
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>From:</label>  
                                        <input class="form-control" type="number" name="d_min" value="{{$standards->d_min}}" required autofocus>  
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>To:</label>  
                                        <input class="form-control" type="number" name="d_max" value="{{$standards->d_max}}" required autofocus>  
                                    </div>
                                </div>
                            </div> 

                            <div class="box-header">
                                <h3>Grade E</h3>
                            </div>                          
                            <div class="row">        
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>From:</label>  
                                        <input class="form-control" type="number" name="e_min" value="{{$standards->e_min}}" required autofocus>  
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>To:</label>  
                                        <input class="form-control" type="number" name="e_max" value="{{$standards->e_max}}" required autofocus>  
                                    </div>
                                </div>
                            </div>     
                            <div class="box-header">
                                <h3>Grade F</h3>
                            </div>                          
                            <div class="row">        
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>From:</label>  
                                        <input class="form-control" type="number" name="f_min" value="{{$standards->f_min}}" required autofocus>  
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>To:</label>  
                                        <input class="form-control" type="number" name="f_max" value="{{$standards->f_max}}" required autofocus>  
                                    </div>
                                </div>
                            </div>                      
                            <button type="submit" class="btn btn-success pull-right">Set <i class="fa fa-save"></i></button>                              
                        </form>
                    </div> 
                </div>
            </div>
        </div>     
    </section>
</div>
@endsection
