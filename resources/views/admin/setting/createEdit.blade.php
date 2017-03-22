@extends('layouts.app')
@section('css')
    <style type="text/css">
        table.borderless tbody tr td {
            border: none;
        }

        .padding-all {
            margin: 1px;
            border: 1px solid #e7eaec;
            border-radius: 5px;
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
                    <!-- BASIC FORM ELELEMNTS -->
                    <form class="form-horizontal" role="form" method="POST"
                          action="{{url('/admin/setting/modify')}}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="action">
                                <button class="btn btn-primary btn-add-setting" type="button"><i class="fa fa-plus"></i>
                                    Setting
                                </button>
                                <div class="col-md-4 border for-clone" hidden>
                                    <div class="padding-all">
                                        <table class="table borderless">
                                            <tbody>
                                            <tr>
                                            <tr>
                                                <td>
                                                    <input class="form-control setting-name" type="text"
                                                           placeholder="Nama Setting">
                                                </td>
                                                <td>
                                                    <a type="button" href="javascript:;"
                                                       class="btn btn-primary btn-remove-setting"><i
                                                                class="fa fa-minus"></i></a>
                                                </td>
                                            </tr>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-border">
                                            <tbody>
                                            <tr>
                                                <td><input type="text" class="form-control name" placeholder="name">
                                                </td>
                                                <td>:</td>
                                                <td><input type="text" class="form-control value"
                                                           placeholder="value"></td>
                                                <td>
                                                    <button class="btn btn-primary btn-add-field" type="button"><i
                                                                class="fa fa-plus"></i></button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            @forelse($settings as $index => $setting)
                                <div class="col-md-4 border">
                                    <div class="padding-all">
                                        <table class="table borderless">
                                            <tbody>
                                            <tr>
                                            <tr>
                                                <td>
                                                    <input class="form-control setting-name" type="text"
                                                           placeholder="Nama Setting" name="setting_name_{{$index}}"
                                                           value="{{$setting->name}}">
                                                </td>
                                                <td>
                                                    <a type="button" href="javascript:;"
                                                       class="btn btn-primary btn-remove-setting"><i
                                                                class="fa fa-minus"></i></a>
                                                </td>
                                            </tr>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-border">
                                            <tbody>
                                            @forelse($setting->name_value as $name => $value)
                                                <tr>
                                                    <td><input type="text" class="form-control setting-name"
                                                               placeholder="name" name="name_{{$index}}[]"
                                                               value="{{$name}}">
                                                    </td>
                                                    <td>:</td>
                                                    <td><input type="text" class="form-control setting-value"
                                                               placeholder="value" name="value_{{$index}}[]"
                                                               value="{{$value}}"></td>
                                                    <td>
                                                        @if($loop->index == 0)
                                                            <button class="btn btn-primary btn-add-field" type="button">
                                                                <i class="fa fa-plus"></i></button>
                                                        @else
                                                            <button class="btn btn-primary btn-remopve-field" type="button">
                                                                <i class="fa fa-plus"></i></button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td><input type="text" class="form-control setting-name"
                                                               placeholder="name" name="name_1[]">
                                                    </td>
                                                    <td>:</td>
                                                    <td><input type="text" class="form-control setting-value"
                                                               placeholder="value" name="value_1[]"></td>
                                                    <td>
                                                        <button class="btn btn-primary btn-add-field" type="button"><i
                                                                    class="fa fa-plus"></i></button>
                                                    </td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @empty
                                <div class="col-md-4 border">
                                    <div class="padding-all">
                                        <table class="table borderless">
                                            <tbody>
                                            <tr>
                                            <tr>
                                                <td>
                                                    <input class="form-control setting-name" type="text"
                                                           placeholder="Nama Setting" name="setting_name_1">
                                                </td>
                                                <td>
                                                    <a type="button" href="javascript:;"
                                                       class="btn btn-primary btn-remove-setting"><i
                                                                class="fa fa-minus"></i></a>
                                                </td>
                                            </tr>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-border">
                                            <tbody>
                                            <tr>
                                                <td><input type="text" class="form-control setting-name"
                                                           placeholder="name" name="name_1[]">
                                                </td>
                                                <td>:</td>
                                                <td><input type="text" class="form-control setting-value"
                                                           placeholder="value" name="value_1[]"></td>
                                                <td>
                                                    <button class="btn btn-primary btn-add-field" type="button"><i
                                                                class="fa fa-plus"></i></button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforelse
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
                cloned.prop('hidden', false);
                cloned.find('.setting-name').attr('name', 'setting_name_' + total_md4);
                cloned.find('.name').attr('name', 'name_' + total_md4 + '[]');
                cloned.find('.value').attr('name', 'value_' + total_md4 + '[]');
                $this.parent().parent().append(cloned);
            });


            $(document).on('click', '.btn-remove-setting', function () {
                $this = $(this);
                $this.closest('.col-md-4').remove();
            });
        });
    </script>
@endsection