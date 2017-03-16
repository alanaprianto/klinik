@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Antrian Poli</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a>
                            </li>
                            <li><a href="#">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table" id="table-queue-polies" data-user="{{Auth::user()->id}}">
                        <thead>
                        <tr>
                            <td style="width: 50px">Antrian</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
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
                fileAndPlay(sound)
            });
        })
    </script>
@endsection