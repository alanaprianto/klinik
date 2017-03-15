@extends('layouts.app')
@section('css')
    <style type="text/css">
        .hiddenRow {
            padding: 0 !important;
            background-color: #ececec;
        }
    </style>
@endsection
@section('breadcrumb')
    <li>
        <a href="{{url('/loket/pengunjung')}}">Pengunjung</a>
    </li>
    <li class="active">
        <strong>Tambah</strong>
    </li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Detail Pasien & Rujukan Pasien</h5>
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
                                <dd>{{$patient->number_medical_record}}</dd>
                                <dt>Nama Pasien</dt>
                                <dd>{{$patient->full_name}}</dd>
                                <dt>TTL</dt>
                                <dd>{{$patient->place}} / {{$patient->birth}}</dd>
                                <dt>Umur</dt>
                                <dd>{{$patient->age}}</dd>
                                <dt>Jenis Kelamin</dt>
                                <dd>{{$patient->gender == 'male' ? 'Laki-laki' : 'Perempuan'}}</dd>
                                <dt>No Telp</dt>
                                <dd>{{$patient->phone_number}}</dd>
                                <dt>No Askes / Jamkesmas</dt>
                                <dd>{{$patient->askes_number}}</dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl class="dl-horizontal">
                                <dt>Jumlah Pendaftaran Pasien</dt>
                                <dd>{{count($patient->registers)}} Kali Mendaftar</dd>
                                <dt>Jumlah Kunjungan Pasien</dt>
                                <dd>{{$counts}} Kunjungan</dd>
                            </dl>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr/>
                            <h3>Data Pendaftaran</h3>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>No Pendaftaran</th>
                                    <th>Waktu</th>
                                    <th>Tipe Layanan</th>
                                    <th>Poli Rujukan</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($patient->registers as $index => $register)
                                    <tr>
                                        <td>{{$index + 1}}</td>
                                        <td>{{$register->register_number}}</td>
                                        <td>{{$register->created_at}}</td>
                                        <td>{{$register->service_type}}</td>
                                        <td>
                                            <button  data-toggle="collapse" data-target=".demo{{$index}}" class="accordion-toggle"><i class="fa fa-eye"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="hiddenRow">
                                            <div class="accordian-body collapse demo{{$index}}"> Poly Tujuan</div>
                                        </th>
                                        <th class="hiddenRow">
                                            <div class="accordian-body collapse demo{{$index}}"> Diperiksa Oleh</div>
                                        </th>
                                        <th class="hiddenRow">
                                            <div class="accordian-body collapse demo{{$index}}"> Waktu</div>
                                        </th>
                                        <th colspan="2" class="hiddenRow">
                                            <div class="accordian-body collapse demo{{$index}}"> Status</div>
                                        </th>
                                    </tr>
                                    @forelse($register->references as $reference)
                                        <tr>
                                            <td class="hiddenRow">
                                                <div class="accordian-body collapse demo{{$index}}"> {{$reference->poly->name}}</div>
                                            </td>
                                            <td class="hiddenRow">
                                                <div class="accordian-body collapse demo{{$index}}">{{$reference->doctor->full_name}}</div>
                                            </td>
                                            <td class="hiddenRow">
                                                <div class="accordian-body collapse demo{{$index}}">{{$reference->created_at}}</div>
                                            </td>
                                            <td colspan="2" class="hiddenRow">
                                                <div class="accordian-body collapse demo{{$index}}"> {{$reference->final_result}}</div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="hiddenRow" colspan="5">
                                                <div class="accordian-body collapse demo{{$index}}"> -</div>
                                            </td>
                                        </tr>
                                    @endforelse

                                @empty
                                    <tr>
                                        <td colspan="5">Belum Ada Registrasi</td>
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