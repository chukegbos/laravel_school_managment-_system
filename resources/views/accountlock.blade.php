<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
      
        <title>Account Locked - High School Manager</title>

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="{{ asset('assets/dist/img/ico/favicon.png') }}" type="image/x-icon">

        <!-- Bootstrap -->
        <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap rtl -->
        <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
        <!-- Font Awesome 4.7.0 -->
        <link href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
        <!-- socicon css -->
        <link href="assets/socicon/social.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <link href="{{ asset('assets/dist/css/stylehealth.min.css') }}" rel="stylesheet" type="text/css"/>
        <style>
          body{
              background-image: url('assets/img/newimage.gif');
              background-repeat: no-repeat, repeat;
              background-size: cover;
          }
      </style>
    </head>
    <body>
        <!-- Content Wrapper -->
        <div class="lock-wrapper-page" >
            <div class="text-center">
                
                <a href="https://myschool.highschoolmanager.com" class="logo-lock">
                    <span style="margin-bottom: 20px">Account Locked</span><br><br>
                    <img src="{{ asset('storage') }}/{{ $checkschool->logo }}" style="height: 90px; width: 330px; margin-top: -18px"> 
                </a>
            </div>
            <span class="text-center m-t-20"> 
                <p style="color: white; margin-top: 100px; font-size: 22px; font-weight: bolder">{{ $checkschool->school_name}} subscription has expired, contact the vendor for renewal.</p>   
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;" class="text-center m-t-20">
                      {{ csrf_field() }}
                </form>    
                <div class="form-group"> 
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  class="btn btn-success">
                        Back
                    </a>
                </div>
                
            </span>

        </div>
        <!-- /.content-wrapper -->
        <!-- jQuery -->
        <script src="{{ asset('assets/plugins/jQuery/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
        <!-- bootstrap js -->
        <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    </body>
</html>