<!DOCTYPE html>
<html>


<!-- Site: HackForums.Ru | E-mail: abuse@hackforums.ru | Skype: h2osancho -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIM Klinik </title>

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{asset('css/toastr.min.css')}}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{asset('css/jquery.gritter.css')}}" rel="stylesheet">

    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/datatables.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/dataTables.bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/buttons.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/datepicker3.css')}}" rel="stylesheet">
    <link href="{{asset('css/jquery.timepicker.min.css')}}" rel="stylesheet">
    @yield('css')
</head>

<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="{{asset('img/profile_small.jpg')}}"/>
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong
                                            class="font-bold">{{ Auth::user()->name }}</strong>
                             </span> <span class="text-muted text-xs block">{{ Auth::user()->name }} <b class="caret"></b></span> </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="{{url('') }}">Profile</a></li>
                            <li><a href="{{url('') }}">Contacts</a></li>
                            <li><a href="{{url('') }}">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a href="{{url('login') }}">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        SIM+
                    </div>
                </li>
                <li>
                    <a href="{{url('/loket/antrian')}}"><i class="fa fa-th-large"></i> <span
                                class="nav-label"> Antrian</span></a>
                </li>
                <li>
                    <a href="{{url('/loket/pendaftaran')}}"><i class="fa fa-th-large"></i> <span
                                class="nav-label"> Pendaftaran</span></a>
                </li>
                <li>
                    <a href="{{url('/admin/poli')}}"><i class="fa fa-medkit"></i> <span
                                class="nav-label"> Poli</span></a>
                </li>
                <li>
                    <a href="{{url('/admin/staff')}}"><i class="fa fa-user-md"></i> <span
                                class="nav-label"> Staff</span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('/admin/staffjob')}}"><i class="fa fa-user-md"></i> <span
                                        class="nav-label"> Staff Job</span></a>
                        </li>
                        <li>
                            <a href="{{url('/admin/staffposition')}}"><i class="fa fa-user-md"></i> <span
                                        class="nav-label"> Staff Position </span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{url('/admin/user')}}"><i class="fa fa-user"></i> <span
                                class="nav-label"> User</span></a>
                </li>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i>
                    </a>
                    <form role="search" class="navbar-form-custom"
                          action="http://webapplayers.com/inspinia_admin-v2.1/search_results.html">
                        <div class="form-group">
                            <input type="text" placeholder="Search for something..." class="form-control"
                                   name="top-search" id="top-search">
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Welcome to Sistem Informasi Manajemen Klinik.</span>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-envelope"></i> <span class="label label-warning">16</span>
                        </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="profile.html" class="pull-left">
                                        <img alt="image" class="img-circle" src="{{asset('img/a7.jpg')}}">
                                    </a>
                                    <div class="media-body">
                                        <small class="pull-right">46h ago</small>
                                        <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>.
                                        <br>
                                        <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="profile.html" class="pull-left">
                                        <img alt="image" class="img-circle" src="{{asset('img/a4.jpg')}}">
                                    </a>
                                    <div class="media-body ">
                                        <small class="pull-right text-navy">5h ago</small>
                                        <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica
                                            Smith</strong>. <br>
                                        <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="profile.html" class="pull-left">
                                        <img alt="image" class="img-circle" src="{{asset('img/profile.jpg')}}">
                                    </a>
                                    <div class="media-body ">
                                        <small class="pull-right">23h ago</small>
                                        <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                        <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="text-center link-block">
                                    <a href="mailbox.html">
                                        <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell"></i> <span class="label label-primary">8</span>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="mailbox.html">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="profile.html">
                                    <div>
                                        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                        <span class="pull-right text-muted small">12 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="grid_options.html">
                                    <div>
                                        <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="text-center link-block">
                                    <a href="notifications.html">
                                        <strong>See All Alerts</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>


                    <li>
                        <a href="javascript:;" id="btn-logout">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>

            </nav>

        </div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Data Tables</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index-2.html">Home</a>
                    </li>
                    <li>
                        <a>Tables</a>
                    </li>
                    <li class="active">
                        <strong>Data Tables</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            @yield('content')
        </div>
        <div class="footer">
            <div class="pull-right">
                Sistem Informasi Manajemen <strong>Klinik </strong>
            </div>
            <div>
                <strong>Copyright</strong> Teknoland &copy; 2017
            </div>
        </div>
    </div>
</div>



<!-- Mainly scripts -->
<script src="{{asset('js/jquery-2.2.4.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery.metisMenu.js')}}"></script>



<!-- Custom and plugin javascript -->
<script src="{{asset('js/inspinia.js')}}"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {
        $('#btn-logout').on('click', function () {
            var $form = $('<form />');
            $form.attr('action', '/logout');
            $form.attr('method', 'post');
            $form.css({
                'display': 'none'
            });

            var csrf = $('<input />');
            csrf.attr('type', 'hidden');
            csrf.attr('name', '_token');
            csrf.val($('meta[name="csrf-token"]').attr('content'));
            $form.append(csrf);

            $('body').append($form);
            $form.submit();
        });
    });
</script>


<script>
    $(document).ready(function () {
        var data1 = [
            [0, 4], [1, 8], [2, 5], [3, 10], [4, 4], [5, 16], [6, 5], [7, 11], [8, 6], [9, 11], [10, 30], [11, 10], [12, 13], [13, 4], [14, 3], [15, 3], [16, 6]
        ];
        var data2 = [
            [0, 1], [1, 0], [2, 2], [3, 0], [4, 1], [5, 3], [6, 1], [7, 5], [8, 2], [9, 3], [10, 2], [11, 1], [12, 0], [13, 2], [14, 8], [15, 0], [16, 0]
        ];
        $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                data1, data2
            ],
            {
                series: {
                    lines: {
                        show: false,
                        fill: true
                    },
                    splines: {
                        show: true,
                        tension: 0.4,
                        lineWidth: 1,
                        fill: 0.4
                    },
                    points: {
                        radius: 0,
                        show: true
                    },
                    shadowSize: 2
                },
                grid: {
                    hoverable: true,
                    clickable: true,
                    tickColor: "#d5d5d5",
                    borderWidth: 1,
                    color: '#d5d5d5'
                },
                colors: ["#1ab394", "#464f88"],
                xaxis: {},
                yaxis: {
                    ticks: 4
                },
                tooltip: false
            }
        );

        var doughnutData = [
            {
                value: 300,
                color: "#a3e1d4",
                highlight: "#1ab394",
                label: "App"
            },
            {
                value: 50,
                color: "#dedede",
                highlight: "#1ab394",
                label: "Software"
            },
            {
                value: 100,
                color: "#b5b8cf",
                highlight: "#1ab394",
                label: "Laptop"
            }
        ];

        var doughnutOptions = {
            segmentShowStroke: true,
            segmentStrokeColor: "#fff",
            segmentStrokeWidth: 2,
            percentageInnerCutout: 45, // This is 0 for Pie charts
            animationSteps: 100,
            animationEasing: "easeOutBounce",
            animateRotate: true,
            animateScale: false,
        };

    });
</script>
<script type="text/javascript" src="{{'/js/datatables.min.js'}}"></script>
<script type="text/javascript" src="{{'/js/jquery.dataTables.js'}}"></script>
<script type="text/javascript" src="{{'/js/dataTables.buttons.min.js'}}"></script>
<script type="text/javascript" src="{{'/js/moment-with-locales.min.js'}}"></script>
<script type="text/javascript" src="{{'/js/buttons.print.min.js'}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.timepicker.min.js')}}"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="{{asset('js/socket.io.js')}}"></script>
<script type="text/javascript" src="{{'/js/table.js'}}"></script>
@yield('scripts')
</body>
</html>
