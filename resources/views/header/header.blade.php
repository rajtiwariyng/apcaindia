<?php
$segment1 =  Request::segment(1);
$segment2 =  Request::segment(2);

if ($segment1 == "") {
    $seo_url = "/";
    $sticky_header = "fixed-top";
} else if ($segment2 == "") {
    $seo_url = trim($segment1);
} else {
    $seo_url = trim($segment1 . '/' . $segment2);
}


$seodata = DB::table('tbl_seo')->where('url_slug', '=', $seo_url)->get();

if (count($seodata) > 0) {
    $seo_desc = trim($seodata['0']->seo_desc);
    $seo_keywords = trim($seodata['0']->seo_keywords);
    $seo_title = trim($seodata['0']->seo_title);
} else {
    $seo_desc = "";
    $seo_keywords = "";
    $seo_title = "";
}

// dd($seo_title);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $seo_title !== '' ? $seo_title : 'APCA' }}</title>
    @if($seo_desc !== '')<meta name="description" content="{{ $seo_desc }}">@endif
    @if($seo_keywords !== '')<meta name="keywords" content="{{ $seo_keywords }}">@endif
    <link rel="icon" type="image/png" href="{{url('/')}}/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{url('/')}}/assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="{{url('/')}}/assets/css/fancybox.css">
    <link rel="stylesheet" href="{{url('/')}}/assets/css/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="{{url('/')}}/assets/css/aos.css">
    <link rel="stylesheet" href="{{url('/')}}/assets/css/spacer.css" />
    <link rel="stylesheet" href="{{url('/')}}/assets/css/menu.css" />
    <link rel="stylesheet" href="{{url('/')}}/assets/css/style.css" />
    <link rel="stylesheet" href="{{url('/')}}/assets/css/responsive.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
    <script src="{{url('/')}}/assets/js/jquery.min.js"></script>

  </head>
  <body>
    <header class="header" id="header">
      <div class="header-item item-left">
        <div class="logo">
          <a href="{{url('/')}}"><img src="{{url('/')}}/assets/images/apca-india-white.png" class="d-lg-block d-none" alt="" /></a>
          <a href="{{url('/')}}"><img src="{{url('/')}}/assets/images/apca-india-blue.png" class="d-lg-none d-block blue-logo" alt="" /></a>
        </div>
        <div class="d-flex">
          <div>
            <button class="btn"><i class="fas fa-search"></i></button>
             <form method="GET" action="{{ route('search.posts') }}">
                <div class="search-box me-2">
                  <input
                    type="text"
                    class="form-control"
                    name="term"
                    placeholder="What do you want to learn today?"
                  />
                  <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
          </div>
          <div class="mobile-menu-trigger">
            <span></span>
          </div>
        </div>
       
        <!-- <a class="apply-now top-btn" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Apply</a> -->
      </div>
      <!-- menu start here -->
      <div class="header-item item-center">
        <div class="menu-overlay"></div>
        <nav class="menu">
          <div class="mobile-menu-head">
            <div class="go-back"><i class="fa fa-angle-left"></i></div>
            <div class="current-menu-title"></div>
            <div class="mobile-menu-close">&times;</div>
          </div>
          <ul class="menu-main">
            <li class="menu-item-has-children">
              <a href="#">APCA Programs <i class="fa fa-angle-down"></i
                ></a>
              <div class="sub-menu single-column-menu">
                <div class="row">
                  <ul>
                    <li>
                      <a class="dropdown-item" href="{{url('/')}}/course/advanced-diploma-in-pastry-bakery-arts">Advanced Diploma in Pastry & Bakery Arts</a>
                    </li>
                    <li><a class="dropdown-item" href="{{url('/')}}/course/advanced-diploma-in-culinary-arts">Advanced Diploma in Culinary Arts</a></li>
                    <li><a class="dropdown-item" href="{{url('/')}}/course/bachelor-degree-with-specialization-in-pastry-culinary-arts">Bachelor Degree – Full Time Course</a></li>
                    <li><a class="dropdown-item" href="{{url('/')}}/course/weekend-part-time-pastry-program">Weekend Part-Time Pastry Program</a></li>
                    <li><a class="dropdown-item" href="{{url('/')}}/course/weekend-part-time-culinary-program">Weekend Part Time Culinary</a></li>
                    <!-- <li><a class="dropdown-item" href="{{url('/')}}/course/advanced-diploma-dual-program">Advanced Diploma Dual Program</a></li> -->
                    <!-- <li><a class="dropdown-item" href="{{url('/')}}/course/days-24-intensive-pastry-program">24 Days Intensive Pastry Program</a></li> -->
                    <!-- <li><a class="dropdown-item" href="{{url('/')}}/course/weeks2-intensive-chocolate-program">2 Weeks Intensive Chocolate Program</a></li> -->
                    
                    <!-- <li><a class="dropdown-item" href="https://www.asiapastryforum.com" target="_blank">Asia Pastry Forum</a></li> -->
                  </ul>
                </div>
              </div>
            </li>
            <li class="menu-item-has-children">
              <a href="{{url('/')}}/chef-educators">Chef Educators</a>
              <!-- <div class="sub-menu single-column-menu">
                <div class="row">
                  <ul>
                    <li><a class="dropdown-item" href="{{url('/')}}/faculty">Chef 1</a></li>
                    <li><a class="dropdown-item" href="{{url('/')}}/faculty">Chef 2</a></li>
                  </ul>
                </div>
              </div> -->
            </li>
            <li class="menu-item-has-children">
              <a href="#">Explore <i class="fa fa-angle-down"></i
                ></a>
              <div class="sub-menu single-column-menu">
                <div class="row">
                  <ul>
                    <li><a class="dropdown-item" href="{{url('/')}}/about-us">About Us</a></li>
                    <li><a class="dropdown-item" href="{{url('/')}}/message-from-founder">Founder's Message</a></li>
                    <li><a class="dropdown-item" href="{{url('/')}}/awards-accolades">Awards & Accolades</a></li>
                    <li><a class="dropdown-item" href="{{url('/')}}/apca-alumni">APCA Alumni</a></li>
                    <li><a class="dropdown-item" href="{{url('/')}}/gallery">Gallery</a></li>
                  </ul>
                </div>
              </div>
            </li>
            <!-- <li><a href="{{url('/')}}/faq">Faqs</a></li> -->
            <li>
              <a href="{{url('/')}}/contact-us">Contact us</a>
            </li>
            <li class="d-lg-block d-none">
              <form method="GET" action="{{ route('search.posts') }}">
                  <div class="search-box me-2 d-flex">
                    <input
                      type="text"
                      class="form-control"
                      name="term"
                      placeholder="What do you want to learn today?"
                      required
                    />
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                  </div>
                </form>

            </li>
            <!-- <li class="d-lg-block d-none"><a class="apply-now" href="#">Apply Now</a></li> -->
            <li class="d-lg-block"><button class="apply-now" id="zf_button_670730">Apply</button></li>
          </ul>
        </nav>
      </div>
    </header>
