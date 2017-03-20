@extends('layouts.app')
@section('css')
    <link href="{{asset('css/croppie.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Profil Rumah Sakit</h5>
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
                    <form method="post" class="form-horizontal" action="{{url('/admin/rumah-sakit/profil')}}"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="hospital_id" value="{{$hospital ? $hospital->id : ''}}">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name"
                                               value="{{$hospital->name}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="address">{{$hospital->address}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Telp</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="phone"
                                               value="{{$hospital->phone}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Website</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="website"
                                               value="{{$hospital->website}}" placeholder="contoh: www.google.com">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Footer Kwitansi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="footer_kwitansi"
                                               value="{{$hospital->footer_kwitansi}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Status Unit</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="unit_state">
                                            <option value="Pusat" {{$hospital->unit_state == 'Pusat' ? 'selected' : ''}}>Pusat</option>
                                            <option value="Cabang" {{$hospital->unit_state == 'Cabang' ? 'selected' : ''}}>Cabang</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nomor Unit</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="unit_number"
                                               value="{{$hospital->unit_number}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Kode Provinsi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="province_code"
                                               value="{{$hospital->province_code}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nama Provinsi</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="province_name">
                                            <option>-</option>
                                            @foreach(getProvinceCities() as $province => $cities)
                                                <option value="{{$province}}" {{$hospital->province_name && ($hospital->province_name == $province) ? 'selected' : '' }}>{{$province}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Pjb. Penandatanganan Kwitansi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="signature_sign"
                                               value="{{$hospital->signature_sign}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Picture</label>
                                    <div class="col-md-10">
                                        <input type="file" name="file" class="form-control" id="upload"
                                               value="Choose a file"
                                               accept="image/*">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6">
                                        <div id="upload-demo">
                                            {!!$hospital && $hospital->image_header ? ' <img src="'.asset($hospital->image_header).'">' : ''!!}
                                            <img src="">
                                        </div>
                                        <input type="hidden" name="picture" class="picture">
                                        <button type="button" class="result" style="display: none">Crop</button>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
    <script type="text/javascript" src="{{asset('js/exif.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/croppie.min.js')}}"></script>
    <script>
        $('.datetime').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        function crop() {
            $uploadCrop = $('#upload-demo').croppie({
                enableExif: true,
                showZoomer: true,
                viewport: {
                    width: 150,
                    height: 200
                }
            });
        }


        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.upload-demo').addClass('ready');
                    $uploadCrop.croppie('bind', {
                        url: e.target.result
                    });
                };

                reader.readAsDataURL(input.files[0]);
            }
            else {
                swal("Sorry - you're browser doesn't support the FileReader API");
            }
        }

        $(document).ready(function () {
            $('#upload').on('change', function () {
                readFile(this);
                $('#upload-demo').html('');
                crop();
                $('.result').css('display', 'block');
            });
            $('.result').on('click', function (ev) {
                $this = $(this);
                $uploadCrop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport',
                    format: 'png'
                }).then(function (resp) {
                    var img = '<img src="' + resp + '">'
                    $('#upload-demo').html('');
                    $('#upload-demo').append(img);
                    $('.picture').val(resp);
                    $this.css('display', 'none');
                });
            });
        });
    </script>
@endsection