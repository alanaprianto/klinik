@extends('layouts.app')
@section('css')
    <style type="text/css">
        .form-group > label.control-label {
            text-align: left;
        }

        .col-md-6 dl dt {
            text-align: left;
        }

        table.table-info tbody tr td, table.table-info tbody tr th {
            border: none;
        }

        @media print {
            body *, .no-print, .no-print * {
                visibility: hidden;
            }

            #print-area * {
                visibility: visible;
            }

            #inside-no-print *{
                visibility: hidden;
            }

            #print-area {
                position: absolute;
                left: 0;
                top: 0;
            }
        }

        table.table-patient-info tbody tr th {
            padding-left: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="container" style="text-align: justify">
        <div class="ui breadcrumb">
            <div class="section">Loket</div>
            <div class="divider"> /</div>
            <div class="active section">Pendaftaran</div>
            <div class="divider"> /</div>
            <div class="active section">Tambah Rujukan</div>
        </div>
        <br/>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                <h3>Biodata Pasien</h3>
                <table class="table table-info">
                    <tbody>
                    <tr>
                        <th>No RM</th>
                        <td>:</td>
                        <td class="text-navy">{{$register->patient->number_medical_record}}</td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>:</td>
                        <td>{{$register->patient->full_name}}</td>
                    </tr>
                    <tr>
                        <th>Umur</th>
                        <td>:</td>
                        <td>{{$register->patient->age}}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>:</td>
                        <td>{{$register->patient->gender == 'male' ? 'Laki-laki' : 'Perempuam'}}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>:</td>
                        <td>{{$register->patient->address}}</td>
                    </tr>
                    <tr>
                        <th>Provinsi / Kota</th>
                        <td>:</td>
                        <td>{{$register->patient->province}} / {{$register->patient->city}}</td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h3></h3>
                <table class="table table-info">
                    <tbody>

                    <tr>
                        <th>Kecamatan</th>
                        <td>:</td>
                        <td>{{$register->patient->district}}</td>
                    </tr>
                    <tr>
                        <th>Kelurahan</th>
                        <td>:</td>
                        <td>{{$register->patient->sub_district}}</td>
                    </tr>
                    <tr>
                        <th>Nama Dusun /RT/RW</th>
                        <td>:</td>
                        <td>{{$register->patient->rt_rw}}</td>
                    </tr>
                    <tr>
                        <th>No Telp</th>
                        <td>:</td>
                        <td>{{$register->patient->phone_number}}</td>
                    </tr>
                    <tr>
                        <th>Pekerjaan</th>
                        <td>:</td>
                        <td>{{$register->patient->job}}</td>
                    </tr>
                    <tr>
                        <th>Nama Penanggung Jawab</th>
                        <td>:</td>
                        <td>{{$register->responsible_person}}</td>
                    </tr>
                    <tr>
                        <th>Status Penanggung Jawab</th>
                        <td>:</td>
                        <td>{{$register->responsible_person_state}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        @foreach($register->references as $index => $reference)
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <h3>Rujukan {{$index+1}}</h3>
                                    <form class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Klinik</label>
                                        <div class="col-sm-8">
                                            <select class="form-control m-b" disabled>
                                                @foreach($polies as $poly)
                                                    <option value="{{$poly->id}}" {{$poly->id == $reference->poly_id ? 'selected' : ''}}>{{$poly->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Nama Dokter</label>
                                        <div class="col-sm-8">
                                            <select class="form-control m-b" disabled>
                                                @foreach($doctors as $doctor)
                                                    <option value="{{$doctor->id}}" {{$doctor->id == $reference->staff_id ? 'selected' : ''}}>{{$doctor->full_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Status</label>
                                        <div class="col-sm-8">
                                            @if($reference->status == 1)
                                                <span class="alert-info">Menunggu Antrian Poli</span>
                                            @elseif($reference->status == 2)
                                                <span class="alert-warning">Selesai Pemeriksaan</span>
                                            @endif
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>

                        @endforeach
                    </div>
                    <div class="col-md-6">
                        <hr>
                        <h3>Tambah Rujukan </h3>
                        <form method="post" class="form-horizontal" id="form-reference">
                            {{csrf_field()}}
                            <input type="hidden" name="register_id" value="{{$register->id}}">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Klinik</label>
                                <div class="col-sm-8">
                                    <select class="form-control m-b" name="poly" id="clinic">
                                        <option>-</option>

                                        @foreach($polies as $poly)
                                            <option value="{{$poly->id}}">{{$poly->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Nama Dokter</label>
                                <div class="col-sm-8">
                                    <select class="form-control m-b" name="doctor" id="doctors">
                                        <option>-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="ui modal" id="print-area">
        <table style="width: 100%; table-layout: fixed">
            <tbody>
            <tr>
                <td rowspan="3" class="text-right" style="width: 20%"><img src="{{asset($hospital->image_header)}}"
                                                                           style="width:40px; height: 60px"></td>
                <td class="text-center" style="width:60%;"><span
                            style="font-size: 16px;"><b>{{$hospital->name}}</b></span>
                </td>
                <td rowspan="3" style="width:20%;" class="text-center"><span style="font-size: 24px"><b><span
                                    class="queue_number"></span></b></span></td>
            </tr>
            <tr>
                <td class="text-center"><span
                            style="font-size: 14px;"><b>{{$hospital->address}}</b></span></td>
            </tr>
            <tr>
                <td class="text-center"><span style="font-size: 12px;"><b>Telp.{{$hospital->phone}}</b></span>
                </td>
            </tr>
            </tbody>
        </table>
        <hr/>
        <table style="width:100%">
            <tbody>
            <tr>
                <td style="width: 50%">
                    <table style="width: 100%" class="table-patient-info">
                        <tr>
                            <th style="width: 40%">No Pendaftaran</th>
                            <td style="width: 5%">:</td>
                            <td style="width: 55%"><span class="register_number"></span></td>
                        </tr>
                        <tr>
                            <th>No Rekam Medik</th>
                            <td>:</td>
                            <td><span class="number_medical_record"></span></td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>:</td>
                            <td><span class="full_name"></span></td>
                        </tr>
                        <tr>
                            <th>Umur</th>
                            <td>:</td>
                            <td><span class="age"></span> Tahun</td>
                        </tr>
                    </table>
                </td>
                <td style="width: 50%">
                    <table style="width: 100%" table-patient-info>
                        <tr>
                            <th style="width: 40%">Poli Rujukan</th>
                            <td style="width: 5%">:</td>
                            <td style="width: 55%"><span class="poly"></span></td>
                        </tr>
                        <tr>
                            <th>Dokter</th>
                            <td>:</td>
                            <td><span class="doctor"></span></td>
                        </tr>
                        <tr>
                            <th>Tanggal Rujukan</th>
                            <td>:</td>
                            <td><span class="date"></span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
        <hr/>
        <div class="text-center" id="inside-no-print">
            <a href="{{url('/loket/pendaftaran')}}" class="btn btn-primary no-print">Kembali</a>
        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript">
        function printModal(datas) {
            var modal = $('.ui.modal');
            modal.find('.queue_number').html(datas.data.kiosk.queue_number);
            modal.find('.register_number').html(datas.data.register.register_number);
            modal.find('.number_medical_record').html(datas.data.patient.number_medical_record);
            modal.find('.full_name').html(datas.data.patient.full_name);
            modal.find('.age').html(datas.data.patient.age);
            modal.find('.poly').html(datas.data.poly.name);
            modal.find('.doctor').html(datas.data.doctor.full_name);
            modal.find('.date').html(datas.data.register.created_at);
            modal.modal({
                onVisible: function () {
                    window.print();
                }
            }).modal('show');
        }

        $(document).ready(function () {
            $(document).on('change', '#clinic', function () {
                $this = $(this);
                $.ajax({
                    url: '/loket/pendaftaran/pilih-poli',
                    type: 'POST',
                    data: {_token: $('meta[name="csrf-token"]').attr('content'), id: $this.val()},
                    success: function (data) {
                        var respone = JSON.parse(data.data);
                        $('#doctors').html('');
                        $.each(respone.doctors, function (key, value) {
                            var option = '<option value="' + value.id + '">' + value.full_name + '</option>';
                            $('#doctors').append(option);
                        });
                    }
                });

                $('#form-reference').on('submit', function (e) {
                    e.preventDefault();
                    $this = $(this);
                    var datas = $this.serialize();
                    $.post('/loket/pendaftaran/tambah-rujukan', datas).done(function (data) {
                        printModal(data.datas);
                    });
                });
            });
        });
    </script>
@endsection