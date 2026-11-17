
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>APCA Admin</title>
    <link rel="icon" type="image/png" href="{{url('/')}}/favicon.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{url('/')}}/admin_assets/bootstrap/dist/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{url('/')}}/admin_assets/font-awesome/css/font-awesome.min.css">   
    
    <link rel="stylesheet" href="{{url('/')}}/admin_assets/css/AdminLTE.min.css">
   
    <link rel="stylesheet" href="{{url('/')}}/admin_assets/css/skins/skin-blue.min.css">

     <link rel="stylesheet" href="{{url('/')}}/admin_assets/css/custom.css"> 
  
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
          <style type="text/css">
            .ILBody .main-header .logo .logo-lg img{
              width: auto !important;
            }
          </style>
  </head>

<body class="hold-transition skin-blue sidebar-mini ILBody">
  <span class="text-center margin-ptag margintop">
  <span id="pleasewaitimage">
     <img src="{{url('/')}}/admin_assets/img/loader.svg" />
  </span>
</span>

<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="{{url('/admin/dashboard')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="{{url('/')}}/assets/images/Logo.svg" class="logo-image-mini" alt="logo Image" width="50"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        <img src="{{url('/')}}/assets/images/Logo.svg" class="logo-image-mini img-responsive" alt="logo Image" style="height: 50px;">
      </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         
          <!-- User Account Menu -->
  
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->           
             
            
                <img src="{{url('/')}}/admin_assets/img/user-profile.png" class="user-image" alt="User Image">
                
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">Welcome </span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="{{url('/admin/logout')}}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
              <!-- <li class="user-footer">
                  <div class="pull-right">
                    <a href="{{url('/iladmin/edit_profile')}}" class="btn btn-default btn-flat">Edit Profile</a>
                  </div>
                </li> -->
            </ul>
          </li>
        
        </ul>
      </div>
    </nav>
  </header>