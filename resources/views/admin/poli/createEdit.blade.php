@extends('layouts.app')
@section('content')
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> POLI <i class="fa fa-angle-right"></i> {{$poli ? "Edit" : "Create"}}
            </h3>

            <!-- BASIC FORM ELELEMNTS -->
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST"
                                  action="{{url('/admin/poli/modify')}}"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @if($poli)
                                    <input type="hidden" name="poli_id" value="{{$poli->id}}">
                                @endif

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="poli" class="col-md-4 control-label">Poli</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name"
                                               value="{{ $poli ? $poli->name :''}}" placeholder="Name" required autofocus>

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
                                        <textarea class="form-control" rows="5" name="desc">{{$poli ?  $poli->desc : ''}}</textarea>

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