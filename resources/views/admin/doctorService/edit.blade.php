@extends('layouts.app')
@section('css')
@endsection
@section('breadcrumb')
    <li>
        <a href="{{url('/admin/doctorService')}}">Jasa Dokter</a>
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
                    <h5><i class="fa fa-angle-right"></i> Jasa Dokter </h5>
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
                    <form class="form-horizontal" role="form" method="POST"
                          action="{{url('/admin/jasa-dokter/post')}}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="staff_id" value="{{$doctor->id}}">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Nama Dokter</label>
                            <label class="col-md-2 control-label">{{$doctor->full_name}}</label>
                        </div>
                        <div class="form-group{{ $errors->has('cost') ? ' has-error' : '' }}">
                            <label for="cost" class="col-md-4 control-label">Tarif Jasa Dokter</label>
                            <div class="col-md-6">
                                <input id="cost" type="text" class="form-control" name="cost" required
                                       value="{{$doctor->doctorService ? $doctor->doctorService->allowance : ''}}" placeholder="Tarif Dokter" required autofocus>

                                @if ($errors->has('cost'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cost') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('allowance') ? ' has-error' : '' }}">
                            <label for="allowance" class="col-md-4 control-label">Tunjangan Dokter</label>
                            <div class="col-md-6">
                                <input id="allowance" type="text" class="form-control" name="allowance" required
                                       value="{{$doctor->doctorService ? $doctor->doctorService->allowance : ''}}" placeholder="Tunjangan Dokter" required>

                                @if ($errors->has('allowance'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('allowance') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection