@extends('layouts.app')

@section('css')

@endsection
@section('breadcrumb')
    <li class="active">
        <strong>Antrian</strong>
    </li>
@endsection
@section('content')
    {{--BPJS--}}
    <div class="container" style="text-align: justify">
        <div class="ui breadcrumb">
            <div class="section">Loket</div>
            <div class="divider"> / </div>
            <div class="active section">Antrian</div>
        </div><br/>

        <div class="row">
            <div class="col-md-4">
                <h5>Antrian BPJS</h5>
                <table class="ui celled table dataTable responsive" id="table-queue-bpjs" data-user="{{Auth::user()->id}}">
                    <thead>
                    <tr>
                        <th>Antrian</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="col-md-4">
                <h5>Antrian Umum</h5>
                <table class="ui celled table dataTable responsive" id="table-queue-umum" data-user="{{Auth::user()->id}}">
                    <thead>
                    <tr>
                        <th>Antrian</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="col-md-4">
                <h5>Antrian Kontraktor</h5>
                <table class="ui celled table dataTable responsive" id="table-queue-contractor" data-user="{{Auth::user()->id}}">
                    <thead>
                    <tr>
                        <th>Antrian</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

{{--    <div class="row">
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Antrian BPJS</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table" id="table-queue-bpjs" data-user="{{Auth::user()->id}}">
                        <thead>
                        <tr>
                            <th>Antrian</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Antrian Umum</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table" id="table-queue-umum" data-user="{{Auth::user()->id}}">
                        <thead>
                        <tr>
                            <th>Antrian</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Antrian Kontraktor</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table" id="table-queue-contractor" data-user="{{Auth::user()->id}}">
                        <thead>
                        <tr>
                            <th>Antrian</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>--}}
@endsection

@section('scripts')
    <script type="text/javascript">
        var getUrl = window.location;
        var baseUrl = getUrl.protocol + "//" + getUrl.host + "/sounds/temp/";
        function fileAndPlay(sound) {
            var antrian = new Audio(baseUrl + sound);
            antrian.playbackRate = 1.2;
            antrian.play();
        }

        $(document).ready(function () {
            $(document).on('click', '.btn-play', function (e) {
                e.preventDefault();
                $this = $(this);
                /*play sound*/
                var sound = $this.data('sound');
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var id = $this.data('id');
                fileAndPlay(sound);

                /*ajax update status*/
                $.ajax({
                    url:'/loket/antrian/update-status',
                    data:{_token: csrf, id : id},
                    type: 'POST',
                    success: function (data) {
                    }
                })
            });
        })
    </script>
@endsection