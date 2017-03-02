@extends('layouts.app')
@section('content')
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Staff Position <i class="fa fa-angle-right"></i> {{$staffposition? "Edit" : "Create"}}
            </h3>

            <!-- BASIC FORM ELELEMNTS -->
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST"
                                  action="{{url('/admin/staffposition/modify')}}"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @if($staffposition)
                                    <input type="hidden" name="staffposition_id" value="{{$staffposition->id}}">
                                @endif

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="staffjob" class="col-md-4 control-label">staffposition</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name"
                                               value="{{ $staffposition ? $staffposition->name :''}}" placeholder="Name" required autofocus>

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
                                        <textarea class="form-control" rows="5" name="desc">{{$staffposition ?  $staffposition->desc : ''}}</textarea>

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