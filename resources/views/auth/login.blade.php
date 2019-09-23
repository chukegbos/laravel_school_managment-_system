<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="{{ asset('assets/dist/img/ico/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('log/fonts/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ asset('log/css/style.css') }}">
    <title>High School Manager</title>
    <style type="text/css">
        body{
            background: gray;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <div class="form-container">
                <div class="form-heading">
                    <div class="logo">
                        @if(isset($school))
                            <img src="{{ asset('log/img/logo-mobile.jpeg') }}" alt="High School Manager">
                        @else
                          <img src="{{ asset('log/img/logo-mobile.jpeg') }}" alt="High School Manager">
                        @endif

                    </div>
                    <div class="form-title" style="color: #E21414;">Go To School</div>
                </div>
                <form  method="POST" action="{{ route('stafflogin') }}">
                    {{ csrf_field() }}
                    <div class="input-div">
                        <label for=""> <i class="fas fa-address-card"></i> &nbsp; School Code</label>
                        @if(isset($school))
                            <input type="text" readonly="true" value="{{ $school->school_code }}" name="school_code">
                        @else
                            <input type="text"  title="Please enter you school code" required autofocus value="{{ old('school_code') }}" name="school_code">
                        @endif
                        @if ($errors->has('school_code'))
                            <span class="help-block">
                                <strong>{{ $errors->first('school_code') }}</strong>
                            </span>
                        @endif
                        <small>Your unique school code</small>
                    </div>

                    @if(isset($school))
                    <div class="input-div">
                        <label for=""> <i class="fas fa-bank"></i> &nbsp; School Name</label>
                        <input type="text" readonly="true" value="{{ $school->school_name }}">
                    </div>
                  @endif


                    <div class="input-div">
                        <label for=""> <i class="fas fa-user-alt"></i> &nbsp; Login Username</label>
                        <input type="text" title="Please enter your unique username" required autofocus value="{{ old('username') }}" name="username">
                       @if ($errors->has('username'))
                          <span class="help-block">
                              <strong>{{ $errors->first('username') }}</strong>
                          </span>
                      @endif
                      <small>Your unique username</small>
                    </div>

                    <div class="input-div">
                        <label for=""> <i class="fas fa-user-lock"></i> &nbsp; Password</label>
                        <input type="password" required=""  name="password" id="password">
                        @if ($errors->has('password'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                        @endif
                    </div>
                    <small>Your secret password</small>

                    <div class="input-div">
                        <label for=""> <i class="fas fa-key"></i> &nbsp; Role</label>
                        <select name="role" required="">
                            <option value="Admin">School Administrator</option>
                            <option value="Staff">Staff</option>
                            <option value="Student">Student</option>
                        </select>
                    </div>
                    <small>Your right to application</small> <br><br>
                    <div class="form-check">
                        <p><input type="checkbox" name="remember" value="{{ old('remember') ? 'checked' : '' }}">
                            <label for="">Remember me</label></p>
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                    </div>
                    <div class="form-action">
                        <button>Login</button>

                    </div>
                </form>
            </div>

            <div class="side-form">
                <img src="{{ asset('log/img/logo-head.jpeg') }}" alt="">
                <p class="text-head"><span class="color-red">Y</span>our Number one self hoste<span
                        class="color-red">d</span> <span class="color-red">S</span>chool <span
                        class="color-red">M</span>anage<span class="color-red">r</span></p>
                <p class="text-sub"> Sign up for <span class="color-red">free</span> and enjoy 1 <span
                        class="color-orange">month</span> free School
                    management</p>
                <p class="color-white icon"><i class="fas fa-angle-double-down fa-3x"></i></p>
                <p class="side-info-btn"><a href="#" class="btn">Get Started</a></p>
            </div>
        </div>
    </div>
</body>

</html>