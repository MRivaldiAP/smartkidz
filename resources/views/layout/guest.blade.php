<!DOCTYPE html>
<html lang="en">
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
     <link href="{{asset('build/css/custom.css')}}" rel="stylesheet">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- top navigation -->
        <div class="top_nava">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <img src="{{asset('production/images/logo.png')}}" alt="">
              </div>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        @yield('content')
        <!-- /page content -->

        <!-- footer content -->
    
          <!--<div class="pull-right" style="background : #8DC63F; color:white; margin-left:20px; padding:10px">
            Published by <a style="color: white" href="https://klienjasawebsite.id.tc/" target="_blank">Exado Developer</a>
          </div>-->
       
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
     <script src="{{asset('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
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
 
     
 
     <!-- Custom Theme Scripts -->
     <script src="{{asset('build/js/custom.min.js')}}"></script>
 
     <!-- FullCalendar -->
     <script src="{{asset('vendors/moment/min/moment.min.js')}}"></script>
     <script src="{{asset('vendors/fullcalendar/dist/fullcalendar.min.js')}}"></script>
 
  </body>
</html>