@extends('layouts.app')
@section('breadcrumb')
    <li>
        <a href="{{url('/admin/staffjob')}}">Staff Job</a>
    </li>
    <li class="active">
        <strong>Tambah</strong>
    </li>
@endsection
@section('content')
    <div class="container" style="text-align: justify">
        <div class="ui breadcrumb">
            <div class="section">Admin</div>
            <div class="divider"> / </div>
            <div class="active section">Staff Job </div>
            <div class="divider"> / </div>
            <div class="active section">Tambah</div>
        </div><br/>
        <hr/>

        <form class="form-horizontal" role="form" method="POST"
              action="{{url('/admin/staffjob/modify')}}"
              enctype="multipart/form-data">
            {{ csrf_field() }}
            @if($staffjob)
                <input type="hidden" name="staffjob_id" value="{{$staffjob->id}}">
            @endif

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="staffjob" class="col-md-4 control-label">Name <span class="error">*</span> </label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" required
                           value="{{ $staffjob ? $staffjob->name :''}}" placeholder="Name" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
                <label for="desc" class="col-md-4 control-label">Description </label>
                <div class="col-md-6">
                    <textarea class="form-control" rows="5"  name="desc">{{$staffjob ?  $staffjob->desc : ''}}</textarea>

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
            <p class="error"> (*) mohon untuk di isi  </p>
        </form>

    </div>
@endsection
@section('scripts')
@endsection