<style type="text/css">
    .main-sidebar .sidebar-menu .fa {
        font-size: 1.3em; 
        margin-right: 5px;
        color: #b8c7ce; 
    }
</style>
<aside class="main-sidebar">
    <section class="sidebar">
        @php
            $lastSegment = collect(request()->segments())->last();
        @endphp

        <ul class="sidebar-menu" data-widget="tree">
            <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ url('/admin/dashboard') }}">
                    <i class="fa fa-tachometer"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="{{ request()->is('admin/bannervideo*') ? 'active' : '' }}">
                <a href="{{ url('/admin/bannervideo/listing') }}">
                    <i class="fa fa-film"></i> <span>All Banner / Video</span>
                </a>
            </li>

            <li class="{{ request()->is('admin/studentsection/listing*') ? 'active' : '' }}">
                <a href="{{ url('/admin/studentsection/listing') }}">
                    <i class="fa fa-users"></i> <span>Student Section</span>
                </a>
            </li>

            <li class="treeview {{ request()->is('admin/success-banner*') || request()->is('admin/homeslidercontent*') || request()->is('admin/homeslidercontent*') ? 'active menu-open' : '' }}">
                <a href="#">
                    <i class="fa fa-home"></i> <span>Home Page</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="{{ (request()->is('admin/homeslider*') || request()->is('admin/homeprogram*')) ? 'display:block;' : 'display:none;' }}">
                    <li class="{{ request()->is('admin/homeslider*') ? 'active' : '' }}">
                        <a href="{{ url('/admin/homeslider/listing') }}">
                            <i class="fa fa-image"></i> <span>Home Slider</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/homeslidercontent/create*') ? 'active' : '' }}">
                        <a href="{{ url('/admin/homeslidercontent/create/236846c98e2b9d8') }}">
                            <i class="fa fa-file-text-o"></i> <span>Slider Content</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/homeprogram*') ? 'active' : '' }}">
                        <a href="{{ url('/admin/homeprogram/listing') }}">
                            <i class="fa fa-briefcase"></i> <span>Home Program</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ request()->is('admin/blog/bloglisting*') ? 'active' : '' }}">
                <a href="{{ url('/admin/blog/bloglisting') }}">
                    <i class="fa fa-newspaper-o"></i> <span>Manage Blogs</span>
                </a>
            </li>

            <li class="{{ request()->is('admin/blogcategory/listing*') ? 'active' : '' }}">
                <a href="{{ url('/admin/blogcategory/listing') }}">
                    <i class="fa fa-newspaper-o"></i> <span>Blogs Categories</span>
                </a>
            </li>

            <li class="{{ request()->is('admin/testimonial*') ? 'active' : '' }}">
                <a href="{{ url('/admin/testimonial/listing') }}">
                    <i class="fa fa-quote-left"></i> <span>Manage Testimonials</span>
                </a>
            </li>

            <li class="{{ request()->is('admin/gallery/listing*') ? 'active' : '' }}">
                <a href="{{ url('/admin/gallery/listing') }}">
                    <i class="fa fa-picture-o"></i> <span>Gallery</span>
                </a>
            </li>

            <li class="{{ request()->is('admin/contactus*') ? 'active' : '' }}">
                <a href="{{ url('/admin/contactus') }}">
                    <i class="fa fa-calendar"></i> <span>Appointment Data</span>
                </a>
            </li>

            <li class="{{ request()->is('admin/placementpartners*') ? 'active' : '' }}">
                <a href="{{ url('/admin/placementpartners/listing') }}">
                    <i class="fa fa-handshake-o"></i> <span>Placement Partners</span>
                </a>
            </li>

            <li class="{{ request()->is('admin/supportingbrands*') ? 'active' : '' }}">
                <a href="{{ url('/admin/supportingbrands/listing') }}">
                    <i class="fa fa-building-o"></i> <span>Supporting Brands</span>
                </a>
            </li>

            <li class="{{ request()->is('admin/chefeducators*') ? 'active' : '' }}">
                <a href="{{ url('/admin/chefeducators/listing') }}">
                    <i class="fa fa-graduation-cap"></i> <span>Chef Educators</span>
                </a>
            </li>

            <li class="{{ request()->is('admin/alumni*') ? 'active' : '' }}">
                <a href="{{ url('/admin/alumni/listing') }}">
                    <i class="fa fa-graduation-cap"></i> <span>Manage Alumni</span>
                </a>
            </li>

            <li class="{{ request()->is('admin/coursepage*') ? 'active' : '' }}">
                <a href="{{ url('/admin/coursepage/listing') }}">
                    <i class="fa fa-book"></i> <span>Manage Coursepage</span>
                </a>
            </li>

            <li class="{{ request()->is('admin/pages*') ? 'active' : '' }}">
                <a href="{{ url('/admin/pages/listing') }}">
                    <i class="fa fa-file"></i> <span>Manage Page</span>
                </a>
            </li>

            
            <li class="treeview {{ request()->is('admin/intprogram*') || request()->is('admin/intcontent*') || request()->is('admin/intprogrampage*') ? 'active menu-open' : '' }}">
                <a href="#">
                    <i class="fa fa-globe"></i> <span>International Page</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="{{ (request()->is('admin/intprogrampage*') || request()->is('admin/intprogram*') || request()->is('admin/intcontent*')) ? 'display:block;' : 'display:none;' }}">
                    <li class="{{ request()->is('admin/intprogram*') ? 'active' : '' }}">
                        <a href="{{ url('/admin/intprogram/listing') }}">
                            <i class="fa fa-briefcase"></i> <span>International Program</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/intcontent/create/*') ? 'active' : '' }}">
                        <a href="{{ url('/admin/intcontent/create/4168554f2f3d787') }}">
                            <i class="fa fa-file"></i> <span>Content</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/intprogrampage/*') ? 'active' : '' }}">
                        <a href="{{ url('/admin/intprogrampage/listing') }}">
                            <i class="fa fa-file"></i> <span>Program Page</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview {{ request()->is('admin/pdf*') || request()->is('admin/pdf*') || request()->is('admin/pdf*') ? 'active menu-open' : '' }}">
                <a href="#">
                    <i class="fa fa-home"></i> <span>Academy Resource</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="{{ (request()->is('admin/pdf*') || request()->is('admin/pdf*')) ? 'display:block;' : 'display:none;' }}">
                    <li class="{{ request()->is('admin/pdf*') ? 'active' : '' }}">
                        <a href="{{ url('/admin/pdf/listing') }}">
                            <i class="fa fa-file-pdf-o"></i> <span>Program Flyer</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/intakecalender/create/*') ? 'active' : '' }}">
                        <a href="{{ url('/admin/intakecalender/create/6855370d70414') }}">
                            <i class="fa fa-calendar"></i> <span>Intake Calendar</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ request()->is('admin/faqs/listing*') ? 'active' : '' }}">
                <a href="{{ url('/admin/faqs/listing') }}">
                    <i class="fa fa-file"></i> <span>Faqs</span>
                </a>
            </li>
        </ul>
    </section>
</aside>