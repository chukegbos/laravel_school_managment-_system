<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('pageTitle') - {{ $setting->school_name }}</title>

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="{{ asset('assets/dist/img/ico/favicon.png') }}" type="image/x-icon">
   <!-- Start Global Mandatory Style
   =====================================================================-->
   <!-- jquery-ui css -->
   <link href="{{ asset('assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css') }}" rel="stylesheet" type="text/css"/>
   <!-- Bootstrap -->
   <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>

   <link href="{{ asset('assets/plugins/lobipanel/lobipanel.min.css') }}" rel="stylesheet" type="text/css"/>
   <!-- Pace css -->
   <link href="{{ asset('assets/plugins/pace/flash.css') }}" rel="stylesheet" type="text/css"/>
   <!-- Font Awesome -->
   <link href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
   <!-- Pe-icon -->
   <link href="{{ asset('assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}" rel="stylesheet" type="text/css"/>
   <!-- Themify icons -->
   <link href="{{ asset('assets/themify-icons/themify-icons.css') }}" rel="stylesheet" type="text/css"/>
    <!-- End Global Mandatory Style
    =====================================================================-->
    <!-- Start page Label Plugins 
    =====================================================================-->
    <!-- Toastr css -->
    <link href="{{ asset('assets/plugins/toastr/toastr.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Emojionearea -->
    <link href="{{ asset('assets/plugins/emojionearea/emojionearea.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Monthly css -->
    <link href="{{ asset('assets/plugins/monthly/monthly.css') }}" rel="stylesheet" type="text/css"/>
    <!-- End page Label Plugins 
    =====================================================================-->
    <!-- Start Theme Layout Style
    =====================================================================-->
    <!-- Theme style -->
    <link href="{{ asset('assets/dist/css/stylehealth.min.css') }}" rel="stylesheet" type="text/css"/>
    <!--<link href="{{ asset('assets/dist/css/stylehealth-rtl.css') }}" rel="stylesheet" type="text/css"/>-->
    <!-- End Theme Layout Style
    =====================================================================-->
   <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
   <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
   <link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>

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

      .user-panel{
        background: {{ $setting->color }}
      }
      .header-title h1{
        color: {{ $setting->color }}
      }
      .breadcrumb > .active, .content-header .header-icon{
        color: {{ $setting->color }}
      }
      .panel-bd > .panel-heading, .alert-success, .dt-button{
        background: {{ $setting->color }}
      }
      .main-sidebar
      {
        background: {{ $setting->color }}
      }

      .sidebar-menu
      {
        background: {{ $setting->color }}
      }

      * {
          -webkit-print-color-adjust: exact !important;   /* Chrome, Safari */
          color-adjust: exact !important;                 /*Firefox*/
      }
      
    </style>
  </head>
    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            <header class="main-header">
                
                <a href="{{ url('/') }}" class="logo">
                    
                  @if($setting->logo!=NULL)
                    <img src="{{ asset('storage') }}/{{ $setting->logo }}" style="height: 70px; width: 200px"> 
                    
                  @else
                    <img src="{{ asset('assets/img/hsm.png') }}" style="height: 70px; width: 200px">
                  @endif
                </a>
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" style="background: {{ $setting->color }}">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <!-- Sidebar toggle button-->
                        <span class="sr-only">Toggle navigation</span>
                        <span class="fa fa-tasks" style="background: white;"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <script>
                          function reloadPage(){
                            location.reload(true);
                          }
                        </script> 
                        
                        <ul class="nav navbar-nav">
                            <li class="tasks-menu">
                                <button onClick="window.location.reload();" style="margin-top: 20px;" class="btn btn-success btn-xs">Refresh
                                </button>
                            </li>
                            <li class="dropdown dropdown-user admin-user">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                              <div class="user-image">
                                <img src="{{ asset('assets/dist/img/avatar4.png') }}" class="img-circle" height="40" width="40" alt="User Image">
                              </div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/profile') }}/?unique_id={{ Auth::user()->unique_id}}"><i class="fa fa-users"></i> User Profile</a></li>

                                <li>
                                    <a href="{{ url('/password') }}"><i class="fa fa-key"></i><span>Change Password</span></a>
                                </li>
                                <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i>
                                        <span>Logout</span>        
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                          {{ csrf_field() }}
                                    </form>
                                </li>              
                            </ul>
                          </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- =============================================== -->
            <!-- Left side column. contains the sidebar -->
            @include('component.sidebar') 
            <!-- =============================================== -->
            <!-- Content Wrapper. Contains page content -->
            @yield('content')<!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs"> <b>Version</b> 1.0</div>
                <strong>Copyright &copy; {{ date('Y')}} <a target="_blank"  href="https://highschoolmanager.com.ng">High School Manager</a>. Powered by <a target="_blank" href="https://zallaschool.com.ng">Zallasoft Technologies & Solutions</a>.</strong> All rights reserved.
            </footer>
        </div> <!-- ./wrapper -->
        <!-- ./wrapper -->
         <!-- Start Core Plugins
        =====================================================================-->
        <!-- jQuery -->
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="{{ asset('assets/plugins/jQuery/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/dist/js/lga.js') }}" type="text/javascript"></script>
        <!-- jquery-ui --> 
        <script src="{{ asset('assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js') }}" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <!-- lobipanel -->
        <script src="{{ asset('assets/plugins/lobipanel/lobipanel.min.js') }}" type="text/javascript"></script>
        <!-- Pace js -->
        <script src="{{ asset('assets/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
        <!-- SlimScroll -->
        <script src="{{ asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <!-- FastClick -->
        <script src="{{ asset('assets/plugins/fastclick/fastclick.min.js') }}" type="text/javascript"></script>
        <!-- Hadmin frame -->
        <script src="{{ asset('assets/dist/js/custom1.js') }}" type="text/javascript"></script>
        <!-- End Core Plugins
        =====================================================================-->
        <!-- Start Page Lavel Plugins
        =====================================================================-->
        <!-- Toastr js -->
        <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}" type="text/javascript"></script>
        <!-- Sparkline js -->
        <script src="{{ asset('assets/plugins/sparkline/sparkline.min.js') }}" type="text/javascript"></script>
        <!-- Data maps js -->
        <script src="{{ asset('assets/plugins/datamaps/d3.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/datamaps/topojson.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/datamaps/datamaps.all.min.js') }}" type="text/javascript"></script>
        <!-- Counter js -->
        <script src="{{ asset('assets/plugins/counterup/waypoints.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>
        <!-- ChartJs JavaScript -->
        <script src="{{ asset('assets/plugins/chartJs/Chart.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/emojionearea/emojionearea.min.js') }}" type="text/javascript"></script>
        <!-- Monthly js -->
        <script src="{{ asset('assets/plugins/monthly/monthly.js') }}" type="text/javascript"></script>
        <!-- Data maps -->
        <script src="{{ asset('assets/plugins/datamaps/d3.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/datamaps/topojson.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/datamaps/datamaps.all.min.js') }}" type="text/javascript"></script>


       
      <!--

        <script src="{{ asset('vpad/datatable/DataTables-1.10.15/media/js/jquery.dataTables.min.js') }}"></script>
       
         DataTables 
        <script src="{{ asset('vpad/datatable/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vpad/datatable/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ asset('vpad/datatable/data-table.js') }}"></script>
      -->
    
    
   
    
    
    
    
    
    
    
      
      <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>




        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
        <script src="{{ asset('assets/plugins/summernote/summernote.js') }}" type="text/javascript"></script>
        <script>
          //summernote
          "use strict"; // Start of use strict
           var note = $('#summernote');
          $(note).summernote({
              height: 200, // set editor height
              minHeight: null, // set minimum height of editor
              maxHeight: null, // set maximum height of editor
              focus: true  // set focus to editable area after initializing summernote
          });           
        </script>
        <script>
          $(document).ready(function() {
              $('.js-example-basic-single').select2();
          });

          $(document).ready(function() {
              $('#example2').DataTable( {

                dom: 'Bfrtip',
                lengthMenu: [
                    [ 10, 25, 50, 100, -1 ],
                    [ '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
                ],
      
                  
                  buttons: [
                      'copy', 'csv', 'excel', 'pdf', 'print', 'pageLength'
                  ],

                  'paging'      : true,
                  'lengthChange': true,
                  'searching'   : true,
                  'ordering'    : true,
                  'info'        : true,
                  'autoWidth'   : false,
              } );
          } );
        </script>
        <!-- End Page Lavel Plugins
        =====================================================================-->
        <!-- Start Theme label Script
        =====================================================================-->
        <!-- Dashboard js -->
        <script src="{{ asset('assets/dist/js/custom.js') }}" type="text/javascript"></script>
        <div id="confirm" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content ">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Confirm Identity</h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel panel-bd lobidrag">
                            <div class="panel-body">
                                <form method="POST" action="{{ route('switchback') }}">
                                  {{ csrf_field() }}

                                  <div class="form-group">
                                      <label class="control-label" for="unique_id">Login Username</label>
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

                                  <div>
                                      <button class="btn btn-primary">Confirm</button>
                                  </div>
                              </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>