@extends('layouts.app')
@section('css')
    <style>
        .error {
            color: #FF0000;
        }
    </style>
@endsection

@section('content')
    <div class="container" style="text-align: justify">
        <div class="ui breadcrumb">
            <div class="section">{{ucfirst($role)}}</div>
            <div class="divider"> / </div>
            <div class="active section">Obat</div>
            <div class="divider"> / </div>
            <div class="active section">Tambah</div>
        </div><br/>
        <hr/>
        <form class="form-horizontal" role="form" method="POST"
              action="{{url('/'.$role.'/inventory/post')}}"
              enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="inventory_id" value="{{$inventory ? $inventory->id : ''}}">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Kode Produk <span class="error">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="code"
                                   value="{{$inventory ? $inventory->code : ''}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nama <span class="error">*</span> </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="name"
                                   value="{{$inventory ? $inventory->name : ''}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Kategori <span class="error">*</span> </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" value="Medis" disabled>
                            <input type="hidden" name="category" value="Medis">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Tipe <span class="error">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="type"
                                   value="{{$inventory ? $inventory->type : ''}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Total <span class="error">*</span></label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="total"
                                   value="{{$inventory ? $inventory->total : ''}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Stok Minimal<span class="error">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="stock_minimal"
                                   value="{{$inventory ? $inventory->stock_minimal : ''}}" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Stok Maksimal<span class="error">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="stock_maximal"
                                   value="{{$inventory ? $inventory->stock_maximal : ''}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Satuan <span class="error">*</span></label>
                        <div class="col-sm-8">
                            <select class="form-control" name="unit" required>
                                @foreach(getUnits() as $unit)
                                    <option value="{{$unit}}" {{$inventory && ($inventory->unit == $unit) ? 'selected' : ''}}>{{$unit}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Sediaan <span class="error">*</span></label>
                        <div class="col-sm-8">
                            <select class="form-control" name="sediaan" required>
                                @foreach(getSediaans() as $sediaan)
                                    <option value="{{$sediaan}}" {{$inventory && ($inventory->sediaan == $sediaan) ? 'selected' : ''}}>{{$sediaan}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Harga Satuan <span
                                    class="error">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="price"
                                   value="{{$inventory ? $inventory->price : ''}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Keterangan</label>
                        <div class="col-sm-8">
                                        <textarea class="form-control"
                                                  name="explain">{{$inventory ? $inventory->explain : ''}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <hr>
                <div class="col-md-6">
                    <h3>Tambah Batch</h3>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Kode Batch <span class="error">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="batch_code" required>
                        </div>
                    </div>
                    @if($inventory)
                        <div class="form-group" {{$inventory ? '' : 'hidden'}}>
                            <label class="col-sm-4 control-label">Stock <span class="error">*</span>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control datepicker" name="stock"
                                       required {{$inventory ? '' : 'disabled'}}>
                            </div>
                        </div>
                    @endif
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Expired Date <span class="error">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control datepicker" name="expired_date" required>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>History Batch</h3>
                    <table id="table-history-batch" class="table datatables">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Stok</th>
                            <th>Expired Date</th>
                            <th>Tanggal Penambahan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($inventory)
                            @forelse($inventory->batches as $index => $batch)
                                <tr>
                                    <td>{{$index + 1}}</td>
                                    <td>{{$batch->code}}</td>
                                    <td>{{$batch->stock}}</td>
                                    <td>{{$batch->expired_date}}</td>
                                    <td>{{$batch->created_at}}</td>
                                </tr>
                            @empty
                            @endforelse
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </form>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $('#table-history-batch').dataTable();

        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        });
        $(document).ready(function () {

        });
    </script>
@endsection