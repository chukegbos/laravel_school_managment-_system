<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Login</title>

      <!-- Favicon and touch icons -->
      <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
      

      <!-- Bootstrap -->
      <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
      <!-- style css -->
      <link href="assets/dist/css/stylehealth.min.css" rel="stylesheet" type="text/css"/>
      <style>
          body{
              background-image: url('assets/img/school.jpg');
              background-repeat: no-repeat, repeat;
              background-size: cover;
          }
      </style>
  </head>
  <body>
      <!-- Content Wrapper -->
      <div class="login-wrapper">
          <!--<div class="back-link">
              <a href="{{ url('/') }}" class="btn btn-success">Back to Dashboard</a>
          </div>-->

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

                        
          <div class="container-center" style="margin-top: -10px;">
              <div class="panel panel-bd">
                  <div class="panel-heading">
                      <div class="view-header">
                          <div class="header-icon">
                              <i class="pe-7s-unlock"></i>
                          </div>
                          <div class="header-title">
                              <h3>Admin Login</h3>
                          </div>
                      </div>
                  </div>
                  <div class="panel-body">
                      <form method="POST" action="{{ route('stafflogin') }}">
                          {{ csrf_field() }}

                            <div class="form-group">
                                <label class="control-label" for="username">Login Username</label>
                                <input type="hidden"  value="zalla" name="zalla">
                                <input type="text" title="Please enter your unique username" required autofocus value="{{ old('username') }}" name="username" class="form-control">
                               @if ($errors->has('username'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('username') }}</strong>
                                  </span>
                              @endif
                              <span class="help-block small">Your unique username</span>
                          </div>

                          <div class="form-group">
                              <label class="control-label" for="password">Password</label>
                              <input type="password" title="Please enter your password"  required=""  name="password" id="password" class="form-control">
                              @if ($errors->has('password'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                              <span class="help-block small">Your strong password</span>
                          </div>

                          <div class="form-group">
                              <div class="col-md-6 col-md-offset-4">
                                  <div class="checkbox">
                                      <label>
                                          <input type="checkbox" name="remember" value="{{ old('remember') ? 'checked' : '' }}"> Remember Me
                                      </label>
                                  </div>
                              </div>
                          </div>

                          <div>
                              <button class="btn btn-primary">Login</button>
                              <a class="btn btn-warningk" href="{{ route('password.request') }}">
                                  Forgot Your Password?
                              </a>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      <!-- /.content-wrapper -->
      <!-- jQuery -->
      <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
      <!-- bootstrap js -->
      <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  </body>
</html>