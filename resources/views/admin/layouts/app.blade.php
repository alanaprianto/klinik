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
    @yield('css')
</head>

<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="img/a8.jpg"/>
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong
                                            class="font-bold">{{ Auth::user()->name }}</strong>
                             </span> <span class="text-muted text-xs block">Administrator <b class="caret"></b></span> </span>
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
                    <a href="{{url('')}}"><i class="fa fa-th-large"></i> <span class="nav-label"> Dashboards</span></a>
                </li>
                <li>
                    <a href="{{url('')}}"><i class="fa fa-diamond"></i> <span class="nav-label">Penata Jasa</span> </a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Rawat Jalan </span><span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{url('')}}">Poli Klinik </a></li>
                        <li><a href="{{url('')}}">Poli Umum </a></li>
                        <li><a href="{{url('')}}">Poli Gigi</a></li>
                        <li><a href="{{url('')}}">Poli Spesialis</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Rawat Inap </span><span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{url('admin/poli/umum')}}">Poli Klinik </a></li>
                        <li><a href="{{url('')}}">Poli Umum </a></li>
                        <li><a href="{{url('')}}">Poli Gigi</a></li>
                        <li><a href="{{url('')}}">Poli Spesialis</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{url('')}}"><i class="fa fa-flask"></i> <span class="nav-label">Laboratorium</span> <span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{url('')}}">Radiologi </a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{url('')}}"><i class="fa fa-windows"></i> <span class="nav-label">Kasir</span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{url('')}}">Invoice</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{url('')}}"><i class="fa fa-edit"></i> <span class="nav-label">Apotek</span></a>
                </li>
                <li>
                    <a href="{{url('')}}"><i class="fa fa-book" aria-hidden="true"></i> <span
                                class="nav-label">Antrian</span></a>
                </li>
                <li>
                    <a href="{{url('')}}"><i class="fa fa-desktop"></i> <span class="nav-label">Inventory</span> <span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{url('')}}">obat</a></li>
                        <li><a href="{{url('')}}">Suntikan</a></li>
                        <li><a href="{{url('')}}">nota</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Master</span><span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{url('/admin/user')}}">Master Pegawai</a></li>
                        <li><a href="{{url('')}}">Master poli</a></li>
                        <li><a href="{{url('')}}">Invoice</a></li>
                    </ul>
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
                                        <img alt="image" class="img-circle" src="img/a7.jpg">
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
                                        <img alt="image" class="img-circle" src="img/a4.jpg">
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
                                    <a href="" class="pull-left">
                                        <img alt="image" class="img-circle" src="img/profile.jpg">
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
        <div class="row  border-bottom white-bg dashboard-header">
            <div class="col-lg-10">
                <h2>Dasboard</h2>
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

</div>
</div>

<!-- Mainly scripts -->
<script src="{{asset('js/jquery-2.1.1.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- Custom and plugin javascript -->
{{--
<script src="{{asset('js/inspinia.js')}}"></script>
--}}
{{--logout js--}}
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
            $('body').append($form);
            $form.submit();
        });
    });
</script>
<script src="{{asset('js/jquery.metisMenu.js')}}"></script>
<script type="text/javascript" src="{{'/js/datatables.min.js'}}"></script>
<script type="text/javascript" src="{{'/js/jquery.dataTables.js'}}"></script>
<script type="text/javascript" src="{{'/js/dataTables.buttons.min.js'}}"></script>
<script type="text/javascript" src="{{'/js/moment-with-locales.min.js'}}"></script>
<script type="text/javascript" src="{{'/js/buttons.print.min.js'}}"></script>
<script src="{{asset('js/peity-demo.js')}}"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('js/inspinia.js')}}"></script>

<script type="text/javascript" src="{{asset('js/table.js')}}"></script>

@yield('scripts')
</body>
</html>
