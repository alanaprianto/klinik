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

        <table id="table-registration" class="ui celled table dataTable responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <td>No</td>
                <td>Nomor Pendaftaran</td>
                <td>No RM</td>
                <td>Nama Pasien</td>
                <td>Umur</td>
                <td>Status Pendaftaran</td>
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
                    <a href="{{url('/loket/pendaftaran/tambah')}}" class="btn btn-primary">Tambah</a>

                    <table class="table" id="table-registration">
                        <thead>
                        <tr>
                            <td>No</td>
                            <td>Nomor Pendaftaran</td>
                            <td>No RM</td>
                            <td>Nama Pasien</td>
                            <td>Umur</td>
                            <td>Status Pendaftaran</td>
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