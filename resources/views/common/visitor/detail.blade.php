@extends('layouts.app')
@section('css')
    <style type="text/css">
        .hiddenRow {
            padding: 0 !important;
            background-color: #ececec;
        }
    </style>
@endsection
@section('content')

    <div class="container" style="text-align: justify">
        <div class="ui breadcrumb">
            <div class="section">{{ucfirst($role)}}</div>
            <div class="divider"> / </div>
            <div class="active section">Pengunjung</div>
        </div><br/>
        <table class="table table-info">
            <tbody>
            <tr>
                <th>No RM</th>
                <td>:</td>
                <td class="text-navy">{{$patient->number_medical_record}}</td>
                <th>No Askes / Jamkesmas</th>
                <td>:</td>
                <td >{{$patient->askes_number}}</td>
            </tr>
            <tr>
                <th>Nama Pasien</th>
                <td>:</td>
                <td >{{$patient->full_name}}</td>
                <th>Umur</th>
                <td>:</td>
                <td >{{$patient->age}}</td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td>:</td>
                <td >{{$patient->gender == 'male' ? 'Laki-laki' : 'Perempuan'}}</td>
                <th>Agama</th>
                <td>:</td>
                <td>{{$patient->religion}}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>:</td>
                <td>{{$patient->address}}</td>
                <th>Nama Dusun /RT/RW</th>
                <td>:</td>
                <td>{{$patient->rt_rw}}</td>

            </tr>
            <tr>
                <th>Kelurahan</th>
                <td>:</td>
                <td>{{$patient->sub_district}}</td>
                <th>Kecamatan</th>
                <td>:</td>
                <td>{{$patient->district}}</td>

            </tr>
            <tr>
                <th>Provinsi / Kota</th>
                <td>:</td>
                <td>{{$patient->province}} / {{$patient->city}}</td>
                <th>No Telepon</th>
                <td>:</td>
                <td >{{$patient->phone_number}}</td>
            </tr>
            <tr>
                <th>Pendidikan</th>
                <td>:</td>
                <td>{{$patient->last_education}}</td>
                <th>Pekerjaan</th>
                <td>:</td>
                <td>{{$patient->job}}</td>
            </tr>
            <tr>
                <th>Jumlah Pendaftaran</th>
                <td>:</td>
                <td>{{count($patient->registers)}} Kali Mendaftar</td>
                <th>Jumlah Kunjungan</th>
                <td>:</td>
                <td>{{$counts}} Kunjungan</td>
            </tr>

            </tbody>
        </table>
        <hr />

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
                        <div class="accordian-body collapse demo{{$index}}"> Poli Tujuan</div>
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
{{--
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Detail Pasien & Rujukan Pasien</h5>
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
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-info">
                                <tbody>
                                <tr>
                                    <th>No RM</th>
                                    <td>:</td>
                                    <td class="text-navy">{{$patient->number_medical_record}}</td>
                                    <th>No Askes / Jamkesmas</th>
                                    <td>:</td>
                                    <td >{{$patient->askes_number}}</td>
                                </tr>
                                <tr>
                                    <th>Nama Pasien</th>
                                    <td>:</td>
                                    <td >{{$patient->full_name}}</td>
                                    <th>Umur</th>
                                    <td>:</td>
                                    <td >{{$patient->age}}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>:</td>
                                    <td >{{$patient->gender == 'male' ? 'Laki-laki' : 'Perempuan'}}</td>
                                    <th>Agama</th>
                                    <td>:</td>
                                    <td>{{$patient->religion}}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>:</td>
                                    <td>{{$patient->address}}</td>
                                    <th>Nama Dusun /RT/RW</th>
                                    <td>:</td>
                                    <td>{{$patient->rt_rw}}</td>

                                </tr>
                                <tr>
                                    <th>Kelurahan</th>
                                    <td>:</td>
                                    <td>{{$patient->sub_district}}</td>
                                    <th>Kecamatan</th>
                                    <td>:</td>
                                    <td>{{$patient->district}}</td>

                                </tr>
                                <tr>
                                    <th>Provinsi / Kota</th>
                                    <td>:</td>
                                    <td>{{$patient->province}} / {{$patient->city}}</td>
                                    <th>No Telepon</th>
                                    <td>:</td>
                                    <td >{{$patient->phone_number}}</td>
                                </tr>
                                <tr>
                                    <th>Pendidikan</th>
                                    <td>:</td>
                                    <td>{{$patient->last_education}}</td>
                                    <th>Pekerjaan</th>
                                    <td>:</td>
                                    <td>{{$patient->job}}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Pendaftaran</th>
                                    <td>:</td>
                                    <td>{{count($patient->registers)}} Kali Mendaftar</td>
                                    <th>Jumlah Kunjungan</th>
                                    <td>:</td>
                                    <td>{{$counts}} Kunjungan</td>
                                </tr>

                                </tbody>
                            </table>
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
                                            <div class="accordian-body collapse demo{{$index}}"> Poli Tujuan</div>
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
--}}
@endsection

@section('scripts')
    <script type="text/javascript">
    </script>
@endsection