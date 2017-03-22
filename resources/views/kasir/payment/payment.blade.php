@extends('layouts.app')
@section('css')
    <style type="text/css">
        .table-payment {
            table-layout: fixed;
            word-wrap: break-word;
        }

        .hiddenRow {
            padding: 0 !important;
            background-color: #ececec;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Informasi Pembayaran</h5>
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
                    <div class="row">
                        <div class="col-md-6">
                            <dl class="dl-horizontal">
                                <dt>No RM : </dt>
                                <dd>{{$patient->number_medical_record}}</dd>
                                <dt>Nama Pasien : </dt>
                                <dd>{{$patient->full_name}}</dd>
                                {{--<dt>TTL : </dt>--}}
                                {{--<dd>{{$patient->place}} / {{$patient->birth}}</dd>--}}
                                <dt>Umur : </dt>
                                <dd>{{$patient->age}}</dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl class="dl-horizontal">
                                <dt>No Askes / Jamkesmas : </dt>
                                <dd>{{$patient->askes_number}}</dd>
                                <dt>Jenis Kelamin : </dt>
                                <dd>{{$patient->gender == 'male' ? 'Laki-laki' : 'Perempuan'}}</dd>
                                <dt>No Telp : </dt>
                                <dd>{{$patient->phone_number}}</dd>
                                <dt>No Askes / Jamkesmas : </dt>
                                <dd>{{$patient->askes_number}}</dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{url('/kasir/pembayaran')}}">
                                {{csrf_field()}}
                                <table class="table table-payment">
                                    <thead>
                                    <tr>
                                        <th style="width: 50px">No</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Total Pembayaran</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($payments as $index => $payment)
                                        <tr>
                                            <td>{{$index +1}}</td>
                                            <td>{{$payment->type == 'doctor_service' ? 'Jasa Dokter' : 'Pembayaran Jasa '.$payment->reference->poly->name}}</td>
                                            <td class="amount">{{$payment->total}}</td>
                                            <td>
                                                <input type="checkbox"
                                                       class="check-payment"
                                                       name="{{$payment->id}}" {{$payment->status == 2 ? 'checked disabled' : ''}}>Dibayar
                                                @if($payment->reference)
                                                    | <button type="button"
                                                            class="btn btn-primary btn-sm accordion-toggle"
                                                            data-toggle="collapse" data-target=".demo{{$index}}"><i
                                                                class="fa fa-info"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                        @if($payment->reference)
                                            <tr>
                                                <th class="hiddenRow">
                                                    <div class="accordian-body collapse demo{{$index}}"></div>
                                                </th>
                                                <th class="hiddenRow">
                                                    <div class="accordian-body collapse demo{{$index}}">Nama Tindakan
                                                    </div>
                                                </th>
                                                <th class="hiddenRow">
                                                    <div class="accordian-body collapse demo{{$index}}">Jumlah Tindakan
                                                        / Harga Per Tindakan
                                                    </div>
                                                </th>
                                                <th class="hiddenRow">
                                                    <div class="accordian-body collapse demo{{$index}}">Total</div>
                                                </th>
                                            </tr>
                                            @foreach($payment->reference->medicalRecords->where('type', '!=', 'medical_record') as $index_mr => $medicalRecord)
                                                <tr>
                                                    <td class="hiddenRow">
                                                        <div class="accordian-body collapse demo{{$index}}"></div>
                                                    </td>
                                                    <td class="hiddenRow">
                                                        <div class="accordian-body collapse demo{{$index}}">{{$medicalRecord->service->name}}</div>
                                                    </td>
                                                    <td class="hiddenRow">
                                                        <div class="accordian-body collapse demo{{$index}}">{{$medicalRecord->quantity}}
                                                            x Tindakan / Rp.{{$medicalRecord->service->cost}}</div>
                                                    </td>
                                                    <td class="hiddenRow">
                                                        <div class="accordian-body collapse demo{{$index}}">
                                                            Rp.{{$medicalRecord->total_sum}}</div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    @endforeach
                                    <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>@if($remaining != 0)Sisa Pembayaran : Rp.<span
                                                    class="remaining">{{$remaining}}@endif</span></th>
                                        <th class="text-right">Total : Rp.{{$total_payment}}</th>
                                        <th><input type="checkbox"
                                                   class="full_payment" {{$remaining == 0 ? 'checked disabled' : ''}}>Lunas
                                        </th>
                                    </tr>
                                    </tfoot>
                                </table>
                                @if($remaining != 0)
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function changePrice($this) {
            var value = parseFloat($this.parent().prev().text());
            var remaining = $('.remaining');
            var remaining_value = parseFloat(remaining.text());
            var total = 0;
            if ($this.is(':checked')) {
                var total = remaining_value - value;
            } else {
                var total = remaining_value + value;
            }

            remaining.html(total);
        }

        $(document).on('change', '.full_payment', function () {
            $this = $(this);
            var checkboxs = $('.table-payment tbody').find('input[type="checkbox"]');
            var tds = checkboxs.parent().prev();
            var remaining = $('.remaining');
            var remaining_amount = parseFloat(remaining.text());
            if ($this.is(':checked')) {
                var amount = 0;
                tds.each(function (index, value) {
                    amount += parseFloat(value.textContent)
                });
                var result = remaining_amount - amount;
                remaining.html(result);
                checkboxs.prop('checked', true);
            } else {
                var amount = 0;
                tds.each(function (index, value) {
                    amount += parseFloat(value.textContent)
                });
                var result = remaining_amount + amount;
                remaining.html(result);
                checkboxs.prop('checked', false);
            }
        });

        $(document).on('change', '.check-payment', function () {
            $this = $(this);
            var all_checkbox = $('.table-payment tbody').find('input[type="checkbox"]');
            var checkeds = $('.table-payment tbody').find('input[type="checkbox"]:checked');
            if (all_checkbox.length == checkeds.length) {
                $('.full_payment').prop('checked', true);
            } else {
                $('.full_payment').prop('checked', false);
            }
            changePrice($this)
        });
    </script>
@endsection