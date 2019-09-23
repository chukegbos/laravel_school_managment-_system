<aside class="main-sidebar">
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="info">
               <p><span style="padding: 10px">Welcome, {{ ucfirst(Auth::user()->username) }}</span></p>
            </div>
        </div>
       
        <!-- sidebar menu -->
        <ul class="sidebar-menu">
            <li>
                <a href="{{ url('/') }}"><i class="fa fa-hospital-o"></i><span>Dashboard</span>
                </a>
            </li>
            @if(Auth::user()->role=="Zalla Admin")

                <li class="treeview">
                    <a href="">
                        <i class="fa fa-bank"></i><span>Schools</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/schools') }}/?school_status=Active">Active School</a></li>
                        <li><a href="{{ url('/admin/schools') }}/?school_status=Trial">On Trial</a></li> 
                        <li><a href="{{ url('/admin/schools') }}/?school_status=Request">On Request</a></li>
                        <li><a href="{{ url('/admin/schools') }}/?school_status=Inactive">Inactive School</a></li>         
                    </ul>
                </li>


                <li class="treeview">
                    <a href="">
                        <i class="fa fa-edit"></i><span>Support/Tickets</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/opentickets') }}">Create Tickets</a></li>
                        <li><a href="{{ url('/admin/tickets') }}">Tickets</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="">
                        <i class="fa fa-user-circle-o"></i><span>Resources</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/consultants') }}">Consultants</a></li>
                        <li><a href="{{ url('/admin/representatives') }}">Representatives</a></li> 
                        <li><a href="{{ url('/admin/admins') }}">Admin</a></li>           
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-sitemap"></i><span>Scratch Card</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/pins') }}">All PINs</a></li>
                        <li><a href="{{ url('/admin/generatepin') }}">Generate PIN</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ url('/admin/schools') }}"><i class="fa fa-gear"></i><span>Schools Request</span>
                    </a>
                </li>
            @elseif((Auth::user()->role=="Entrance Admin") || (Auth::user()->role=="Admin"))
                @if(Auth::user()->role=="Entrance Admin")
                    <li>
                        <a href="#" data-toggle="modal" data-target="#confirm" ><i class="fa fa-bank"></i><span>Switch Back</span>
                        </a>
                    </li>
                @endif
                <li class="treeview">
                    <a href="#">
                        <i class="hvr-buzz-out fa fa-building"></i><span>Admission</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/admissionform') }}">Admission Forms</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="hvr-buzz-out fa fa-audio-description"></i><span>Administration</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/schoolsetting') }}">School Setting</a></li>
                        <li><a href="{{ url('/admin/schoolstamp') }}">School Stamp</a></li>
                        <li><a href="{{ url('/admin/schoollogo') }}">School Logo</a></li>
                        <li><a href="{{ url('/admin/resulttemplate') }}">Set Result Template</a></li>
                        <li><a href="{{ url('/admin/sessions') }}">Academic Session</a></li>
                        <li><a href="{{ url('/admin/standard') }}">Academic Standards</a></li>
                        <li><a href="{{ url('/admin/admins') }}">Admins</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="hvr-buzz-out fa fa-briefcase"></i><span>Academics</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/subject') }}">Manage Subjects</a></li>
                        <li><a href="{{ url('/admin/classes') }}">Manage Class</a></li>
                        <li><a href="{{ url('/admin/staff') }}">Manage Staff</a></li>
                        <li><a href="{{ url('/admin/students') }}">Manage Students</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="hvr-buzz-out fa fa-address-card-o"></i><span>Result Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('admin/addresult') }}">Add/Edit/View Class Result</a></li>
                        <li><a href="{{ url('admin/viewresult') }}">View Student Result</a></li>
                        <li><a href="{{ url('admin/addassessment') }}">Behavioural Grading</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-bed"></i><span>Hostel Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/hostels') }}">Hostels</a></li>
                        <li><a href="{{ url('/admin/bed') }}">Bed Allocations</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-sitemap"></i><span>Attendance Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#">Mark  Attendant</a></li>
                        <li><a href="#">View Attendant</a></li>
                    </ul>
                </li>

                <!--<li class="treeview">
                    <a href="#">
                        <i class="fa fa-money"></i><span>Fee Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/sessions') }}">Academic Session</a></li>
                        <li><a href="{{ url('/admin/standard') }}">Academic Standards</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="hvr-buzz-out fa fa-ambulance"></i><span>Clinic Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/sessions') }}">Academic Session</a></li>
                        <li><a href="{{ url('/admin/standard') }}">Academic Standards</a></li>
                    </ul>
                </li>-->

                <li class="treeview">
                    <a href="#">
                        <i class="hvr-buzz-out fa fa-book"></i><span>Library Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/books') }}">Books</a></li>
                        <li><a href="{{ url('/admin/lend') }}">On Hire</a></li>
                        <li><a href="{{ url('/admin/lendhistory') }}">History</a></li>
                    </ul>
                </li>

                <!--<li class="treeview">
                    <a href="#">
                        <i class="hvr-buzz-out fa fa-newspaper-o"></i><span>News & Publications</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/sessions') }}">Blog</a></li>
                        <li><a href="{{ url('/admin/standard') }}">Newsletter</a></li>
                        <li><a href="{{ url('/admin/standard') }}">Announcement</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('/admin/openticket') }}"><i class="hvr-buzz-out fa fa-ticket"></i><span>Mail/Help</span>
                    </a>
                </li>-->
            @elseif(Auth::user()->role=="Staff")
                <li>
                    <a href="{{ url('/admin/formclass') }}">
                        <i class="fa fa-home"></i><span>Form Class</span>
                    </a>
                </li>

                <li>
                  <a href="{{ url('/admin/subjectclass') }}">
                    <i class="fa fa-plus"></i><span>Subject Class</span>
                  </a>
                </li>
                
                <li>
                  <a href="{{ url('/admin/subjectclasshistory') }}">
                    <i class="fa fa-truck"></i>  <span>Subject Class History</span>
                  </a>
                </li>
            @elseif(Auth::user()->role=="Student")
                <li>
                  <a href="{{ url('/admin/studentresult') }}">
                    <i class="fa fa-plus"></i> <span>My Result</span>
                  </a>
                </li>
            @endif
            <!--<li>
                <a href="{{ url('/password') }}"><i class="fa fa-user"></i><span>Profile</span>
                </a>
            </li>

            <li>
                <a href="#"><i class="fa fa-home"></i><span>Visit Website</span>
                </a>
            </li>-->

            <li>
                <a href="{{ url('/password') }}"><i class="fa fa-key"></i><span>Change Password</span>
                </a>
            </li>

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
    </div>
</aside>