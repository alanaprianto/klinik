@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><i class="fa fa-angle-right"></i> Detail Pembelian </h5>
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
                    <table class="table">
                        <tbody>
                        <tr>
                            <th style="width: 20%">Nama Pembeli</th>
                            <td style="width: 5%">:</td>
                            <td>{{$recipe->reference->register->patient->full_name}}</td>
                        </tr>
                        <tr>
                            <th>Nomor Resep</th>
                            <td>:</td>
                            <td>{{$recipe->number_recipe}}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Transaksi</th>
                            <td>:</td>
                            <td>{{$recipe->created_at}}</td>
                        </tr>
                        <tr>
                            <th>Apoteker</th>
                            <td>:</td>
                            <td>{{$recipe->staff->full_name}}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Pembayaran</th>
                            <td>:</td>
                            <td>Rp. {{$total_payment}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <hr/>
                    <h4>Detail Pembelian transaksi</h4>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Obat</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah Pembelian</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($recipe->pharmacySellers as $index => $pharmacySeller)
                                <td>{{$index + 1}}</td>
                                <td>{{$pharmacySeller->inventory->name}}</td>
                                <td>{{$pharmacySeller->amount}}</td>
                                <td>{{$pharmacySeller->inventory->price}}</td>
                                <td>Rp. {{$pharmacySeller->total_payment}}</td>
                            @endforeach
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="4">Total</th>
                            <th>Rp. {{$total_payment}}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection