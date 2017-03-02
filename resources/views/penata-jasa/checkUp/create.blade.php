@extends('layouts.app')
@section('css')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Form Pemeriksaan</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a>
                            </li>
                            <li><a href="#">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table">
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
                                <select name="doctor">
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
                    <table class="table service-table">
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
                        <tr class="clone">
                            <td>1</td>
                            <td>
                                <select name="service" class="select-service">
                                    <option>-</option>
                                    @foreach($services as $service)
                                        <option value="{{$service->id}}">{{$service->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="cost"></td>
                            <td><input type="text" placeholder="jumlah" name="amount" class="amount"></td>
                            <td class="total-amount"></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="4">Total Pembayaran</th>
                            <th class="sub-total"></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
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
                if(!isNaN(amount) && !isNaN(cost)){
                    sum = amount * cost;
                }
                $(this).find('.total-amount').html(sum);
                sum_amount = sum_amount + sum;
            });
            $('.sub-total').html(sum_amount);
        }
        
        
        $(document).ready(function () {
            $(document).on('click','.btn-plus', function () {
                var count_row = $('.service-table tbody').find('tr').length + 1;
                var tr = $('.clone').clone(true);
                tr.find('input').val('');
                tr.removeClass('clone');
                var td1 = tr.find('td:eq(0)');
                var td2 = tr.find('td:eq(2)').html('');
                var td2 = tr.find('td:eq(4)').html('');
                var btn_minus = '<a href="javascript:;" type="button" class="btn-minus"><i class="fa fa-minus"></i></a>';
                td1.html(count_row +" "+ btn_minus);
                $('.service-table tbody').append(tr);
            });

            $(document).on('change', '.select-service', function () {
                $this = $(this);
                var row = $this.closest('tr');
                $.ajax({
                    url: '/penata-jasa/select-service',
                    type: 'POST',
                    data: {_token: $('meta[name="csrf-token"]').attr('content'), id: $this.val()},
                    success: function (data) {
                        if(data.is_success){
                            row.find('td:eq(2)').html(data.data.cost);
                            addAmount();
                        }else{
                            alert(data.message)
                        }
                    }
                })
            });

            $(document).on('keyup', '.amount', function () {
                $this = $(this);
                var row = $this.closest('tr');
                var cost = row.find('td:eq(2)').text();
                var tds = $this.closest('tbody').find('.total-amount');
                if(!isNaN($this.val()) && (cost != '')){
                    var total = cost * $this.val();
                    row.find('td:eq(4)').html(total);
                    var sum_amount = 0;
                    tds.each(function(){
                        var tdTxt = $(this).text();
                        if($(this).hasClass('total')) {
                            $(this).text(temp);
                            sum_amount = 0;
                        } else {
                            sum_amount+= parseFloat(tdTxt);
                        }

                    });
                    $('.sub-total').html(sum_amount);
                }
            });

            $(document).on('click', '.btn-minus', function () {
                $this = $(this);
                var tr = $this.closest('tr');
                var amount = parseFloat(tr.find('.total-amount').text());
                var sub_total = parseFloat($('.sub-total').text());
                var result = sub_total - amount;
                $('.sub-total').html(result);
                tr.remove();
            })
        });
    </script>
@endsection