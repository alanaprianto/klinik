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

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><i class="fa fa-angle-right"></i> POLI <i
                                class="fa fa-angle-right"></i> {{$staff ? "Edit" : "Create"}}</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                    <div class="ibox-content">
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST"
                                  action="{{url('/admin/staff/modify')}}"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @if($staff)
                                    <input type="hidden" name="staff" value="{{$staff->id}}">
                                @endif
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">NIK</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="nik" value="{{ $staff ? $staff->nik :''}}">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Nama Lengkap</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="full_name" value="{{ $staff ? $staff->full_name :''}}">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">TTL</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" placeholder="Tempat" name="place"  value="{{ $staff ? $staff->place :''}}"></div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control date-1" name="birth"  value="{{ $staff ? $staff->birth :''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Umur</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="age" value="{{ $staff ? $staff->age :''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Jenis Kelamin</label>
                                    <div class="col-sm-8">
                                        <select class="form-control m-b" name="gender" value="{{ $staff ? $staff->gender :''}}">
                                            @foreach(getGenders() as $gender)
                                                <option value="{{$gender}}">{{$gender == 'male' ? 'Laki-laki' : 'Perempuan'}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Alamat</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" name="address" value="{{ $staff ? $staff->address :''}}"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Agama</label>
                                    <div class="col-sm-8">
                                        <select class="form-control m-b" name="religion" value="{{ $staff ? $staff->religion :''}}">
                                            @foreach(getReligions() as $religion)
                                                <option value="{{$religion}}">{{$religion}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Provinsi / Kota</label>
                                    <div class="col-sm-4">
                                        <select class="form-control m-b" name="province" id="province" value="{{ $staff ? $staff->province :''}}">
                                            @foreach(getProvinceCities() as $province => $arrayCities)
                                                <option value="{{$province}}">{{$province}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <select class="form-control m-b" name="city" id="city" value="{{ $staff ? $staff->city :''}}">
                                            <option>-</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Kecamatan</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="district" value="{{ $staff ? $staff->district :''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Kelurahan</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="sub_district" value="{{ $staff ? $staff->sub_district :''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Nama Dusun /RT/RW</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="rt_rw" value="{{ $staff ? $staff->rt_rw :''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">No Telp</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="phone_number" value="{{ $staff ? $staff->phone_number :''}}">
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Pendidikan</label>
                                    <div class="col-sm-8">
                                        <select class="form-control m-b" name="last_education"  value="{{ $staff ? $staff->last_education :''}}">
                                            @foreach(getEducations() as $education)
                                                <option value="{{$education}}">{{$education}}</option>
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{url('/admin/staff/modify')}}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="staff_id" value="{{$staff ? $staff->id : ''}}">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">NIK</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="nik"
                                           value="{{$staff ? $staff->nik : ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Nama Lengkap</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="full_name"
                                           value="{{$staff ? $staff->full_name : ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">TTL</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" placeholder="Tempat" name="place"
                                           value="{{$staff ? $staff->place : ''}}"></div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control date-1" name="birth"
                                           value="{{$staff ? $staff->birth : ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Umur</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="age"
                                           value="{{$staff ? $staff->age : ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Jenis Kelamin</label>
                                <div class="col-sm-8">
                                    <select class="form-control m-b" name="gender">
                                        @foreach(getGenders() as $gender)
                                            <option value="{{$gender}}" {{$staff && ($staff->gender == $gender) ? 'selected' : '' }}>{{$gender == 'male' ? 'Laki-laki' : 'Perempuan'}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Alamat</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control"
                                              name="address">{{$staff ? $staff->address : ''}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Agama</label>
                                <div class="col-sm-8">
                                    <select class="form-control m-b" name="religion">
                                        @foreach(getReligions() as $religion)
                                            <option value="{{$religion}}" {{$staff && ($staff->religion == $religion) ? 'selected' : '' }}>{{$religion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Provinsi / Kota</label>
                                <div class="col-sm-4">
                                    <select class="form-control m-b" name="province" id="province">
                                        <option></option>
                                        @foreach(getProvinceCities() as $province => $arrayCities)
                                            <option value="{{$province}}" {{$staff && ($staff->province == $province) ? 'selected' : '' }}>{{$province}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control m-b" name="city" id="city"
                                            value="{{$staff ? $staff->full_name : ''}}">
                                        <option>-</option>
                                        @if($staff)
                                            @foreach(getProvinceCities()[$staff->province] as $city)
                                                <option value="{{$city}}" {{$city == $staff->city    ? 'selected' : ''}}>{{$city}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">

                                <label class="col-md-4 control-label">Staff Jobs & Staff position </label>

                                <div class="col-md-4">
                                    <select  class="js-example-basic-multiple js-states form-control"  multiple="multiple" id="staffjob" name="staffjob">
                                        @foreach($staffjobs as $staffjob)
                                            <option value="{{$staffjob->id}}" {{$staff && ($staff->staffjob->id == $staffjob->id) ? 'selected' : ''}}>{{$staffjob->name}}</option>
                                <label class="col-sm-4 control-label">Kecamatan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="district"
                                           value="{{$staff ? $staff->district : ''}}">
                                </div>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Kelurahan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="sub_district"
                                           value="{{$staff ? $staff->sub_district : ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Nama Dusun /RT/RW</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="rt_rw"
                                           value="{{$staff ? $staff->rt_rw : ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">No Telp</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="phone_number"
                                           value="{{$staff ? $staff->phone_number : ''}}">
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-4 control-label">Pendidikan</label>
                                <div class="col-sm-8">
                                    <select class="form-control m-b" name="last_education">
                                        @foreach(getEducations() as $education)
                                            <option value="{{$education}}" {{$staff && ($staff->last_education == $education) ? 'selected' : ''}}>{{$education}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Staff Job</label>
                                <div class="col-sm-3">
                                    <select class="form-control m-b" name="staff_job_id">
                                        @foreach($staffjobs as $staffjob)
                                            <option value="{{$staffjob->id}}" {{$staff && ($staff->staff_job_id == $staff->id) ? 'selected' : ''}}>{{$staffjob->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label class="col-sm-2 control-label">Staff Posisi</label>
                                <div class="col-sm-3">
                                    <select class="form-control m-b" name="staff_position">
                                        @if($staff && $staff->staff_position_id)
                                            <option value="{{$staff->staffposition->id}}"
                                                    selected>{{$staff->staffposition->name}}</option>
                                        @endif
                                        @foreach($staffpositions as $staffposition)
                                            <option value="{{$staffposition->id}}">{{$staffposition->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Staff position </label>
                                    <div class="col-md-4">
                                        <select  class="js-example-basic-multiple js-states form-control"  multiple="multiple" id="staffposition" name="staffposition">
                                            @foreach($staffpositions as $staffposition)
                                                <option value="{{$staffposition->id}}" >{{$staffposition->name}}</option>
                                            @endforeach
                                            @if ($errors->has('staffposition'))

                                                <strong>{{ $errors->first('staffposition') }}</strong>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-5">
                                    <button class="btn btn-primary" type="submit">Daftar</button>
                                    <a href="/admin/staff" class="btn btn-white" type="button">Cancel</a>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                </div>
    </div>
                        </div>
                        </form>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
        });
    </script>
@endsection