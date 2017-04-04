@extends('layouts.app')
@section('css')
    <style type="text/css">
        #service-table, .table-condition {
            table-layout: fixed;
            word-wrap: break-word;
        }

        table.table-condition tbody tr td {
            border: none;
        }

        span.select2-container {
            z-index: 10050;
        }

        .icd10 {
            width: 400% !important;
        }

        .datepicker {
            z-index: 10050 !important;
        }

        table.table-no-border {
            table-layout: fixed;
        }

        table.table-no-border tbody tr td, table.table-no-border tbody tr th {
            border: none;
        }

        table.table-info tbody tr td{
            border: none;
        }

        .rs-border {
            position: absolute;
            border-style: solid;
            border-width: 1px;
            text-align: center;
            font-family: arial;
            font-size: 11px;
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="container" style="text-align: justify">
        <div class="ui breadcrumb">
            <div class="section">Penata Jasa</div>
            <div class="divider"> / </div>
            <div class="active section">Periksa</div>
        </div><br/>
        <hr/>

        <form method="post" action="{{url('/penata-jasa/periksa')}}">
            {{csrf_field()}}
            <input type="hidden" name="reference_id" value="{{$reference->id}}">
            <input type="hidden" name="remove_ids" id="remove-ids">
            <input type="hidden" name="kiosk_id" value="{{$id}}">
            <table class="table table-info">
                <tbody>
                <tr>
                    <td>No. Rm</td>
                    <td style="width: 10px">:</td>
                    <td>{{$reference->register->patient->number_medical_record}}</td>
                </tr>
                <tr>
                    <td>Nama Lengkap</td>
                    <td>:</td>
                    <td>{{$reference->register->patient->full_name}}</td>
                </tr>
                <tr>
                    <td>TTL / Umur</td>
                    <td>:</td>
                    <td>{{$reference->register->patient->place}}, {{$reference->register->patient->birth}}
                        / {{$reference->register->patient->age}} Tahun
                    </td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{$reference->register->patient->gender == 'male' ? 'Laki-laki' : 'Perempuan'}}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{$reference->register->patient->address}}</td>
                </tr>
                <tr>
                    <td>No Hp</td>
                    <td>:</td>
                    <td>{{$reference->register->patient->phone_number}}</td>
                </tr>
                <tr>
                    <td>Dokter</td>
                    <td>:</td>
                    <td>
                        <select name="doctor" class="form-control">
                            @foreach($reference->poly->doctors as $doctor)
                                <option value="{{$doctor->id}}" {{$doctor->id == $reference->staff_id ? 'selected' : ''}}>{{$doctor->full_name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                </tbody>
            </table>

            <h3>Tambah Tindakan</h3>
            <button class="btn btn-primary btn-plus" type="button"><i class="fa fa-plus"></i></button>
            <table class="table service-table" id="service-table">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Layanan</th>
                    <th>Biaya Layanan</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                @forelse($reference->medicalRecords->where('type', \Illuminate\Support\Facades\Auth::user()->roles()->first()->name) as $index => $medicalRecord)
                    <tr class="{{$index == 0 ? 'clone' : ''}}">
                        <input type="hidden" name="mr_id[]" value="{{$medicalRecord->id}}">
                        <td>{{$index + 1}} @if($index != 0) <a href="javascript:;" type="button"
                                                               class="btn-minus"
                                                               data-id="{{$medicalRecord->id}}"><i
                                        class="fa fa-minus"></i></a> @endif </td>
                        <td>
                            <select name="service[]" class="select-service form-control">
                                <option></option>
                                @foreach($services as $service)
                                    <option value="{{$service->id}}" {{$medicalRecord->service_id == $service->id ? 'selected' : ''}}>{{$service->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="cost">{{$medicalRecord->cost}}</td>
                        <td><input type="number" placeholder="jumlah" name="quantity[]"
                                   class="amount form-control"
                                   value="{{$medicalRecord->quantity}}">
                        </td>
                        <td class="total-amount">{{$medicalRecord->cost * $medicalRecord->quantity}}</td>
                    </tr>
                @empty
                    <tr class="clone">
                        <input type="hidden" name="mr_id[]" value="">
                        <td>1</td>
                        <td>
                            <select name="service[]" class="select-service form-control">
                                <option></option>
                                @foreach($services as $service)
                                    <option value="{{$service->id}}">{{$service->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="cost"></td>
                        <td><input type="number" min="0" placeholder="jumlah" name="quantity[]"
                                   class="amount form-control">
                        </td>
                        <td class="total-amount"></td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="4">Total Pembayaran</th>
                    <th class="sub-total">{{$total_payment}}</th>
                </tr>
                </tfoot>
            </table>


            <h3>Kondisi Akhir</h3>
            <table class="table table-condition">
                <tbody>
                <tr>
                    <td>
                        <select name="final_result" class="form-control condition" required>
                            <option>-</option>
                            @foreach(getConditions() as $condition)
                                <option value="{{$condition}}">{{$condition}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="poly" class="form-control poly" style="display: none" required
                                disabled>
                            <option></option>
                            @foreach($polies as $poly)
                                <option value="{{$poly->id}}">{{$poly->name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Catatan :
                        <textarea name="notes" class="form-control"></textarea>
                    </td>
                </tr>
                </tbody>
            </table>


            <div class="text-right">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

{{--
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Form Pemeriksaan</h5>
                    <div class="text-right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#printModal"><i class="fa fa-print"></i> Surat Izin
                        </button>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                            Medical Record Pasien
                        </button>
                    </div>
                </div>
                <div class="ibox-content">
                    <form method="post" action="{{url('/penata-jasa/periksa')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="reference_id" value="{{$reference->id}}">
                        <input type="hidden" name="remove_ids" id="remove-ids">
                        <input type="hidden" name="kiosk_id" value="{{$id}}">
                        <table class="table table-info">
                            <tbody>
                            <tr>
                                <td>No. Rm</td>
                                <td style="width: 10px">:</td>
                                <td>{{$reference->register->patient->number_medical_record}}</td>
                            </tr>
                            <tr>
                                <td>Nama Lengkap</td>
                                <td>:</td>
                                <td>{{$reference->register->patient->full_name}}</td>
                            </tr>
                            <tr>
                                <td>TTL / Umur</td>
                                <td>:</td>
                                <td>{{$reference->register->patient->place}}, {{$reference->register->patient->birth}}
                                    / {{$reference->register->patient->age}} Tahun
                                </td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td>{{$reference->register->patient->gender == 'male' ? 'Laki-laki' : 'Perempuan'}}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{$reference->register->patient->address}}</td>
                            </tr>
                            <tr>
                                <td>No Hp</td>
                                <td>:</td>
                                <td>{{$reference->register->patient->phone_number}}</td>
                            </tr>
                            <tr>
                                <td>Dokter</td>
                                <td>:</td>
                                <td>
                                    <select name="doctor" class="form-control">
                                        @foreach($reference->poly->doctors as $doctor)
                                            <option value="{{$doctor->id}}" {{$doctor->id == $reference->staff_id ? 'selected' : ''}}>{{$doctor->full_name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <h3>Tambah Tindakan</h3>
                        <button class="btn btn-primary btn-plus" type="button"><i class="fa fa-plus"></i></button>
                        <table class="table service-table" id="service-table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Layanan</th>
                                <th>Biaya Layanan</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($reference->medicalRecords->where('type', \Illuminate\Support\Facades\Auth::user()->roles()->first()->name) as $index => $medicalRecord)
                                <tr class="{{$index == 0 ? 'clone' : ''}}">
                                    <input type="hidden" name="mr_id[]" value="{{$medicalRecord->id}}">
                                    <td>{{$index + 1}} @if($index != 0) <a href="javascript:;" type="button"
                                                                           class="btn-minus"
                                                                           data-id="{{$medicalRecord->id}}"><i
                                                    class="fa fa-minus"></i></a> @endif </td>
                                    <td>
                                        <select name="service[]" class="select-service form-control">
                                            <option></option>
                                            @foreach($services as $service)
                                                <option value="{{$service->id}}" {{$medicalRecord->service_id == $service->id ? 'selected' : ''}}>{{$service->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="cost">{{$medicalRecord->cost}}</td>
                                    <td><input type="number" placeholder="jumlah" name="quantity[]"
                                               class="amount form-control"
                                               value="{{$medicalRecord->quantity}}">
                                    </td>
                                    <td class="total-amount">{{$medicalRecord->cost * $medicalRecord->quantity}}</td>
                                </tr>
                            @empty
                                <tr class="clone">
                                    <input type="hidden" name="mr_id[]" value="">
                                    <td>1</td>
                                    <td>
                                        <select name="service[]" class="select-service form-control">
                                            <option></option>
                                            @foreach($services as $service)
                                                <option value="{{$service->id}}">{{$service->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="cost"></td>
                                    <td><input type="number" min="0" placeholder="jumlah" name="quantity[]"
                                               class="amount form-control">
                                    </td>
                                    <td class="total-amount"></td>
                                </tr>
                            @endforelse
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="4">Total Pembayaran</th>
                                <th class="sub-total">{{$total_payment}}</th>
                            </tr>
                            </tfoot>
                        </table>


                        <h3>Kondisi Akhir</h3>
                        <table class="table table-condition">
                            <tbody>
                            <tr>
                                <td>
                                    <select name="final_result" class="form-control condition" required>
                                        <option>-</option>
                                        @foreach(getConditions() as $condition)
                                            <option value="{{$condition}}">{{$condition}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="poly" class="form-control poly" style="display: none" required
                                            disabled>
                                        <option></option>
                                        @foreach($polies as $poly)
                                            <option value="{{$poly->id}}">{{$poly->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Catatan :
                                    <textarea name="notes" class="form-control"></textarea>
                                </td>
                            </tr>
                            </tbody>
                        </table>


                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
--}}


    <!-- myModal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal" style="overflow:hidden;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Medical Record Pasien</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        {{csrf_field()}}
                        <input type="hidden" name="reference_id" value="{{$reference->id}}">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Anamnesa</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="anamnesa"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Diagnosa</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="diagnosis"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="explain"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Terapi/Resep</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="therapy"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">ICD10</label>
                            <div class="col-sm-10">
                                <select class="icd10 form-control" name="icd10[]" multiple>
                                    @foreach($icd10s as $icd10)
                                        <option value="{{$icd10->code}}">{{$icd10->code}} - {{$icd10->desc}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                    <button type="button" class="btn btn-primary" id="btn-submit">Simpan</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- printModal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="printModal" style="overflow:hidden;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Print Surat Izin Sakit Pasien</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" name="patient_id" value="{{$reference->register->patient->id}}">
                        <table class="table table-no-border">
                            <tbody>
                            <tr>
                                <th width="30%">Nama</th>
                                <td width="5%">:</td>
                                <td>{{$reference->register->patient->full_name}}</td>
                            </tr>
                            <tr>
                                <th>Umur</th>
                                <td>:</td>
                                <td>{{$reference->register->patient->age}}
                                    <Tahun></Tahun>
                                </td>
                            </tr>
                            <tr>
                                <th>Pekerjaan</th>
                                <td>:</td>
                                <td>{{$reference->register->patient->job}}
                                    <Tahun></Tahun>
                                </td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>:</td>
                                <td>{{$reference->register->patient->address}}
                                    <Tahun></Tahun>
                                </td>
                            </tr>
                            <tr>
                                <th>Dari / Sampai</th>
                                <td>:</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input class="form-control datepicker datepicker-link-start" name="from">
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control datepicker datepicker-link-end" name="until">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="btn-print">Print Surat</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function addAmount() {
            var trs = $('.service-table tbody').find('tr');
            var sum_amount = 0;
            trs.each(function (index, value) {
                var amount = $(this).find('.amount').val();
                var cost = $(this).find('.cost').text();
                var sum;
                if (!isNaN(amount) && !isNaN(cost)) {
                    sum = amount * cost;
                }
                $(this).find('.total-amount').html(sum);
                sum_amount = sum_amount + sum;
            });
            $('.sub-total').html(sum_amount);
        }

        $(document).ready(function () {
            var d = new Date();
            var month = d.getMonth()+1;
            var day = d.getDate();
            var now_time = d.getFullYear() + '-' +
                ((''+month).length<2 ? '0' : '') + month + '-' +
                ((''+day).length<2 ? '0' : '') + day;


            $('.datepicker').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'yyyy-mm-dd',
                startDate: now_time
            });

/*            $('.icd10').select2({
                dropdownParent: $("#myModal")
            });*/
            $(document).on('click', '.btn-plus', function () {
                var count_row = $('.service-table tbody').find('tr').length + 1;
                var tr = $('.clone').clone(true);
                tr.find('input').val('');
                tr.find('option:selected').prop("selected", false)
                tr.removeClass('clone');
                var td1 = tr.find('td:eq(0)');
                var td2 = tr.find('td:eq(2)').html('');
                var td2 = tr.find('td:eq(4)').html('');
                var btn_minus = '<a href="javascript:;" type="button" class="btn-minus"><i class="fa fa-minus"></i></a>';
                td1.html(count_row + " " + btn_minus);
                $('.service-table tbody').append(tr);
            });

            $(document).on('change', '.select-service', function () {
                $this = $(this);
                var row = $this.closest('tr');
                row.find('.amount').prop('required', true);
                $.ajax({
                    url: '/penata-jasa/select-service',
                    type: 'POST',
                    data: {_token: $('meta[name="csrf-token"]').attr('content'), id: $this.val()},
                    success: function (data) {
                        if (data.is_success) {
                            row.find('td:eq(2)').html(data.data.cost);
                            addAmount();
                        } else {
                            alert(data.message)
                        }
                    }
                })
            });

            $(document).on('keyup mouseup', '.amount', function () {
                $this = $(this);
                var row = $this.closest('tr');
                var cost = row.find('td:eq(2)').text();
                var tds = $this.closest('tbody').find('.total-amount');
                if (!isNaN($this.val()) && (cost != '')) {
                    var total = cost * $this.val();
                    row.find('td:eq(4)').html(total);
                    var sum_amount = 0;
                    tds.each(function () {
                        var tdTxt = $(this).text();
                        if ($(this).hasClass('total')) {
                            $(this).text(temp);
                            sum_amount = 0;
                        } else {
                            sum_amount += parseFloat(tdTxt);
                        }

                    });
                    $('.sub-total').html(sum_amount);
                }
            });

            var ids = [];
            $(document).on('click', '.btn-minus', function () {
                $this = $(this);
                var id = $this.data('id');
                if (id) {
                    ids.push(id)
                }
                $('#remove-ids').val(ids);
                var tr = $this.closest('tr');
                var amount = parseFloat(tr.find('.total-amount').text());
                var sub_total = parseFloat($('.sub-total').text());
                var result = sub_total - amount;
                $('.sub-total').html(result);
                tr.remove();
            });

            $('.condition').on('change', function () {
                $this = $(this);
                var value = $this.val();
                if (value === "Dirujuk") {
                    $('.poly').prop('disabled', false).css('display', 'block');
                } else {
                    $('.poly').css('display', 'none').prop('disabled', true);
                }
            });


            $(document).on('click', '#btn-submit', function () {
                $this = $(this);
                $.ajax({
                    url: '/penata-jasa/tambah/medical-record',
                    data: $this.parent().prev().find('form').serialize(),
                    type: 'POST',
                    success: function (data) {
                        console.log(data);
                        if (data.isSuccess) {

                        } else {
                            alert(data.message);
                        }
                        $('#myModal').modal('hide')
                    }
                })
            });

            $(document).on('click', '#btn-print', function (e) {
                e.preventDefault();
                $this = $(this);
                var form = $this.parent().prev().find('form').serialize();
                var url = '/penata-jasa/print-letter?' + form;
                window.open(url);
                $('#printModal').find('form').trigger('reset');
                $('#printModal').modal('hide');
            });

        });
    </script>
@endsection