@extends('layouts.app')
@section('content')
    <div class="container" style="text-align: justify">
        <div class="ui breadcrumb">
            <div class="section">Admin</div>
            <div class="divider"> / </div>
            <div class="active section">Poli</div>
        </div><br/>

        <hr/>
        <div class="action" style="margin-bottom: 10px">
            <a href="{{url('/admin/poli/create')}}" type="button"  class="btn btn-primary">Tambah Poli </a>
        </div>

        <table id="table-poli" class="ui celled table dataTable responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
    </div>
{{--    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5> <i class="fa fa-angle-right"></i> Poli </h5>
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
                    <div class="form-panel">
                        <div class="action" style="margin-bottom: 10px">
                            <a href="{{url('/admin/poli/create')}}" type="button"  class="btn btn-primary">Tambah Poli </a>
                        </div>

                        <table class="table table-stripped" id="table-poli" data-token="{{csrf_token()}}">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
@endsection
@section('scripts')
{{--
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '.btn-remove', function () {
                $this = $(this);
                var $id = $this.data('id');
                if (confirm('Apakah anda yakin akan menghapus postingan ini?')) {
                    var $form = $('<form />');
                    $form.attr('action', '/admin/poli/delete');
                    $form.attr('method', 'post');
                    $form.css({
                        'display': 'none'
                    });
                    //csrf
                    var csrf = $('<input />');
                    csrf.attr('type', 'hidden');
                    csrf.attr('name', '_token');
                    csrf.val($('meta[name="csrf-token"]').attr('content'));
                    $form.append(csrf);
                    //id
                    var id = $('<input />');
                    id.attr('type', 'hidden');
                    id.attr('name', 'id');
                    id.val($id);
                    $form.append(id);
                    $('body').append($form);
                    $form.submit();
                }
            });
        });
    </script>
--}}
@endsection
