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