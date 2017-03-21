@extends('layouts.app')
@section('css')
@endsection
@section('breadcrumb')
    <li class="active">
        <strong>Jasa Dokter</strong>
    </li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><i class="fa fa-angle-right"></i> Jasa Dokter </h5>
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
                    <div class="form-panel">
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection