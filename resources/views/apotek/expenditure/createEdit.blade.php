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
                        <input type="hidden" name="inventory_id" value="{{$record_apotek ? $record_apotek->id : ''}}">

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Obat</label>
                            <div class="col-sm-8">
                                <select class="form-control">
                                    @foreach($inventories as $inventory)
                                        <option value="{{$inventory->id}}">{{$inventory->code}} / {{$inventory->name}} / {{$inventory->total}} {{$inventory->unit}}</option>
                                    @endforeach
                                </select>
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