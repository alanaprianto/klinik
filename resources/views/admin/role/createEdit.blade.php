@extends('layouts.app')
@section('content')
    <div class="container" style="text-align: justify">
        <div class="ui breadcrumb">
            <div class="section">Admin</div>
            <div class="divider"> / </div>
            <div class="active section">Role</div>
            <div class="divider"> / </div>
            <div class="active section">Tambah</div>
        </div><br/>
        <hr/>

        <form class="form-horizontal" role="form" method="POST"
              action="{{url('/admin/role/modify')}}"
              enctype="multipart/form-data">
            {{ csrf_field() }}
            @if($role)
                <input type="hidden" name="role_id" value="{{$role->id}}">
            @endif

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Nama<span class="error">*</span></label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name"
                           value="{{ $role ? $role->name :''}}" placeholder="Name" required>

                    @if ($errors->has('name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
                <label for="user" class="col-md-4 control-label">Nama Tampilan <span class="error">*</span></label>
                <div class="col-md-6">
                    <input id="display_name" type="text" class="form-control" name="display_name"
                           value="{{ $role ? $role->display_name :'' }}" placeholder="Display Name" required>

                    @if ($errors->has('name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="stock" class="col-md-4 control-label">Deskripsi</label>
                <div class="col-md-6">
                    <textarea name="description" class="form-control">{{$role ? $role->description : ''}}</textarea>

                    @if ($errors->has('description'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
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