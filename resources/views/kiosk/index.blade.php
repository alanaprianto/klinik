@extends('layouts.app')
@section('css')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Kiosk</div>
                    <div class="panel-body">
                        <button class="btn btn-primary btn-print" data-type="bpjs">BPJS</button>
                        <button class="btn btn-primary btn-print" data-type="non-bpjs">NON BPJS</button>
                        <button class="btn btn-primary btn-print" data-type="mcu">MCU</button>
                        <button class="btn btn-primary btn-print" data-type="poli-umum">Poli Umum</button>
                        <button class="btn btn-primary btn-print" data-type="cito">CITO</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.btn-print').on('click', function () {
                $this = $(this);
                var type = $this.data('type');
                $.ajax({
                    url: '/kiosk/add',
                    type: 'POST',
                    data: {type : type},
                    success: function (data) {
                        console.log(data);
                    }
                })
            });
        });
    </script>
@endsection