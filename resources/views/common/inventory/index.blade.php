@extends('layouts.app')

@section('content')
    <div class="container" style="text-align: justify">
        <div class="ui breadcrumb">
            <div class="section">{{ucfirst($role)}}</div>
            <div class="divider"> / </div>
            <div class="active section">Inventory</div>
        </div><br/>
        <hr/>
        <div class="action" style="margin-bottom: 10px">
            <a href="{{url('/'.$role.'/inventory/create')}}" type="button"  class="btn btn-primary">Tambah Barang</a>
        </div>
        <table id="table-medicine" class="ui celled table dataTable responsive" cellspacing="0" width="100%" data-role="{{$role}}">
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
                <th>Sediaan</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
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