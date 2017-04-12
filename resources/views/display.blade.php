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
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-7 col-lg-offset-5">
            <h2><b>Daftar Antrian</b></h2>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">BPJS</span>
                        <h5>Antrian BPJS</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><span class="count-bpjs">#{{$bpjs ? sprintf('%03d', $bpjs->queue_number) : '000'}}</span></h1>
                        <div class="stat-percent font-bold text-navy"><span
                                    class="total-bpjs">{{count($kiosks->where('type', 'bpjs'))}}</span> <i
                                    class="fa fa-list"></i></div>
                        <small>Total Antrian</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">Umum</span>
                        <h5>Antrian Umum</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><span class="count-umum">#{{$umum ? sprintf('%03d', $umum->queue_number) : '000'}}</span></h1>
                        <div class="stat-percent font-bold text-success"><span
                                    class="total-umum">{{count($kiosks->where('type', 'umum'))}}</span> <i
                                    class="fa fa-list"></i></div>
                        <small>Total Antrian</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-danger pull-right">Contractor</span>
                        <h5>Antrian Contractor</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><span class="count-contractor">#{{$contractor ? sprintf('%03d', $contractor->queue_number) : '000'}}</span></h1>
                        <div class="stat-percent font-bold text-danger"><span
                                    class="total-contractor">{{count($kiosks->where('type', 'contractor'))}}</span> <i
                                    class="fa fa-list"></i></div>
                        <small>Total Antrian</small>
                    </div>
                </div>
            </div>
        </div>
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


<!-- Mainly scripts -->
<script src="{{asset('js/jquery-2.2.4.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery.metisMenu.js')}}"></script>
<script src="{{asset('js/jquery.slimscroll.min.js')}}"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('js/inspinia.js')}}"></script>
<script src="{{asset('js/pace.min.js')}}"></script>

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

<script type="text/javascript" src="{{'/js/datatables.min.js'}}"></script>
<script type="text/javascript" src="{{'/js/jquery.dataTables.js'}}"></script>
<script type="text/javascript" src="{{'/js/dataTables.buttons.min.js'}}"></script>
<script type="text/javascript" src="{{'/js/moment-with-locales.min.js'}}"></script>
<script type="text/javascript" src="{{'/js/buttons.print.min.js'}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.timepicker.min.js')}}"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="{{asset('js/socket.io.js')}}"></script>
<script type="text/javascript">
    function blink(element) {
        for (i = 1; i <= 5; i++) {
            element.fadeOut(300).fadeIn(300);
        }
    }
    $(document).ready(function () {
        var socket = io.connect('http://localhost:8890');
        socket.on('update-front', function (data) {
            var result = JSON.parse(data);
            var html_total;
            switch (result[2]) {
                case 'total':
                    html_total = $('.total-' + result[1]);
                    html_total.html(result[0]);
                    break;
                default:
                    html_total = $('.count-' + result[1]);
                    html_total.html('#'+result[0]);
                    break;
            }
            blink(html_total);

        });
    });

</script>
</body>
</html>
