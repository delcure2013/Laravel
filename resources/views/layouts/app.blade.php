<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>DLL Stock Management - @yield('title')</title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/png">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- Bootstrap 3.3.7 -->
      <link rel="stylesheet" href="{{ asset('css/bootstrap/dist/css/bootstrap.min.css') }}">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}">
      <!-- Ionicons -->
      <link rel="stylesheet" href="{{ asset('css/Ionicons/css/ionicons.min.css') }}">
      <!-- Select2 -->
      <link rel="stylesheet" href="{{ asset('css/select2/dist/css/select2.min.css') }}">
      <!-- DataTables -->
      <link rel="stylesheet" href="{{ asset('css/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
      <!-- bootstrap datepicker -->
      <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
	  <!-- iCheck for checkboxes and radio inputs -->
	  <link rel="stylesheet" href="{{ asset('css/plugins/iCheck/all.css') }}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{ asset('css/dist/css/AdminLTE.min.css') }}">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="{{ asset('css/dist/css/skins/_all-skins.min.css') }}">
      <link rel="stylesheet" href="{{ asset('css/custom/mycss.css') }}">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- Google Font -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
      <style>.heading
         {
         background-color:#C2E7F8; color:black; padding:3px;
         border-radius:4px; border:1px solid #2C4E8E;
         font-size:13pt;
         font-weight:bold;
         font-family:Garamond;
         box-shadow: 3px 4px 2px #D3D3D3;
         }
      </style>
   </head>
   <body class="hold-transition skin-blue sidebar-mini">
      <!-- Site wrapper -->
      <div class="wrapper">
         @if (Auth::guest())
         <header class="main-header">
            <!-- Logo -->
            <a href="index2.html" class="logo">
               <!-- mini logo for sidebar mini 50x50 pixels -->
               <span class="logo-mini"><b>DLL</b></span>
               <!-- logo for regular state and mobile devices -->
               <span class="logo-lg"><b>DELCURE</b></span>
            </a>
            <nav class="navbar navbar-static-top">
               <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                     <li><a href="{{ route('login') }}">Login</a></li>
                  </ul>
               </div>
            </nav>
         </header>
         @else
         <header class="main-header">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="logo">
               <!-- mini logo for sidebar mini 50x50 pixels -->
               <span class="logo-mini"><b>DLL</b></span>
               <!-- logo for regular state and mobile devices -->
               <span class="logo-lg"><b>DELCURE</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
               <!-- Sidebar toggle button-->
               <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </a>
               <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                     <!-- Messages: style can be found in dropdown.less-->
                     <!-- User Account: style can be found in dropdown.less -->
                     <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user-circle-o"></i>
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                           <!-- Menu Footer-->
                           <li class="user-footer">
                              <div class="pull-right">
                                 <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>
                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                 </form>
                              </div>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </div>
            </nav>
         </header>
         @endif
         <!-- =============================================== -->
         @if (Auth::guest() == false)
         <!-- Left side column. contains the sidebar -->
         <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
               <!-- search form -->
               <form action="#" method="get" class="sidebar-form">
                  <div class="input-group">
                     <input type="text" name="q" class="form-control" placeholder="Search...">
                     <span class="input-group-btn">
                     <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                     </button>
                     </span>
                  </div>
               </form>
               <!-- /.search form -->
               <!-- sidebar menu: : style can be found in sidebar.less -->
               <ul class="sidebar-menu" data-widget="tree">
                  <li class="header">MAIN NAVIGATION</li>
				   <li class="treeview">
                     <a href="#">
                     <i class="fa fa-address-book-o"></i> <span>SUPPLIER</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="{{url('/supplier/create')}}"><i class="fa fa-circle-o"></i>ADD</a></li>
                        <li><a href="{{url('/supplier/index')}}"><i class="fa fa-circle-o"></i>LIST</a></li>
                     </ul>
                  </li>
				                    <li><a href="{{url('/location/index')}}"><i class="fa fa-map-marker"></i> <span>LOCATIONS</span></a></li>
                  <li><a href="{{url('/unit/index')}}"><i class="fa fa-percent"></i> <span>UNITS</span></a></li>
                  <li><a href="{{url('/brand/index')}}"><i class="fa fa-tags"></i> <span>BRANDS</span></a></li>
				   <li class="treeview">
                     <a href="#">
                     <i class="fa fa-sitemap"></i> <span>CATEGORY</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="{{url('/category/create')}}"><i class="fa fa-circle-o"></i>ADD</a></li>
                        <li><a href="{{url('/category/index')}}"><i class="fa fa-circle-o"></i>LIST</a></li>
                     </ul>
                  </li>
                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-cube"></i>
                     <span>ITEMS</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="{{url('/items/create')}}"><i class="fa fa-circle-o"></i> ADD</a></li>
                        <li><a href="{{url('/items/index')}}"><i class="fa fa-circle-o"></i> LIST</a></li>
                     </ul>
                  </li>
                 
                 
                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-cubes"></i> <span>STOCK</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
					  <li><a href="{{url('/stockStatus/index')}}""><i class="fa fa-circle-o"></i>STOCK STATUS</a></li>
					  <li><a href="{{url('/stockAssign/index')}}""><i class="fa fa-circle-o"></i>STOCK ASIGNED</a></li>
                      <li><a href="{{url('/stock/index')}}""><i class="fa fa-circle-o"></i>STOCK IN</a></li>
                   <!--   <li><a href="#"><i class="fa fa-circle-o"></i>STOCK OUT</a></li>-->
                     </ul>
                  </li>
                  <li class="header">LABELS</li>
                  <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
                  <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
                  <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
               </ul>
            </section>
            <!-- /.sidebar -->
         </aside>
         @endif
         <!-- =============================================== -->
         @if (Auth::guest() == false)
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <h1>
                  Dashboard
                  <small>Control panel</small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">@yield('breadcrumb')</li>
               </ol>
            </section>
            <!-- Main content -->
            <section class="content">
               <div class="row">
                  <div class="col-md-12">
                     <!-- Default box -->
                     <div class="box box-info">
                        <div class="box-header with-border">
                           <h3 class="box-title">@yield('breadcrumb')</h3>
                        </div>
                        <div class="box-body">
                           @yield('content')
                        </div>
                        <!-- /.box-body -->
                     </div>
                     <!-- /.box -->
                  </div>
               </div>
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
         @else
         <div class="app">
            @yield('content')
         </div>
         @endif
         <footer class="main-footer">
            <div class="pull-right hidden-xs">
               <b>Developed By</b> Delcure IT Team
            </div>
            <strong>Copyright &copy; {{ date('Y') }} <a href="www.delcure.com">DelCure LifeSciences Ltd</a>.</strong> All rights
            reserved.
         </footer>
         <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
         <div class="control-sidebar-bg"></div>
      </div>
      <!-- ./wrapper -->
      <!-- jQuery 3 -->
      <script src=" {{ asset('css/jquery/dist/jquery.min.js') }}"></script>
      <!-- Bootstrap 3.3.7 -->
      <script src="{{ asset('css/bootstrap/dist/js/bootstrap.min.js') }}"></script>
      <!-- Select2 -->
      <script src="{{ asset('css/select2/dist/js/select2.full.min.js') }}"></script>
      <!-- Add items -->
      <script src="{{ asset('css/custom/my_js.js') }}"></script>
      <!-- DataTables -->
      <script src="{{ asset('css/datatables.net/js/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('css/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
      <!-- bootstrap datepicker -->
      <script src="{{ asset('css/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
      <!-- Slimscroll -->
      <script src="{{ asset('css/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
      <!-- FastClick -->
      <script src="{{ asset('css/fastclick/lib/fastclick.js') }}"></script>
      <!-- AdminLTE App -->
      <script src="{{ asset('js/adminlte.min.js') }}"></script>
	  <!-- iCheck 1.0.1 -->
	<script src="{{ asset('css/plugins/iCheck/icheck.min.js') }}"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="{{ asset('js/demo.js') }}"></script>
      <script>
         $(document).ready(function() {
         //Select picker
         $('.select2').select2();
         //Date picker
         $('.datepicker').datepicker({
         format: 'dd/mm/yyyy',
         autoclose: true
         });
		 //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
	
	

         
          });
         
      </script>
   </body>
</html>