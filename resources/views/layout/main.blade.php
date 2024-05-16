<!DOCTYPE html>
<html lang="en" >
<head>
  
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  @yield('title')
  
  <!-- Bootstrap -->
  <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <!-- NProgress -->
  <link href="{{asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
  <!-- iCheck -->
  <link href="{{asset('vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
  <!-- Switchery -->
  <link href="{{asset('vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet">
  <!-- Datatables -->
  <link href="{{asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
  
  <!-- jQuery custom content scroller -->
  <link href="{{asset('vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css')}}" rel="stylesheet"/>
  
  <!-- FullCalendar -->
  <link href="{{asset('vendors/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendors/fullcalendar/dist/fullcalendar.print.css')}}" rel="stylesheet" media="print">
  <!-- Custom Theme Style -->
  <link href="{{asset('build/css/custom.css?v=').time()}}" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
  
  <!-- SweetAlert -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  
  <!-- Date Range Picker -->
  <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  
  <!-- Midtrans -->
  <script type="text/javascript" 
  src="https://app.midtrans.com/snap/snap.js"
  data-client-key="{{env('MIDTRANS_CLIENT_KEY')}}"></script>
  
  <!-- Include Date Range Picker -->
  <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js" defer></script>
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" defer/>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropify/dist/css/dropify.min.css">
  
  <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
  <script src="https://printjs-4de6.kxcdn.com/print.min.css"></script>
  <style>
    /* Style the edit button */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    
    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
    
    .edit-button {
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    
    .edit-button:hover {
      background-color: #0056b3;
    }
    
    /* Make the image responsive */
    .image-container {
      max-width: 100%;
      height: auto;
    }
    
    /* Style disabled option text */
    select option[disabled] {
      color: black; /* Change the color to a grayish tone */
      font-style: italic; /* Make the text italic */
    }
    
    /* Style disabled option background */
    select option[disabled] {
      background-color: #eeeeee; /* Change the background color to a light gray */
    }
    
    /* Style disabled option cursor */
    select option[disabled] {
      cursor: not-allowed; /* Change the cursor to indicate it's not selectable */
    }
  </style>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col menu_fixed">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><img src="{{asset('production/images/logo.png')}}" height="50px" alt=""></a>
          </div>
          
          <div class="clearfix"></div>
          
          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="{{asset('production/images/images.png')}}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2>{{auth()->user()->name}}</h2>
            </div>
          </div>
          <!-- /menu profile quick info -->
          
          <br />
          
          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>General</h3>
              <ul class="nav side-menu">
                <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                    @if(auth()->user()->role == 'admin')
                    <li><a href="{{route('admin.index')}}">Data Admin</a></li>
                    <li><a href="{{route('front.index')}}">Login's Poster</a></li>
                    @endif
                  </ul>
                </li>
                @if(auth()->user()->role == 'admin')
                <li><a><i class="fa fa-users"></i> Agent 
                  @if (auth()->user()->unreadNotifications->where('type', 'App\Notifications\AgentRequestNotifications')->count() > 0)
                  <span class="badge progress-bar-danger bg-success">{{auth()->user()->unreadNotifications->where('type', 'App\Notifications\AgentRequestNotifications')->count()}}</span> 
                  @endif
                  <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="{{route('agent.index')}}">Data Agent</a></li>
                    <li><a href="{{route('request-agent.index')}}">Agent Proposal 
                      @if (auth()->user()->unreadNotifications->where('type', 'App\Notifications\AgentRequestNotifications')->count() > 0)
                      <span class="badge progress-bar-danger bg-success badge-xs">{{auth()->user()->unreadNotifications->where('type', 'App\Notifications\AgentRequestNotifications')->count()}}</span>
                      @endif
                    </a>
                  </li>
                </ul>
              </li>
              @endif
              @if(auth()->user()->role == 'admin')
              <li><a><i class="fa fa-plane"></i> Products <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="{{route('produk.index')}}">Data Products</a></li>
                  <li><a href="{{route('jadwal.index')}}">Schedules</a></li>
                </ul>
              </li>
              @endif
              <li><a><i class="fa fa-calendar"></i> Booking <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="{{route('booking.index')}}">Schedule List</a></li>
                  @if(auth()->user()->role == 'agent')
                  <li><a href="{{route('my-booking.index')}}">My Booking</a></li>
                  @endif
                </ul>
              </li>
              <li><a><i class="fa fa-star"></i> Redeem 
                @if (auth()->user()->unreadNotifications->where('type', 'App\Notifications\RedeemRequest')->count() > 0)
                <span class="badge progress-bar-danger bg-success">{{auth()->user()->unreadNotifications->where('type', 'App\Notifications\RedeemRequest')->count()}}</span> 
                @endif
                <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  @if(auth()->user()->role == 'admin')
                  <li><a href="{{route('redeem.req')}}">Redeem Request
                    @if (auth()->user()->unreadNotifications->where('type', 'App\Notifications\RedeemRequest')->count() > 0)
                    <span class="badge progress-bar-danger bg-success">{{auth()->user()->unreadNotifications->where('type', 'App\Notifications\RedeemRequest')->count()}}</span> 
                    @endif</a></li>
                    @endif
                    <li><a href="{{route('redeem.index')}}">Prize List</a></li>
                    @if(auth()->user()->role == 'agent')
                    <li><a href="{{route('redeem-history.index')}}">Redeem History</a></li>
                    @endif
                  </ul>
                </li>
                <li><a><i class="fa fa-list-alt"></i> Report <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="{{route('report.index')}}">Sales Report</a></li>
                  </ul>
                </li>
              </ul>
            </div>
            
            
          </div>
          <!-- /sidebar menu -->
          
          
          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small text-white">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
              <span style="color:white" class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
              <span style="color:white" class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
              <span style="color:white" class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a style="color:white" class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>
          
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
        <!-- /menu footer buttons -->
      </div>
    </div>
    
    <!-- top navigation -->
    <div class="top_nav">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>
          
          
          <ul class="nav navbar-nav navbar-right">
            
            <li class="">
              <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >
                <img src="{{asset('production/images/images.png')}}" alt="">
                <span style="color: #73879C">{{auth()->user()->name}}</span>
                <span class=" fa fa-angle-down" style="color: #73879C"></span>
              </a>
              <ul class="dropdown-menu dropdown-usermenu pull-right">
                <li> <a style="color:black" class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  Logout
                </a>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form></li>
              </ul>
            </li>
            
            <li role="presentation" class="dropdown">
              
              
              <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                <li >
                  
                  <a>
                    <span class="image"><img src="{{asset('production/images/img.jpg')}}" alt="Profile Image" /></span>
                    <span>
                      <span style="color: #73879C">John Smith</span>
                      <span class="time">3 mins ago</span>
                    </span>
                    <span class="message">
                      Film festivals used to be do-or-die moments for movie makers. They were where...
                    </span>
                  </a>
                </li>
                <li >
                  <a>
                    <span class="image"><img src="{{asset('production/images/img.jpg')}}" alt="Profile Image" /></span>
                    <span>
                      <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                    </span>
                    <span class="message">
                      Film festivals used to be do-or-die moments for movie makers. They were where...
                    </span>
                  </a>
                </li>
                <li>
                  <a>
                    <span class="image"><img src="{{asset('production/images/img.jpg')}}" alt="Profile Image" /></span>
                    <span>
                      <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                    </span>
                    <span class="message">
                      Film festivals used to be do-or-die moments for movie makers. They were where...
                    </span>
                  </a>
                </li>
                <li>
                  <a>
                    <span class="image"><img src="{{asset('production/images/img.jpg')}}" alt="Profile Image" /></span>
                    
                    <span>
                      <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                    </span>
                    <span class="message">
                      Film festivals used to be do-or-die moments for movie makers. They were where...
                    </span>
                  </a>
                </li>
                <li>
                  <div class="text-center">
                    <a>
                      <strong>See All Alerts</strong>
                      <i class="fa fa-angle-right"></i>
                    </a>
                  </div>
                </li>
              </ul>
            </li>
            <li class="">
              <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >
                <span style="backcolor: yellow"><i class="fa fa-star" style="color:#FFFF00; background-color:#129B44; padding:5px; border-radius:5px"></i> </span>
                <span style="color: #73879C">Your Points : </span>
                <span style="color: #73879C">{{auth()->user()->point}}</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- /top navigation -->
    
    <!-- page content -->
    @yield('content')
    <!-- /page content -->
    
    <!-- footer content -->
    <footer>
      <!--<div class="pull-right" >
        Published by <a style="color: blue" href="https://klienjasawebsite.id.tc/" target="_blank">Exado Developer</a>
      </div>-->
      <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
  </div>
</div>

<!-- jQuery -->
<script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('vendors/fastclick/lib/fastclick.js')}}"></script>
<!-- NProgress -->
<script src="{{asset('vendors/nprogress/nprogress.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('vendors/iCheck/icheck.min.js')}}"></script>
<!-- Datatables -->
<script src="{{asset('vendors/datatables.net/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-buttons/js/buttons.print.js')}}"></script>
<script src="{{asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
<script src="{{asset('vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
<script src="{{asset('vendors/jszip/dist/jszip.min.js')}}"></script>
<script src="{{asset('vendors/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{asset('vendors/pdfmake/build/vfs_fonts.js')}}"></script>
<!-- jQuery custom content scroller -->
<script src="{{asset('vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Switchery -->
<script src="{{asset('vendors/switchery/dist/switchery.min.js')}}"></script>

<!-- jQuery Smart Wizard -->
<script src="{{asset('vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js')}}"></script>

<!-- Custom Theme Scripts -->
<script src="{{asset('build/js/custom.js')}}"></script>

<!-- FullCalendar -->
<script src="{{asset('vendors/moment/min/moment.min.js')}}"></script>
<script src="{{asset('vendors/fullcalendar/dist/fullcalendar.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/dropify/dist/js/dropify.min.js"></script>
<script>
  $(document).ready(function() {
    // Initialize Dropify
    $('.dropify').dropify();
  });
</script>

</body>
</html>