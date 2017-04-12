@extends('layouts.app')
@section('css')
@endsection

@section('content')
    <div class="container" style="text-align: justify">
        <div class="ui breadcrumb">
            <div class="section">Kasir</div>
            <div class="divider"> / </div>
            <div class="active section">Pembayaran</div>
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
@endsection

@section('scripts')
@endsection