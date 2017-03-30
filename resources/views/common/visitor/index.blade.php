@extends('layouts.app')
@section('content')
    <div class="container" style="text-align: justify">
        <div class="ui breadcrumb">
            <div class="section">{{ucfirst($role)}}</div>
            <div class="divider"> / </div>
            <div class="active section">Pengunjung</div>
        </div><br/>

        <table id="table-visitor" data-role="{{$role}}" class="ui celled table dataTable responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>No</th>
                <th>No Medical Record</th>
                <th>Nama Pasien</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
    </div>
{{--
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Pengunjung</h5>
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
                    <table class="table" id="table-visitor" data-role="{{$role}}">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>No Medical Record</th>
                            <th>Nama Pasien</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
--}}
@endsection

@section('scripts')
@endsection