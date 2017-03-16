@extends('layouts.app')
@section('css')
    <style type="text/css">
        .form-group > label.control-label {
            text-align: left;
        }

        .col-md-6 dl dt {
            text-align: left;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Tambah Rujukan Pasien </h5>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Biodata Pasien</h3>
                                    <dl class="dl-horizontal">
                                        <dt>No RM</dt>
                                        <dd>{{$register->patient->number_medical_record}}</dd>
                                        <dt>Nama Lengkap</dt>
                                        <dd>{{$register->patient->full_name}}</dd>
                                        <dt>TTL</dt>
                                        <dd>{{$register->patient->place}}, {{$register->patient->birth}}</dd>
                                        <dt>Umur</dt>
                                        <dd>{{$register->patient->age}}</dd>
                                        <dt>Jenis Kelamin</dt>
                                        <dd>{{$register->patient->gender == 'male' ? 'Laki-laki' : 'Perempuam'}}</dd>
                                        <dt>Alamat</dt>
                                        <dd>{{$register->patient->address}}</dd>
                                        <dt>Agama</dt>
                                        <dd>{{$register->patient->religion}}</dd>
                                        <dt>Provinsi / Kota</dt>
                                        <dd>{{$register->patient->province}} / {{$register->patient->city}}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <h3>         </h3>
                                    <dl class="dl-horizontal" style="margin-top:30px ">
                                        <dt>Kecamatan</dt>
                                        <dd>{{$register->patient->district}}</dd>
                                        <dt>Kelurahan</dt>
                                        <dd>{{$register->patient->sub_district}}</dd>
                                        <dt>Nama Dusun /RT/RW</dt>
                                        <dd>{{$register->patient->rt_rw}}</dd>
                                        <dt>No Telp</dt>
                                        <dd>{{$register->patient->phone_number}}</dd>
                                        <dt>Pendidikan</dt>
                                        <dd>{{$register->patient->last_education}}</dd>
                                        <dt>Pekerjaan</dt>
                                        <dd>{{$register->patient->job}}</dd>
                                        <dt>Nama Penanggung Jawab</dt>
                                        <dd>{{$register->responsible_person}}</dd>
                                        <dt>Status Penanggung Jawab</dt>
                                        <dd>{{$register->responsible_person_state}}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-md-6">
                            @foreach($register->references as $index => $reference)
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr/>
                                        <h3>Rujukan {{$index+1}}</h3>
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
                                                    <span class="alert-warning">Menunggu Antrian Apotek</span>
                                                @elseif($reference->status == 3)
                                                    <span class="alert-success">Success / Dirujuk ke Poli lain</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-6">
                            <h3>Tambah Rujukan </h3>
                            <form method="post" class="form-horizontal" action="/loket/pendaftaran/tambah-rujukan">
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
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
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