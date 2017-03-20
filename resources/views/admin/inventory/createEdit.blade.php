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
                          action="{{url('/admin/inventory/post')}}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="inventory_id" value="{{$inventory ? $inventory->id : ''}}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Kode Produk</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="code" value="{{$inventory ? $inventory->code : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Nama</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="name" value="{{$inventory ? $inventory->name : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Kategori</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="category">
                                            @foreach(getCategories() as $category)
                                                <option value="{{$category}}" {{$inventory && ($inventory->category == $category) ? 'selected' : ''}}>{{$category}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Tipe</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="type" value="{{$inventory ? $inventory->type : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Total</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="total" value="{{$inventory ? $inventory->total : ''}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Stok Minimal</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="stock_minimal" value="{{$inventory ? $inventory->stock_minimal : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Stok Maksimal</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="stock_maximal" value="{{$inventory ? $inventory->stock_maximal : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Satuan</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="unit">
                                            @foreach(getUnits() as $unit)
                                                <option value="{{$unit}}" {{$inventory && ($inventory->unit == $unit) ? 'selected' : ''}}>{{$unit}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Sediaan</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="sediaan">
                                            @foreach(getSediaans() as $sediaan)
                                                <option value="{{$sediaan}}" {{$inventory && ($inventory->sediaan == $sediaan) ? 'selected' : ''}}>{{$sediaan}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Keterangan</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" name="explain">{{$inventory ? $inventory->explain : ''}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
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