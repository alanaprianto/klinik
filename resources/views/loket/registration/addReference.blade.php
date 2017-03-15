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
    </style>
@endsection
@section('breadcrumb')
    <li>
        <a href="{{url('/loket/pendaftaran')}}">Pendaftaran</a>
    </li>
    <li class="active">
        <strong>Tambah Rujukan</strong>
    </li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Tambah Rujukan User</h5>
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
                            <h3>Biodata Pasien</h3>
                            <table class="table table-info">
                                <tbody>
                                <tr>
                                    <th>No RM</th>
                                    <td>:</td>
                                    <td>{{$register->patient->number_medical_record}}</td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td>:</td>
                                    <td>{{$register->patient->full_name}}</td>
                                </tr>
                                <tr>
                                    <th>TTL</th>
                                    <td>:</td>
                                    <td>{{$register->patient->place}}, {{$register->patient->birth}}</td>
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
                                    <th>Agama</th>
                                    <td>:</td>
                                    <td>{{$register->patient->religion}}</td>
                                </tr>
                                <tr>
                                    <th>Provinsi / Kota</th>
                                    <td>:</td>
                                    <td>{{$register->patient->province}} / {{$register->patient->city}}</td>
                                </tr>
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
                                    <th>Pendidikan</th>
                                    <td>:</td>
                                    <td>{{$register->patient->last_education}}</td>
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
                        <div class="col-md-6">
                            @foreach($register->references as $index => $reference)
                                <div class="row">
                                    <div class="col-md-12">
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

                            <hr>
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