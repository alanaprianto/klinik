@extends('layouts.app')

@section('css')
    <style type="text/css">
        .table-apotek {
            table-layout: fixed;
        }
    </style>
@endsection
@section('content')
    <div class="container" style="text-align: justify">
        <div class="ui breadcrumb">
            <div class="section">Apotek</div>
            <div class="divider"> / </div>
            <div class="active section">Resep</div>
            <div class="divider"> / </div>
            <div class="active section">Tambah</div>
        </div><br/>
        <hr/>

        <form class="form-horizontal form-apotek" role="form" method="POST"
              action="{{url('/apotek/resep/post')}}"
              enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="reference_id" id="reference_id">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nama Lengkap</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="full_name"
                                   id="full_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Jenis Kelamin</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="gender" id="gender">
                                @foreach(getGenders() as $gender)
                                    <option value="{{$gender}}">{{$gender}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nomor Telepon</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="phone_number"
                                   id="phone_number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Alamat</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="address" id="address"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <hr/>
            <div class="row">
                <div class="col-md-12">
                    <div class="action">
                        <button type="button" class="btn btn-primary btn-tuslah"><i class="fa fa-plus">
                                Biaya Tuslah</i></button>
                    </div>
                    <table class="table table-tuslah" hidden>
                        <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="35%">Nama / Jenis Tuslah</th>
                            <th width="20%">Jumlah</th>
                            <th width="20%">Satuan / Harga</th>
                            <th width="20%">Total</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <hr/>
                    <table class="table table-apotek">
                        <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="35%">Nama Alkes / Non Alkes</th>
                            <th width="20%">Jumlah</th>
                            <th width="20%">Harga Satuan</th>
                            <th width="20%">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="clone">
                            <td>
                                <button class="btn btn-primary btn-plus" type="button"><i
                                            class="fa fa-plus"></i>
                                </button>
                            </td>
                            <td>
                                <select class="form-control inventory" name="inventory[]">
                                    <option>--Pilih Obat--</option>
                                    @foreach($inventories as $inventory)
                                        <option value="{{$inventory->id}}">{{$inventory->code}}
                                            / {{$inventory->name}}
                                            / stock : {{$inventory->total}} {{$inventory->unit}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" class="form-control amount" min="1" name="amount[]">
                            </td>
                            <td></td>
                            <td class="sum-amount"></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="2">Total Pembayaran</th>
                            <th colspan="3" class="text-right">Rp.<span class="total-amount">0</span></th>
                        </tr>
                        </tfoot>
                    </table>

                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>
@endsection

@section('scripts')
    <script>
        function updateTotal(table) {
            var sum_amount = table.parent().find('.sum-amount');
            var total = 0;
            sum_amount.each(function (index, value) {
                if(value.textContent){
                    var amount = parseFloat(value.textContent);
                    total += amount;
                }
            });
            $('.total-amount').html(total);
        }

        function input_number($this) {
            var tr = $this.closest('tr');
            var table = $this.closest('table');
            var test = tr.find('td:eq(3)').find('input').length;
            var amount;
            if(test){
                amount = tr.find('td:eq(3)').find('input').val();
            } else{
                amount = tr.find('td:eq(3)').text();
            }
            var value = $this.val();
            if (value) {
                amount = parseFloat(amount);
                var total = amount * value;
                tr.find('td:eq(4)').html(total);
                updateTotal(table)
            }
        }

        $(document).ready(function () {
            $('.btn-plus').on('click', function () {
                $this = $(this);
                var table = $('.table-apotek');
                var cloned = table.find('.clone').clone();
                cloned.removeClass('clone');
                cloned.find('input').val('');
                cloned.find('td:eq(3)').html('');
                cloned.find('td:eq(4)').html('');
                cloned.find('.btn-plus').removeClass('btn-plus').addClass('btn-minus').html('<i class="fa fa-minus"><i/>');
                table.find('tbody').append(cloned);
            });


            $(document).on('click', '.btn-minus', function () {
                $this = $(this);
                var tr = $this.closest('tr');
                var td = tr.find('td:eq(4)').text();
                if(td){
                    value = parseFloat(td);
                    var total = parseFloat($('.total-amount').text());
                    var result = total - value;
                    $('.total-amount').html(result);
                }
                tr.remove();
            });

            $(document).on('change', '.inventory', function () {
                $this = $(this);
                var tr = $this.parent().parent();
                var id = $this.val();
                $.ajax({
                    url: '/apotek/get-inventory',
                    type: 'POST',
                    data: {id: id, _token: $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        if (data.isSuccess) {
                            if (data.message) {
                                tr.find('td:eq(3)').html(data.data.price);
                                var td3 = tr.find('.amount').val();
                                if (td3) {
                                    tr.find('td:eq(4)').html(data.data.price * td3);
                                    updateTotal($this.closest('table'))
                                }
                            }
                        } else {
                            alert(data.message);
                        }

                    }
                });
            });


            $(document).on('keyup mouseup', '.amount', function () {
                $this = $(this);
                input_number($this);
            });


            $('#checkReference').on('submit', function (e) {
                e.preventDefault();
                $this = $(this);
                var form_apotek = $('.form-apotek');
                $.ajax({
                    url: '/apotek/search-reference',
                    type: 'POST',
                    data: $this.serialize(),
                    success: function (data) {
                        var patient = data.data.register.patient;
                        form_apotek.find('#reference_id').val(data.data.id);
                        form_apotek.find('#full_name').val(patient.full_name).prop('disabled', true);
                        form_apotek.find('#gender option[value="' + patient.gender + '"]').prop('selected', true);
                        form_apotek.find('#gender').prop('disabled', true);
                        form_apotek.find('#phone_number').val(patient.phone_number).prop('disabled', true);
                        form_apotek.find('#address').text(patient.address).prop('disabled', true);
                    }
                })
            });

            $('.btn-tuslah').on('click', function () {
                var table = $('.table-tuslah');
                table.prop('hidden', false);
                var tr = '<tr>' +
                    '<td><button class="btn btn-primary btn-minus"><i class="fa fa-minus"></i></button></td>' +
                    '<td><select class="form-control select-tuslah" name="name_tuslah[]">' +
                    '<option>--Pilih Tipe--</option>' +
                    '<option value="racik">Biaya Racik</option>' +
                    '<option value="lainnya">Lainnya</option>' +
                    '</select></td>' +
                    '<td><input class="form-control amount" type="number" min="1" name="tuslah[]"></td>' +
                    '<td></td>' +
                    '<td class="sum-amount"></td>' +
                    '</tr>';
                table.find('tbody').append(tr);
            });


            $(document).on('change', '.select-tuslah', function () {
                $this = $(this);
                var td = $this.parent();
                var tr = $this.closest('tr');
                var value = $this.val();
                if (value == 'lainnya') {
                    $this.remove();
                    td.append('<input type="text" class="form-control" name="name_tuslah[]">');
                    var input = '<input type="number" name="price[]" min="1" class="form-control price">'
                    tr.find('td:eq(3)').html(input);
                } else if (value == 'racik') {
                    $.get('/apotek/biaya-racik', function( data ) {
                        var td3 = tr.find('td:eq(3)');
                        td3.html(data);
                        td3.append('<input type="hidden" name="price[]" value="'+data+'">')
                    });
                } else{
                    tr.find('td:eq(3)').html('');
                }
            });

            $(document).on('keyup mouseup', '.price', function () {
                $this = $(this);
                var value = $this.val();
                var tr = $this.closest('tr');
                var input_value = parseFloat(tr.find('td:eq(2)').find('input').val());
                var result = input_value * value;
                tr.find('td:eq(4)').html(result);
                updateTotal($this.closest('table'))
            });

        });
    </script>
@endsection