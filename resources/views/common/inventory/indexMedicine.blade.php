@extends('layouts.app')
@section('css')
    <style type="text/css">
        .datepicker {
            z-index: 10050 !important;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><i class="fa fa-angle-right"></i> Inventory</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="form-panel">
                        <div class="action" style="margin-bottom: 10px">
                            <a href="{{url('/'.$role.'/obat/create')}}" type="button" class="btn btn-primary">Tambah
                                Obat</a>
                        </div>

                        <table class="table table-stripped" id="table-medicine" data-role="{{$role}}">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Tipe</th>
                                <th>Total</th>
                                <th>Stock Minimal</th>
                                <th>Stock Maximal</th>
                                <th>sediaan</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Batch</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        {{csrf_field()}}
                        <input type="hidden" name="id" id="inventory_id">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Kode Batch</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="code" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Stock</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="stock" name="stock" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Expired Date</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control datepicker" name="expired_date" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-submit">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).on('click', '.btn-modal', function () {
            var id = $(this).data('id');
            var max = $(this).data('max');
            var mymodal = $('#myModal');
            mymodal.find('#inventory_id').val(id);
            mymodal.find('#stock').attr('max', max);

            $('#myModal').modal('show');
        });

        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        });

        $(document).on('click', '.btn-submit', function (e) {
            e.preventDefault();
            $this = $(this);
            var form = $this.parent().prev().find('form');
            $.ajax({
                url: '/admin/post-batch',
                type: 'POST',
                data: form.serialize(),
                success: function (data) {
                    $('#myModal').modal('hide');
                    $('#myModal').on('hidden.bs.modal', function () {
                        $(this).find('form').trigger('reset');
                    })
                }
            })
        });

        $(document).ready(function () {
            $(document).on('click', '.btn-remove', function () {
                $this = $(this);
                var $id = $this.data('id');
                if (confirm('Apakah anda yakin akan menghapus postingan ini?')) {
                    var $form = $('<form />');
                    $form.attr('action', '/{{$role}}/inventory/delete');
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
@endsection
