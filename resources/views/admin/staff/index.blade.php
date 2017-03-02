@extends('layouts.app')

@section('content')
    {{--<script type="text/javascript" href="{{asset('/js/table.js')}}"></script>--}}
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Staff </h3>

            <!-- BASIC FORM ELELEMNTS -->
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <div class="action" style="margin-bottom: 10px">
                            <a href="{{url('/admin/staff/create')}}" type="button"  class="btn btn-primary">Tambah Staff </a>
                        </div>
                        <div class="table-responsive">
                        <table class="table table-stripped" id="table-staff" data-token="{{csrf_token()}}">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat</th>
                                <th>Tanggal</th>
                                <th>Umur</th>
                                <th>Agama</th>
                                <th>Alamat</th>
                                <th>provinsi</th>
                                <th>Kota / Kabupaten</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan / Desa</th>
                                <th>RT / RW</th>
                                <th>Nomber Telepon </th>
                                <th>Pendidikan</th>
                                <th>Staff Position</th>
                                <th>Staff Job</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        </table>
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
@endsection
