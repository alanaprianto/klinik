@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Detail Kunjungan Pasien</h5>
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
                    <div class="row">
                        <div class="col-md-6">
                            <dl class="dl-horizontal">
                                <dt>No RM</dt>
                                <dd>{{$reference->register->patient->number_medical_record}}</dd>
                                <dt>Nama Pasien</dt>
                                <dd>{{$reference->register->patient->full_name}}</dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl class="dl-horizontal">
                                <dt>Status Kunjungan</dt>
                                <dd>
                                    @if($reference->status == 1)
                                        <span class="alert-danger">Belum Diperiksa</span>
                                    @elseif($reference->status == 2)
                                        <span class="alert-warning">Dirujuk</span>
                                    @elseif($reference->status == 3)
                                        <span class="alert-info">Dirawat</span>
                                    @elseif($reference->status == 4)
                                        <span class="alert-success">Selesai Pemeriksaan</span>
                                    @endif
                                </dd>
                                <dt>Catatan</dt>
                                <dd>{{$reference->notes}}</dd>
                                <dt>Dokter Pemeriksa</dt>
                                <dd>{{$reference->doctor->full_name}}</dd>
                                <dt>Poli Tujuan</dt>
                                <dd>{{$reference->poly->name}}</dd>
                            </dl>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Rekap Tindakan</h3>
                            <hr/>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Nama Tindakan</th>
                                    <th>Jumlah</th>
                                    <th>Total Pembayaran</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($reference->medicalRecords as $index => $medicalRecord)
                                    <tr>
                                        <td>{{$index + 1}}</td>
                                        <td>{{$medicalRecord->service->name}}</td>
                                        <td>{{$medicalRecord->quantity}}</td>
                                        <td>{{$medicalRecord->quantity * $medicalRecord->cost}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Tidak Ada Tindakan</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
    </script>
@endsection