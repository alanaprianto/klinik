@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5> <i class="fa fa-angle-right"></i> Setting <i class="fa fa-angle-right"></i> {{$setting ? "Edit" : "Create"}}</h5>
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
                       <!-- BASIC FORM ELELEMNTS -->
                    <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST"
                                  action="{{url('/admin/setting/modify')}}"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @if($setting)
                                    <input type="hidden" name="setting_id" value="{{$setting->id}}">
                                @endif

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="tindakan" class="col-md-4 control-label">Setting</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name"
                                               value="{{ $setting ? $setting->name :''}}" placeholder="Name" required autofocus>

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
                                        <textarea class="form-control" rows="5"  name="desc">{{$setting ?  $setting->desc : ''}}</textarea>

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
                    </div>

                </div>
            </div>
    </div>

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