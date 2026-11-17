@include('Admin::common-file.header')
@include('Admin::common-file.sidebar')

<!-- Main page work here -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="info-box-text">
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{url('/admin/blog/bloglisting')}}">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fa fa-newspaper-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Blogs</span>
                        <span class="info-box-number">{{$blogsCount}}</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{url('/admin/testimonial/listing')}}">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fa fa-quote-left"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Testimonial</span>
                        <span class="info-box-number">{{$testimonial}}</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{url('/admin/contactus')}}">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fa fa-calendar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Appointment</span>
                        <span class="info-box-number">{{$contactus}}</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{url('/admin/placementpartners/listing')}}">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Placement Partners</span>
                        <span class="info-box-number">{{$placementpartners}}</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{url('/admin/supportingbrands/listing')}}">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fa fa-building-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Supporting Brands</span>
                        <span class="info-box-number">{{$supportingbrands}}</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{url('/admin/chefeducators/listing')}}">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fa fa-graduation-cap"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Chef Educators</span>
                        <span class="info-box-number">{{$chefeducators}}</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{url('/admin/alumni/listing')}}">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fa fa-graduation-cap"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Alumni</span>
                        <span class="info-box-number">{{$alumni}}</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{url('/admin/intprogram/listing')}}">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fa fa-globe"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Int Program</span>
                        <span class="info-box-number">{{$intprogram}}</span>
                    </div>
                </div>
            </a>
        </div>
         
         <div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Top 10 Pages by Views</h3>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Page Name</th>
                        <th>Visit Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topPages as $index => $page)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                          <a href="{{ url($page->url) }}" target="_blank">
                            {{ $page->friendly_name }}
                          </a>
                        </td>
                        <td>{{ $page->count }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($topPages->isEmpty())
                <p>No page views found.</p>
            @endif
        </div>
    </div>
</div>



        <!-- Bar Chart Section -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Overview of Metrics</h3>
                </div>
                <div class="box-body">
                    <canvas id="metricsChart" style="height: 250px;"></canvas>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Main page work here End-->
@include('Admin::common-file.footer')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
        var ctx = document.getElementById('metricsChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Blogs', 'Testimonials', 'Appointments', 'Placement Partners', 'Supporting Brands', 'Chef Educators', 'Alumni', 'Int Programs'],
                datasets: [{
                    label: 'Counts',
                    data: [{{ $blogsCount ?? 0 }}, {{ $testimonial ?? 0 }}, {{ $contactus ?? 0 }}, {{ $placementpartners ?? 0 }}, {{ $supportingbrands ?? 0 }}, {{ $chefeducators ?? 0 }}, {{ $alumni ?? 0 }}, {{ $intprogram ?? 0 }}],
                    backgroundColor: [
                        '#00a65a', // Green
                        '#f39c12', // Orange
                        '#00c0ef', // Blue
                        '#3c8dbc', // Primary
                        '#d81b60', // Pink
                        '#605ca8', // Purple
                        '#ff851b', // Orange (variant)
                        '#00a65a'  // Green (variant)
                    ],
                    borderColor: [
                        '#008d4c',
                        '#e08e0b',
                        '#00a7d0',
                        '#2b6ca3',
                        '#c2185b',
                        '#524c88',
                        '#e67600',
                        '#008d4c'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Count'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Categories'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false // Hide legend since we have only one dataset
                    }
                }
            }
        });
    </script>