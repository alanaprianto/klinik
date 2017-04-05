@extends('layouts.app')
@section('css')
    <style type="text/css">
        .form-group > label.control-label {
            text-align: left;
        }

        .coloum-clinic, .coloum-clinic-next {
            border: 1px solid #e7eaec;
            padding: 10px;
            margin-top: 10px;
        }

        .coloum-clinic button, .coloum-clinic-next button {
            float: right;
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
    <div class="container no-print" style="text-align: justify">
        <div class="ui breadcrumb">
            <div class="section">Loket</div>
            <div class="divider"> /</div>
            <div class="active section">Pendaftaran</div>
            <div class="divider"> /</div>
            <div class="active section">Tambah</div>
        </div>
        <br/>
        <hr/>

        <div class="row">
            <div class="col-md-12 text-center">
                <form class="form-inline form-rm">
                    {{csrf_field()}}
                    <div class="form-group field">
                        <label>Cari Pasien</label>
                        <input type="text" class="form-control typeahead" name="number_mr"
                               placeholder="name, No Rm">
                        <button type="submit" class="btn btn-primary">Cek</button>
                    </div>
                </form>
            </div>
        </div>
        <br/>
        <form method="post" class="form-horizontal ui form" id="form_register">
            {{csrf_field()}}
            <input type="hidden" name="kiosk_id" value="{{$kiosk_id ? $kiosk_id : ''}}">
            <input type="hidden" name="patient_number_id">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group field">
                        <label class="col-sm-4 control-label">No RM</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="number_medical_record"
                                   id="number_medical_record">
                        </div>
                    </div>
                    <div class="form-group field">
                        <label class="col-sm-4 control-label">Nama Lengkap</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="full_name">
                        </div>
                    </div>
                    <div class="form-group field">
                        <label class="col-sm-4 control-label">TTL</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Tempat" name="place"></div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control date-1" name="birth">
                        </div>
                    </div>
                    <div class="form-group field">
                        <label class="col-sm-4 control-label">Umur</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="age">
                        </div>
                    </div>
                    <div class="form-group field">
                        <label class="col-sm-4 control-label">Jenis Kelamin</label>
                        <div class="col-sm-8">
                            <select class="form-control m-b" name="gender">
                                @foreach(getGenders() as $gender)
                                    <option value="{{$gender}}">{{$gender == 'male' ? 'Laki-laki' : 'Perempuan'}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group field">
                        <label class="col-sm-4 control-label">Alamat</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="address"></textarea>
                        </div>
                    </div>
                    <div class="form-group field">
                        <label class="col-sm-4 control-label">Agama</label>
                        <div class="col-sm-8">
                            <select class="form-control m-b" name="religion">
                                @foreach(getReligions() as $religion)
                                    <option value="{{$religion}}">{{$religion}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group field">
                        <label class="col-sm-4 control-label">Provinsi / Kota</label>
                        <div class="col-sm-4">
                            <select class="form-control m-b" name="province" id="province">
                                @foreach(getProvinceCities() as $province => $arrayCities)
                                    <option value="{{$province}}">{{$province}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control m-b" name="city" id="city">
                                <option>-</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group field">
                        <label class="col-sm-4 control-label">Kecamatan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="district">
                        </div>
                    </div>
                    <div class="form-group field">
                        <label class="col-sm-4 control-label">Kelurahan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="sub_district">
                        </div>
                    </div>
                    <div class="form-group field">
                        <label class="col-sm-4 control-label">Nama Dusun /RT/RW</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="rt_rw">
                        </div>
                    </div>
                    <div class="form-group field">
                        <label class="col-sm-4 control-label">No Telp</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="phone_number">
                        </div>
                    </div>
                    <div class="form-group field"><label class="col-sm-4 control-label">Pendidikan</label>
                        <div class="col-sm-8">
                            <select class="form-control m-b" name="last_education">
                                @foreach(getEducations() as $education)
                                    <option value="{{$education}}">{{$education}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group field"><label class="col-sm-4 control-label">Pekerjaan</label>
                        <div class="col-sm-8">
                            <select class="form-control m-b" name="job">
                                @foreach(getJobs() as $job)
                                    <option value={{$job}}>{{$job}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group field">
                        <label class="col-sm-4 control-label">No Jamkesmas / Jamkesda / ASKES
                        </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="askes_number">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group field">
                        <label class="col-sm-4 control-label">Nama Penanggung Jawab</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="responsible_person">
                        </div>
                    </div>
                    <div class="form-group field">
                        <label class="col-sm-4 control-label">Status Penanggung Jawab</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="responsible_person_state">
                        </div>
                    </div>
                    <div class="form-group field">
                        <label class="col-sm-4 control-label">Sebab Sakit</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="cause_pain"></textarea>
                        </div>
                    </div>
                    <div class="form-group field">
                        <label class="col-sm-4 control-label">Cara Kunjungan</label>
                        <div class="col-sm-8">
                            <select class="form-control m-b" name="how_visit">
                                @foreach(getVisitType() as $type)
                                    <option value={{$type}}>{{$type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group field">
                        <label class="col-sm-4 control-label">Jam Kedatangan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control time-1" name="time_attend">
                        </div>
                    </div>
                    <div class="form-group field">
                        <label class="col-sm-4 control-label">Tipe Layanan</label>
                        <div class="col-sm-8">
                            <select class="form-control m-b" name="service_type">
                                @foreach(getServiceType() as $service)
                                    <option value="{{$service}}">{{$service}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group field">
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
                    <div class="form-group field">
                        <label class="col-sm-4 control-label">Nama Dokter</label>
                        <div class="col-sm-8">
                            <select class="form-control m-b" name="doctor" id="doctors">
                                <option>-</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group field">
                    <div class="col-sm-10 col-sm-offset-5">
                        <button class="btn btn-primary" type="submit">Daftar</button>
                        <a href="{{url('/loket/pendaftaran')}}" class="btn btn-secondary" type="button">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
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
    <script type="text/javascript" src="{{asset('assets/js/province.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/typeahead.bundle.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/bloodhound.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/handlebars-v4.0.5.js')}}"></script>

    <script type="text/javascript">
        function printModal(data) {
            var modal = $('.ui.modal');
            modal.find('.queue_number').html(data.data.kiosk.queue_number);
            modal.find('.register_number').html(data.data.register.register_number);
            modal.find('.number_medical_record').html(data.data.patient.number_medical_record);
            modal.find('.full_name').html(data.data.patient.full_name);
            modal.find('.age').html(data.data.patient.age);
            modal.find('.poly').html(data.data.poly.name);
            modal.find('.doctor').html(data.data.doctor.full_name);
            modal.find('.date').html(data.data.register.created_at);
            modal.modal({
                onVisible: function () {
                    window.print();
                }
            }).modal('show');
        }

        $('.date-1').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
        $('.time-1').timepicker({
            timeFormat: 'h:mm p',
            interval: 1,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $(document).ready(function () {
            $('input.typeahead').typeahead({
                source: function (query, process) {
                    return $.get('/loket/get_patient', {query: query}, function (data) {
                        return process(data);
                    });
                }
            });


            $('.form-rm').on('submit', function (e) {
                e.preventDefault();
                $this = $(this);
                var data = $this.serialize();
                $.ajax({
                    url: '/loket/check-medical-report',
                    data: data,
                    type: 'post',
                    success: function (data) {
                        if (data.is_success) {
                            if (data.data) {
                                $('input[name="patient_number_id"]').val(data.data.id);
                                $.each(data['data'], function (key, value) {
                                    if (key != 'cause_pain' && key != 'how_visit' && key != 'time_attend' && key != 'service_type' && key != 'responsible_person' && key != 'responsible_person_state') {
                                        $('input[name="' + key + '"]').val(value).prop('disabled', true);
                                        $('select[name="' + key + '"]').val(value).prop('disabled', true);
                                        $('textarea[name="' + key + '"]').html(value).prop('disabled', true);
                                    }
                                });
                            } else {
                                alert(data.message);
                            }
                        } else {
                            alert(data.message + 'please refresh your browser');
                        }
                    }
                })
            });

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
                })
            });

            $('#form_register').on('submit', function (e) {
                e.preventDefault();
                $this = $(this);
                var data_info = $this.serialize();
                $.post('/loket/pendaftaran/store', data_info).done(function (data) {
                    if (data.isSuccess) {
                        printModal(data)
                    } else {
                        alert(data.message)
                    }
                })
            });
        });
    </script>
@endsection