@extends('layouts.app')
@section('css')
@endsection

@section('content')
    <div class="container" style="text-align: justify">
        <div class="ui breadcrumb">
            <div class="section">Apotek</div>
            <div class="divider"> / </div>
            <div class="active section">Resep</div>
        </div><br/>
        <hr/>
        <div class="action" style="margin-bottom: 10px">
            <a href="/apotek/resep/tambah" class="btn btn-primary"><i class="fa fa-plus"></i> Resep</a>
        </div>
        <table id="table-recipe" class="ui celled table dataTable responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <td>No</td>
                <td>Nama Pembeli</td>
                <td>Nomor Resep</td>
                <td>Poli / Pembelian Luar</td>
                <td>Tanggal Transaksi</td>
                <td>Action</td>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('scripts')
@endsection