@extends('layouts.app')
@section('css')
    <style type="text/css">
        table.table-border tbody tr td {
            border-bottom: 1px solid #e7eaec;
        }

        table.table-border tbody tr td:first-child {
            border-left: 1px solid #e7eaec;
        }

        table.table-border tbody tr td:last-child {
            border-right: 1px solid #e7eaec;
        }

    </style>
@endsection
@section('breadcrumb')
    <li>
        <a href="{{url('/admin/setting')}}">Setting</a>
    </li>
    <li class="active">
        <strong>Tambah</strong>
    </li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><i class="fa fa-angle-right"></i> Setting <i
                                class="fa fa-angle-right"></i> Tambah / Ubah</h5>
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

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{url('/admin/setting/modify')}}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @if($setting)
                                <input type="hidden" name="setting_id" value="{{$setting->id}}">
                            @endif

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="tindakan" class="col-md-4 control-label">Name <span
                                            class="error">*</span></label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ $setting ? $setting->name :''}}" placeholder="Name" required
                                           autofocus>


                                    <form class="form-horizontal" role="form" method="POST"
                                          action="{{url('/admin/setting/modify')}}"
                                          enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <div class="action">
                                                <button class="btn btn-primary btn-add-setting" type="button"><i
                                                            class="fa fa-plus"></i>
                                                    Setting
                                                </button>
                                                <div style="display: none" class="col-md-4 for-clone">
                                                    <h4><span class="span-setting">Setting 1</span> <a type="button"
                                                                                                       href="javascript:;"
                                                                                                       class="btn btn-remove-setting"><i
                                                                    class="fa fa-minus"></i></a></h4>
                                                    <table class="table table-border">
                                                        <tbody>
                                                        <tr>
                                                            <td><input type="text" class="form-control setting-name"
                                                                       placeholder="name">
                                                            </td>
                                                            <td>:</td>
                                                            <td><input type="text" class="form-control setting-value"
                                                                       placeholder="value"></td>
                                                            <td>
                                                                <button class="btn btn-primary btn-add-field"
                                                                        type="button"><i
                                                                            class="fa fa-plus"></i></button>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            @forelse($settings as $index => $setting)
                                                <div class="col-md-4">
                                                    <h4>Setting {{$index + 1}} <a type="button" href="javascript:;"
                                                                                  class="btn btn-remove-setting"><i
                                                                    class="fa fa-minus"></i></a></h4>
                                                    <table class="table table-border">
                                                        <tbody>
                                                        @forelse($setting->name_value as $index_name_value =>  $item)
                                                            @foreach($item as $name => $value)
                                                                <tr>
                                                                    <td><input type="text"
                                                                               class="form-control setting-name"
                                                                               placeholder="name"
                                                                               name="setting_{{$index + 1}}_name[]"
                                                                               value="{{$name}}">
                                                                    </td>
                                                                    <td>:</td>
                                                                    <td><input type="text"
                                                                               class="form-control setting-value"
                                                                               placeholder="value"
                                                                               name="setting_{{$index + 1}}_value[]"
                                                                               value="{{$value}}">
                                                                    </td>
                                                                    <td>
                                                                        @if($index_name_value == 0)
                                                                            <button class="btn btn-primary btn-add-field"
                                                                                    type="button">
                                                                                <i class="fa fa-plus"></i></button>
                                                                        @else
                                                                            <button class="btn btn-primary btn-remove-field"
                                                                                    type="button">
                                                                                <i class="fa fa-minus"></i></button>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @empty
                                                            <tr>
                                                                <td><input type="text" class="form-control setting-name"
                                                                           placeholder="name"
                                                                           name="setting_1_name[]"></td>
                                                                <td>:</td>
                                                                <td><input type="text"
                                                                           class="form-control setting-value"
                                                                           placeholder="value" name="setting_1_value[]">
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-primary btn-add-field"
                                                                            type="button"><i
                                                                                class="fa fa-plus"></i></button>
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @empty
                                                <div class="col-md-4">
                                                    <h4>Setting 1 <a type="button" href="javascript:;"
                                                                     class="btn btn-remove-setting"><i
                                                                    class="fa fa-minus"></i></a></h4>
                                                    <table class="table table-border">
                                                        <tbody>
                                                        <tr>
                                                            <td><input type="text" class="form-control setting-name"
                                                                       placeholder="name"
                                                                       name="setting_1_name[]"></td>
                                                            <td>:</td>
                                                            <td><input type="text" class="form-control setting-value"
                                                                       placeholder="value" name="setting_1_value[]">
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-primary btn-add-field"
                                                                        type="button"><i
                                                                            class="fa fa-plus"></i></button>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <p class="error"> (*) mohon untuk di isi </p>
                                            @endforelse
                                        </div>
                                    </form>
                                    <div class="form-group">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary">
                                                Submit
                                            </button>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            @endsection
                            @section('scripts')
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $(document).on('click', '.btn-add-field', function () {
                                            $this = $(this);
                                            var tr = $this.closest('tr').clone();
                                            tr.find('.fa').removeClass('fa-plus').addClass('fa-minus');
                                            tr.find('button').removeClass('btn-add-field').addClass('btn-remove-field');
                                            tr.find('input').val('');
                                            $this.closest('tbody').append(tr);
                                        });

                                        $(document).on('click', '.btn-remove-field', function () {
                                            $this = $(this);
                                            $this.closest('tr').remove();
                                        });

                                        $('.btn-add-setting').on('click', function () {
                                            $this = $(this);
                                            var total_md4 = $this.parent().parent().find('.col-md-4').length;
                                            var cloned = $('.for-clone').clone();
                                            cloned.removeClass('for-clone');
                                            cloned.css('display', 'block');
                                            cloned.find('.span-setting').html('Setting ' + total_md4);
                                            cloned.find('.setting-name').attr('name', 'setting_' + total_md4 + '_name[]');
                                            cloned.find('.setting-value').attr('name', 'setting_' + total_md4 + '_value[]');
                                            $this.parent().parent().append(cloned);
                                        });


                                        $(document).on('click', '.btn-remove-setting', function () {
                                            $this = $(this);
                                            $this.closest('.col-md-4').remove();
                                        });
                                    });
                                </script>
@endsection