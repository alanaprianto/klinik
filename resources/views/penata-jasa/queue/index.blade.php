@extends('layouts.app')
@section('content')
    <div class="container" style="text-align: justify">
        <div class="ui breadcrumb">
            <div class="section">Penata Jasa</div>
            <div class="divider"> / </div>
            <div class="active section">Antrian</div>
        </div><br/>
        <hr/>

        <table id="table-queue-polies" data-user="{{Auth::user()->id}}" class="ui celled table dataTable responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <td style="width: 50px">Antrian</td>
                <td>Status</td>
                <td>Action</td>
            </tr>
            </thead>
        </table>
    </div>

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
            $(document).on('click', '.btn-play', function () {
                $this = $(this);
                var sound = $this.data('sound');
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var id = $this.data('id');
                fileAndPlay(sound)

                $.ajax({
                    url:'/penata-jasa/antrian/update-status',
                    data:{_token: csrf, id : id},
                    type: 'POST',
                    success: function (data) {
                    }
                })
            });
        })
    </script>
@endsection