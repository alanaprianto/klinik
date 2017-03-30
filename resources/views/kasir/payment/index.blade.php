@extends('layouts.app')
@section('css')
@endsection

@section('content')
    <div class="container" style="text-align: justify">
        <div class="ui breadcrumb">
            <div class="section">Admin</div>
            <div class="divider"> / </div>
            <div class="active section">Staff</div>
            <div class="divider"> / </div>
            <div class="active section">Staff Position</div>
        </div><br/>

        <table id="table-payment" class="ui celled table dataTable responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <td>No</td>
                <td>No RM</td>
                <td>Nama Pasien</td>
                <td>Tanggal Pendaftaran</td>
                <td>Status</td>
                <td>Action</td>
            </tr>
            </thead>
        </table>
    </div>
{{--
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Data Pendaftar</h5>
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
                    <table class="table" id="table-payment">
                        <thead>
                        <tr>
                            <td>No</td>
                            <td>No RM</td>
                            <td>Nama Pasien</td>
                            <td>Tanggal Pendaftaran</td>
                            <td>Status</td>
                            <td>Action</td>
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