@extends('layouts.app')
@section('css')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><i class="fa fa-angle-right"></i> Inventory </h5>
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
                                        <input class="form-control" value="Non Medis" disabled>
                                        <input type="hidden" name="category" value="Non Medis">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Tipe <span class="error">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="type"
                                               value="{{$inventory ? $inventory->type : ''}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Total <span class="error">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="total"
                                               value="{{$inventory ? $inventory->total : ''}}" required>
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
                            <div class="col-md-12">
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection