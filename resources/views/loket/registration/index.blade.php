@extends('layouts.app')
@section('css')
@endsection
@section('content')
    <div class="container" style="text-align: justify">
        <div class="ui breadcrumb">
            <div class="section">Loket</div>
            <div class="divider"> / </div>
            <div class="active section">Pendaftaran</div>
        </div><br/>
        <hr />
        <div class="action" style="margin-bottom: 10px">
            <a href="{{url('/loket/pendaftaran/tambah')}}" class="btn btn-primary">Tambah</a>
        </div>

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
@endsection

@section('scripts')
@endsection