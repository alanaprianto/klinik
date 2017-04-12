<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Inside</title>
    <link rel="icon" href="{{asset('assets/images/logo/logo-sm.png')}}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/application.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/jquery.timepicker.min.css')}}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('css')
</head>
<body>
<div class="loader no-print" id="loader">
    <div class="ui active dimmer">
        <div class="ui loader"></div>
    </div>
</div>

<div class="module-left-aside no-print">
    <div class="module-left-title">
        <div class="module-left-bars"><i class="ti-menu"></i></div>
        <img src="{{asset('/assets/images/logo/farmasi-101.png')}}">
        <span>{{Auth::user()->roles()->first()->display_name}}</span>
    </div>
    <div class="module-left-container">
        <div class="module-left-nav clearfix">
            <div class="module-left-sidebar sidebar">
                <nav class="sidebar-nav">
                    <ul class="metismenu" id="module-left-menu">
                        <li class="sidebar-nav-heading">Navigasi</li>
                        <li class="active">
                            <a href="{{url('/loket')}}">
                                <span class="sidebar-nav-item-icon fa fa-home fa-fw"></span>
                                <span class="sidebar-nav-item">Beranda</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/loket/antrian')}}">
                                <span class="sidebar-nav-item-icon fa fa-users fa-fw"></span>
                                <span class="sidebar-nav-item">Antrian</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/loket/pendaftaran')}}">
                                <span class="sidebar-nav-item-icon fa fa-pencil-square-o fa-fw"></span>
                                <span class="sidebar-nav-item">Pendaftaran</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/loket/pengunjung')}}">
                                <span class="sidebar-nav-item-icon fa fa-male fa-fw"></span>
                                <span class="sidebar-nav-item">Pengunjung</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/loket/profil')}}">
                                <span class="sidebar-nav-item-icon fa fa-picture-o fa-fw"></span>
                                <span class="sidebar-nav-item">Profile</span>
                            </a>
                        </li>

                        <li class="sidebar-nav-heading">Lain-lain</li>
                        <li>
                            <a href="javascript:;" id="btn-logout">
                                <span class="sidebar-nav-item-icon fa fa-sign-out fa-fw"></span>
                                <span class="sidebar-nav-item">Keluar</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="module-content-container">
    @yield('content')
</div>

<!-- Main Javascript -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Plugins -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/plugins/semantic/semantic.min.js')}}"></script>
<script src="{{asset('assets/plugins/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/js/dataTables.semanticui.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/js/responsive.semanticui.min.js')}}"></script>

<script src="{{asset('assets/js/application.js')}}"></script>
<script src="{{asset('assets/js/moment-with-locales.min.js')}}"></script>
<script src="{{asset('assets/js/table.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/js/jquery.timepicker.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#btn-logout').on('click', function (e) {
            e.preventDefault();
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
@yield('scripts')
</body>
</html>