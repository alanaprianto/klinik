@extends('layouts.app')
@section('css')
@endsection
@section('content')

    <div class="container" style="text-align: justify">
        <div class="ui breadcrumb">
            <div class="section">Admin</div>
            <div class="divider"> / </div>
            <div class="active section">Jasa Dokter</div>
        </div><br/>
        <hr/>

        <table class="table table-stripped" id="table-doctor-service">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama Doktor</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>

    </div>
@endsection

@section('scripts')
@endsection