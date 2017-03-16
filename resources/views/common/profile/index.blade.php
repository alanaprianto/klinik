@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Profil</h5>
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
                    <form method="post" class="form-horizontal" action="{{url('/loket/profil')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nama Lengkap</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="full_name" value="{{$user->staff->full_name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tempat / Tanggal Lahir</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="place" value="{{$user->staff->place}}">
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="birth" value="{{$user->staff->birth}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="address">{{$user->staff->address}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Agama</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="religion">
                                    @foreach(getReligions() as $religion)
                                        <option value="{{$religion}}" {{$religion == $user->staff->religion ? 'selected' : ''}}>{{$religion}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="gender">
                                    @foreach(getGenders() as $gender)
                                        <option value="{{$gender}}" {{$gender == $user->staff->gender ? 'selected' : ''}}>{{$gender == 'male' ? 'Laki-laki' : 'Perempuan'}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Provinsi / Kota</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="province" id="province">
                                    @foreach(getProvinceCities() as $province => $arrayCities)
                                        <option value="{{$province}}" {{$arrayCities == $user->staff->province ? 'selected' : ''}}>{{$province}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-5">
                                <select class="form-control m-b" name="city" id="city">
                                    <option>-</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kecamatan / Kelurahan</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="district" value="{{$user->staff->district}}">
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="sub_district" value="{{$user->staff->sub_district}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nama Dusun /RT/RW</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="rt_rw" value="{{$user->staff->rt_rw}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nomor Telepon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="phone_number" value="{{$user->staff->phone_number}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Pendidikan</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="last_education">
                                    @foreach(getEducations() as $education)
                                        <option value="{{$education}}" {{$education == $user->staff->last_education ? 'selected' : ''}}>{{$education}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-5">
                                <button class="btn btn-primary" type="submit">Update</button>
                                <a href="/loket" class="btn btn-white" type="button">Cancel</a>
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
@endsection