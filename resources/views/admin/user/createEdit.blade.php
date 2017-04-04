@extends('layouts.app')
@section('content')
    <div class="container" style="text-align: justify">
        <div class="ui breadcrumb">
            <div class="section">Admin</div>
            <div class="divider"> / </div>
            <div class="active section">User</div>
            <div class="divider"> / </div>
            <div class="active section">Tambah</div>
        </div><br/>
        <hr/>

        <form class="form-horizontal" role="form" method="POST"
              action="{{url('/admin/user/modify')}}"
              enctype="multipart/form-data">
            {{ csrf_field() }}
            @if($user)
                <input type="hidden" name="user_id" value="{{$user->id}}">
            @endif
            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <label for="user" class="col-md-4 control-label">User Name <span class="error">*</span> </label>
                <div class="col-md-6">
                    <input id="username" type="text" class="form-control" name="username" required
                           value="{{ $user ? $user->username :'' }}" placeholder="User Name" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="stock" class="col-md-4 control-label">email <span class="error">*</span>  </label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" placeholder="Email" required
                           name="email" value="{{ $user ? $user->email :'' }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">password <span class="error">*</span> </label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" placeholder="Password" required
                           name="password" value="{{ $user ? $user->password :'' }}" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-4 control-label">password <span class="error">*</span> </label>
                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" required
                           name="password_confirmation" placeholder="Confirm Password" value="{{ $user ? $user->password :'' }}"
                           required>
                </div>
            </div>
            <div class="form-group">
                <label for="role" class="col-md-4 control-label">Role</label>
                <div class="col-md-6">
                    <select id="role" name="role" class="form-control" required>
                        @foreach($roles as $role)
                            <option value="{{$role->id}}" {{$user && ($user->roles[0]->id == $role->id) ? 'selected' : ''}}>{{$role->display_name}}</option>
                        @endforeach
                        @if ($errors->has('role'))
                            <strong>{{ $errors->first('role') }}</strong>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Upload
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
@endsection