@extends('layouts.app')
@section('content')
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> User <i class="fa fa-angle-right"></i> {{$user ? "Edit" : "Create"}}
            </h3>

            <!-- BASIC FORM ELELEMNTS -->
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST"
                                  action="{{url('/admin/user/modify')}}"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @if($user)
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                @endif

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="user" class="col-md-4 control-label">User</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name"
                                               value="{{ $user ? $user->name :''}}" placeholder="Name" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                    <label for="user" class="col-md-4 control-label">User Name </label>
                                    <div class="col-md-6">
                                        <input id="username" type="text" class="form-control" name="username"
                                               value="{{ $user ? $user->username :'' }}" placeholder="User Name" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="stock" class="col-md-4 control-label">email</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" placeholder="Email"
                                               name="email" value="{{ $user ? $user->email :'' }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">password</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" placeholder="Password"
                                               name="password" value="{{ $user ? $user->password :'' }}" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-4 control-label">password</label>
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" placeholder="Confirm Password" value="{{ $user ? $user->password :'' }}"
                                               required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="role" class="col-md-4 control-label">Role</label>
                                    <div class="col-md-6">
                                        <select id="role" name="role">

                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}" {{$user && ($user->roles[0]->id == $role->id) ? 'selected' : ''}}>{{$role->display_name}}</option>
                                                {{--<option value="{{$role->id}}">{{$role->display_name}}</option>--}}
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
                    </div>

                </div>
            </div>
        </section>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            var ids = [];
            $('.remove-document').click(function () {
                $this = $(this);
                var id = $this.data('id');
                ids.push(id);
                $('.ids').val(ids);
                $this.parent().parent().remove();
            });
        });
    </script>
@endsection