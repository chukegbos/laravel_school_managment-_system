<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" href="{{ asset('assets/dist/img/ico/favicon.png') }}" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset('login/fonts/fontawesome-all.css') }}">
        <link rel="stylesheet" href="{{ asset('login/css/style.css') }}">
        <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <style>
            color{
                display: block;
                margin-top: 5px;
                margin-bottom: 10px;
                color: #fff;
            }
        </style>
        <title>Reset Password | HSM</title>
    </head>
    <body>
    <div class="container">
        <div class="wrapper">
            <div class="form-container">
                <div class="form-heading">
                    <div class="logo">
                        <img src="{{ asset('login/img/logo-mobile.jpeg') }}" alt="">
                    </div>
                    <div class="form-title">Recover Acount</div>
                </div>
                <form method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                    <div class="input-div">
                        <label for="" style="color: #e21414"> <i class="fas fa-envelope"></i> &nbsp; Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="form-control">
                        @if ($errors->has('email'))
                            <span class="help-block" style="color: white;">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                        @endif
                    </div>
                    <small>Your Email Address</small><br><br>
                    <div class="form-action">
                        <button type="submit" style="color:white">Send Passworrd Reset Link</button>
                    </div>
                </form>
            </div>
            <div class="side-form">
                <img src="{{ asset('login/img/logo-head.jpeg') }}" alt="">
                <p class="text-head"><span class="color-red">Y</span>our Number one self hoste<span
                        class="color-red">d</span> <span class="color-red">S</span>chool <span
                        class="color-red">M</span>anage<span class="color-red">r</span></p>
                <p class="text-sub"> sign up for <span class="color-red">free</span> and enjoy 1 <span
                        class="color-orange">month</span> free School
                    management</p>
                <p class="color-white icon"><i class="fas fa-angle-double-down fa-3x"></i></p>
                <p class="side-info-btn"><a href="#" class="btn">Sign up now</a></p>
            </div>
        </div>
    </div>
</body>
</html>