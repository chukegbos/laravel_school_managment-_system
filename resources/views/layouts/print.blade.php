<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('pageTitle') - {{ $setting->school_name }}</title>
    <meta name="keywords" content="Portal," />
    <meta name="description" content="">
    <meta name="author" content="Zallasoft Technologies & Solution">
    <style type="text/css">

        * {
          -webkit-print-color-adjust: exact !important;   /* Chrome, Safari */
          color-adjust: exact !important;                 /*Firefox*/
      }
        .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
      }

        .print-area {border:1px solid black ;padding:1em;}

        .back {
          background-image: url("{{ asset('greenbank/images/paper.png')}}");
        }
    </style>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('greenbank/images/favicon.ico') }}" type="image/x-icon" />
    
    <link rel="apple-touch-icon" href="{{ asset('greenbank/js/apple-touch-icon.png') }}">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light%7CPlayfair+Display:400" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('greenbank/vendor/bootstrap/css/bootstrap.min.css') }}">    
    <link rel="stylesheet" href="{{ asset('greenbank/vendor/fontawesome-free/css/all.min.css') }}">   
    <link rel="stylesheet" href="{{ asset('greenbank/vendor/animate/animate.min.css') }}">    
    <link rel="stylesheet" href="{{ asset('greenbank/vendor/simple-line-icons/css/simple-line-icons.min.css') }}">    
    <link rel="stylesheet" href="{{ asset('greenbank/vendor/owl.carousel/assets/owl.carousel.min.css') }}">   
    <link rel="stylesheet" href="{{ asset('greenbank/vendor/owl.carousel/assets/owl.theme.default.min.css') }}">    
    <link rel="stylesheet" href="{{ asset('greenbank/vendor/magnific-popup/magnific-popup.min.css') }}">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('greenbank/css/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('greenbank/css/theme-elements.css') }}">
    <link rel="stylesheet" href="{{ asset('greenbank/css/theme-blog.css') }}">
    <link rel="stylesheet" href="{{ asset('greenbank/css/theme-shop.css') }}">

    <!-- Current Page CSS -->
    <link rel="stylesheet" href="{{ asset('greenbank/vendor/rs-plugin/css/settings.css') }}">
    <link rel="stylesheet" href="{{ asset('greenbank/vendor/rs-plugin/css/layers.css') }}">
    <link rel="stylesheet" href="{{ asset('greenbank/vendor/rs-plugin/css/navigation.css') }}">
    <link rel="stylesheet" href="{{ asset('greenbank/vendor/circle-flip-slideshow/css/component.css') }}">
    <!-- Skin CSS -->
    <link rel="stylesheet" href="{{ asset('greenbank/css/skins/default.css') }}">   
    <script src="master/style-switcher/style.switcher.localstorage.js') }}"></script> 

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('greenbank/css/custom.css') }}">

    <!-- Head Libs -->
    <script src="{{ asset('greenbank/vendor/modernizr/modernizr.min.js') }}"></script>
    
    <style type="text/css">
          .portfolio-item {
            position: relative;
            background: #FFF;
                background-clip: border-box;
            margin-bottom: 10px;
            border: 8px solid #FFF;
            -webkit-border-radius: 5px;
            -webkit-background-clip: padding-box;
            -moz-border-radius: 5px;
            -moz-background-clip: padding;
            border-radius: 5px;
            background-clip: padding-box;
            -webkit-box-shadow: inset 0 1px #fff,0 0 8px #c8cfe6;
            -moz-box-shadow: inset 0 1px #fff,0 0 8px #c8cfe6;
            box-shadow: inset 0 1px #fff,0 0 8px #c8cfe6;
            color: inset 0 1px #fff,0 0 8px #c8cfe6;
            -webkit-transition: all .5s ease;
            -moz-transition: all .5s ease;
            -o-transition: all .5s ease;
            -ms-transition: all .5s ease;
            transition: all .5s ease;
          }
          
          .portfolio-item .portfolio-image {
            overflow: hidden;
            text-align: center;
            position: relative;
          }
        </style>
      <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
        
  </head>

  <body onload="myFunction()" style="background: white; height: 400px">
    @yield('content')
    <!--<script src="{{ asset('js/app.js') }}"></script>-->
    <!-- Vendor -->
    <script src="{{ asset('greenbank/vendor/jquery/jquery.min.js') }}"></script>    
    <script src="{{ asset('greenbank/vendor/jquery.appear/jquery.appear.min.js') }}"></script>    
    <script src="{{ asset('greenbank/vendor/jquery.easing/jquery.easing.min.js') }}"></script>    
    <script src="{{ asset('greenbank/vendor/jquery.cookie/jquery.cookie.min.js') }}"></script>    
    

    <script src="{{ asset('greenbank/vendor/popper/umd/popper.min.js') }}"></script>    
    <script src="{{ asset('greenbank/vendor/bootstrap/js/bootstrap.min.js') }}"></script>   
    <script src="{{ asset('greenbank/vendor/common/common.min.js') }}"></script>    
    <script src="{{ asset('greenbank/vendor/jquery.validation/jquery.validate.min.js') }}"></script>    
    <script src="{{ asset('greenbank/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>    
    <script src="{{ asset('greenbank/vendor/jquery.gmap/jquery.gmap.min.js') }}"></script>    
    <script src="{{ asset('greenbank/vendor/jquery.lazyload/jquery.lazyload.min.js') }}"></script>    
    <script src="{{ asset('greenbank/vendor/isotope/jquery.isotope.min.js') }}"></script>   
    <script src="{{ asset('greenbank/vendor/owl.carousel/owl.carousel.min.js') }}"></script>    
    <script src="{{ asset('greenbank/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>   
    <script src="{{ asset('greenbank/vendor/vide/jquery.vide.min.js') }}"></script>   
    <script src="{{ asset('greenbank/vendor/vivus/vivus.min.js') }}"></script>
    
    <!-- Theme Base, Components and Settings -->
    <script src="{{ asset('greenbank/js/theme.js') }}"></script>
    
    <!-- Current Page Vendor and Views -->
    <script src="{{ asset('greenbank/vendor/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>   
    <script src="{{ asset('greenbank/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>    
    <script src="{{ asset('greenbank/vendor/circle-flip-slideshow/js/jquery.flipshow.min.js') }}"></script>   
    <script src="{{ asset('greenbank/js/views/view.home.js') }}"></script>
    
    <!-- Theme Custom -->
    <script src="{{ asset('greenbank/js/custom.js') }}"></script>
    
    <!-- Theme Initialization Files -->
    <script src="{{ asset('greenbank/js/theme.init.js') }}"></script>

    <script src="{{ asset('vpad/datatable/DataTables-1.10.15/media/js/jquery.dataTables.min.js') }}"></script>
    <!-- JqueryPrintArea -->
      <script src="{{ asset('userpage/js/vendor_plugins/JqueryPrintArea/demo/jquery.PrintArea.js') }}"></script> 
      <!-- DataTables -->
      <script src="{{ asset('vpad/datatable/datatables.net/js/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('vpad/datatable/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
      <script src="{{ asset('vpad/datatable/data-table.js') }}"></script>
    <script src="{{ asset('greenbank/master/analytics/analytics.js') }}"></script>  
  </body>

  <script>
      function myFunction() {
        window.print();
      }
    </script>
</html>