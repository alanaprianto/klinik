<!DOCTYPE html>
<html>


<!-- Site: HackForums.Ru | E-mail: abuse@hackforums.ru | Skype: h2osancho -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIM Klinik | Login </title>

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

</head>
<body class="white-bg"  style="background-image: url('css/patterns/shattered.png')">
<div class=" text-center">
                    <h1 style="margin-top: 100px">KIOSK </h1>
                    <h3>Terima kasih telah menggunakan fasilitas kiosk untuk melakukan pendaftaran pelayanan laboratorium.</h3>
                    <div class="panel-body">
                        <a class="btn btn-print" type="button" data-type="bpjs" href="javascript:;"><img src="img/icon-bpjs.png" style="height: 200px"></a>
                        <a class="btn btn-print" type="button" href="javascript:;" data-type="poli-umum"><img src="img/icon-umum.png" style="height: 200px"></a>
                        <a class="btn  btn-print" type="button" href="javascript:;" data-type="contractor"><img src="img/icon-contractor.png" style="height: 200px"></a>
                    </div>
    <h1></h1>
                    <h3>Struk antrian akan dicetak secara otomatis</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Small modal -->
    <div id="myModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog"
         aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.btn-print').on('click', function () {
                $this = $(this);
                var type = $this.data('type');
                $.ajax({
                    url: '/kiosk/add',
                    type: 'POST',
                    data: {type: type},
                    success: function (data) {
                        $('.modal-content').html();
                        var h3 = '<h3> Nomor Antrian Anda Adalah ' + data.message.queue_number + '</h3>';
                        $('.modal-content').html(h3);
                        $('#myModal').modal('show');
                        setTimeout(function(){
                            $('#myModal').modal('hide');
                        }, 1000);
                    }
                })
            });
        });
    </script>
    <script src="{{asset('js/jquery-2.1.1.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

</body>


<!-- Site: HackForums.Ru | E-mail: abuse@hackforums.ru | Skype: h2osancho -->
</html>
