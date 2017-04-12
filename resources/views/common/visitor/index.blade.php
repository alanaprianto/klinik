@extends('layouts.app')
@section('content')
    <div class="container" style="text-align: justify">
        <div class="ui breadcrumb">
            <div class="section">{{ucfirst($role)}}</div>
            <div class="divider"> / </div>
            <div class="active section">Pengunjung</div>
        </div><br/>
        <hr/>

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
@endsection

@section('scripts')
@endsection