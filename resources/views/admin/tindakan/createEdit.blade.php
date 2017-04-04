@extends('layouts.app')
@section('content')
    <div class="container" style="text-align: justify">
        <div class="ui breadcrumb">
            <div class="section">Admin</div>
            <div class="divider"> / </div>
            <div class="active section">Tindakan</div>
            <div class="divider"> / </div>
            <div class="active section">Tambah</div>
        </div><br/>
        <hr/>

        <form class="form-horizontal" role="form" method="POST"
              action="{{url('/admin/tindakan/modify')}}"
              enctype="multipart/form-data">
            {{ csrf_field() }}
            @if($service)
                <input type="hidden" name="service_id" value="{{$service->id}}">
            @endif

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="tindakan" class="col-md-4 control-label">Nama <span class="error">*</span></label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" required
                           value="{{ $service ? $service->name :''}}" placeholder="Name" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="tindakan" class="col-md-4 control-label">Harga <span class="error">*</span></label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="cost" required
                           value="{{ $service ? $service->cost :''}}" placeholder="Harga" required autofocus>

                    @if ($errors->has('cost'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('cost') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
                <label for="desc" class="col-md-4 control-label">Description </label>
                <div class="col-md-6">
                    <textarea class="form-control" rows="5"  name="desc">{{$service ?  $service->desc : ''}}</textarea>

                    @if ($errors->has('desc'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('desc') }}</strong>
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

@endsection
@section('scripts')
@endsection