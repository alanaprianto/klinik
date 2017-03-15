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
    </style>
@endsection

@section('breadcrumb')
    <li>
        <a href="{{url('/loket/pendaftaran')}}">Pendaftaran</a>
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
                    <h5>Pendaftaran Umum</h5>
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
                        <div class="col-md-12 text-center">
                            <form class="form-inline form-rm">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label>Cari Nomor RM</label>
                                    <input type="text" class="form-control" name="number_mr"
                                           placeholder="0123456789">
                                </div>
                                <button type="submit" class="btn btn-default">Cari</button>
                            </form>
                        </div>
                    </div>
                    <hr/>
                    <form method="post" class="form-horizontal" action="/loket/pendaftaran/store">
                        {{csrf_field()}}
                        <input type="hidden" name="kiosk_id" value="{{$kiosk_id ? $kiosk_id : ''}}">
                        <input type="hidden" name="patient_number_id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">No RM</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="number_medical_record"
                                               id="number_medical_record">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Nama Lengkap</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="full_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">TTL</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" placeholder="Tempat" name="place"></div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control date-1" name="birth">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Umur</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="age">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Jenis Kelamin</label>
                                    <div class="col-sm-8">
                                        <select class="form-control m-b" name="gender">
                                            @foreach(getGenders() as $gender)
                                                <option value="{{$gender}}">{{$gender == 'male' ? 'Laki-laki' : 'Perempuan'}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Alamat</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" name="address"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Agama</label>
                                    <div class="col-sm-8">
                                        <select class="form-control m-b" name="religion">
                                            @foreach(getReligions() as $religion)
                                                <option value="{{$religion}}">{{$religion}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
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
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Kecamatan</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="district">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Kelurahan</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="sub_district">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Nama Dusun /RT/RW</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="rt_rw">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">No Telp</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="phone_number">
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Pendidikan</label>
                                    <div class="col-sm-8">
                                        <select class="form-control m-b" name="last_education">
                                            @foreach(getEducations() as $education)
                                                <option value="{{$education}}">{{$education}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Pekerjaan</label>
                                    <div class="col-sm-8">
                                        <select class="form-control m-b" name="job">
                                            @foreach(getJobs() as $job)
                                                <option value={{$job}}>{{$job}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">No Jamkesmas / Jamkesda / ASKES
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="askes_number">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Nama Penanggung Jawab</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="responsible_person">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Status Penanggung Jawab</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="responsible_person_state">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Sebab Sakit</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" name="cause_pain"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Cara Kunjungan</label>
                                    <div class="col-sm-8">
                                        <select class="form-control m-b" name="how_visit">
                                            @foreach(getVisitType() as $type)
                                                <option value={{$type}}>{{$type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Jam Kedatangan</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control time-1" name="time_attend">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Tipe Layanan</label>
                                    <div class="col-sm-8">
                                        <select class="form-control m-b" name="service_type">
                                            @foreach(getServiceType() as $service)
                                                <option value="{{$service}}">{{$service}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
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
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-5">
                                    <button class="btn btn-primary" type="submit">Daftar</button>
                                    <a href="/loket/pendaftaran" class="btn btn-white" type="button">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('js/province.js')}}"></script>
    <script type="text/javascript">
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
                    data: {_token: $('meta[name="csrf-token"]').attr('content'), id : $this.val()},
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
        });
    </script>
@endsection