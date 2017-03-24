(function ($, window, undefined) {
    var rs = {};
    moment.locale('id');

    rs.QueueTable = function ($element, listUrl, csrf, userId, role) {
        if (!$element.length) return null;
        return $element.DataTable({
            processing: true,
            serverSide: true,
            "deferRender": true,
            bFilter: false,
            bInfo: false,
            "ordering": false,
            "lengthChange": false,
            bPaginate: false,
            ajax: {
                'url': listUrl,
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': csrf
                }
            },
            dom: 'lBfrtip',
            buttons: [],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "columnDefs": [
                {"className": "dt-center", "targets": "_all"}
            ],
            columns: [
                {
                    data: 'queue_number',
                    name: 'queue_number',
                    "width": "5%"
                },
                {
                    data: 'status',
                    name: 'status',
                    "width": "30%",
                    "mRender": function (data) {
                        var status;
                        if (data == 1) {
                            status = '<span class="alert-success">Open</span>';
                        } else if (data == 2){
                            status = '<span class="alert-warning">Calling</span>';
                        } else if (data == 3){
                            status = '<span class="alert-warning">On Process</span>';
                        }

                        return status;
                    }
                },
                {
                    "data": '',
                    "defaultContent": '',
                    "mRender": function (data, type, row) {
                        var btn = '<a class="btn btn-primary btn-play" data-sound="' + row.location + '" data-id="'+row.id+'"><i class="fa fa-play"></i></a>';
                        var process = '<a href="/loket/pendaftaran/tambah?id=' + row.id + '" class="btn btn-primary btn-process"><i class="fa fa-sign-in"></i></a>';

                        if (role == 'penata-jasa') {
                            process = '<a href="/penata-jasa/periksa/' + row.reference_id + '" class="btn btn-primary btn-process"><i class="fa fa-check-square"></i></a>';
                        }

                        if ((row.status == 1) || (row.status == 2)) {
                            return btn + ' | ' + process;
                        } else {
                            if (row.staff_id == userId) {
                                return btn + ' | ' + process;
                            } else {
                                return '-'
                            }
                        }
                    }
                }
            ]
        });
    };

    rs.RegistrationTable = function ($element, listUrl, csrf) {
        if (!$element.length) return null;
        return $element.DataTable({
            processing: true,
            serverSide: true,
            "deferRender": true,
            ajax: {
                'url': listUrl,
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': csrf
                }
            },
            dom: 'lBfrtip',
            buttons: ['print'],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    "orderable": false,
                    "searchable": false
                },
                {data: 'register_number', name: 'register_number'},
                {data: 'patient.number_medical_record', name: 'patient.number_medical_record'},
                {data: 'patient.full_name', name: 'patient.full_name'},
                {data: 'patient.age', name: 'patient.age'},
                {
                    "data": 'status',
                    "defaultContent": '',
                    "orderable": true,
                    "searchable": false,
                    "mRender": function (data, type, row) {
                        var status = '';
                        if (data == 1 || data == "1") {
                            status = '<span class="alert-success">Open</span>'
                        }

                        return status;
                    }
                },
                {
                    "data": '',
                    "defaultContent": '',
                    "orderable": false,
                    "searchable": false,
                    "mRender": function (data, type, row) {
                        var reference = '<a href="/loket/pendaftaran/' + row.id + '/tambah-rujukan"><i class="fa fa-plus"></i> Rujukan</a>';
                        return reference;
                    }
                }
            ]
        });
    };

    rs.UserTable = function ($element, listUrl, csrf) {
        if (!$element.length) return null;
        return $element.DataTable({
            processing: true,
            serverSide: true,
            "deferRender": true,
            responsive: true,
            ajax: {
                'url': listUrl,
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': csrf
                }
            },
            dom: 'lBfrtip',
            "order": [[1, 'asc']],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    },
                    title: $('.print-datatable').attr('title')
                }
            ],
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    "orderable": false,
                    "searchable": false
                },
                {data: 'email', name: 'email'},
                {
                    data: 'roles[0].display_name', name: 'roles[0].display_name'
                },
                {
                    "data": '',
                    "defaultContent": '',
                    "orderable": false,
                    "searchable": false,
                    "mRender": function (data, type, row) {
                        var edit = '<a href="/admin/user/edit?id=' + row.id + '"><i class="fa fa-edit"></i></a>';
                        var remove = '<a href="javascript:;" class="btn-remove" data-id="' + row.id + '"><i class="fa fa-remove"></i></a>';
                        return edit + ' | ' + remove;
                    }
                }
            ]
        });
    };

    rs.RoleTable = function ($element, listUrl, csrf) {
        if (!$element.length) return null;
        return $element.DataTable({
            processing: true,
            serverSide: true,
            "deferRender": true,
            responsive: true,
            ajax: {
                'url': listUrl,
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': csrf
                }
            },
            dom: 'lBfrtip',
            "order": [[1, 'asc']],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    },
                    title: $('.print-datatable').attr('title')
                }
            ],
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    "orderable": false,
                    "searchable": false
                },
                {data: 'name', name: 'name'},
                {data: 'display_name', name: 'display_name'},
                {data: 'description', name: 'description'},
                {
                    "data": '',
                    "defaultContent": '',
                    "orderable": false,
                    "searchable": false,
                    "mRender": function (data, type, row) {
                        var edit = '<a href="/admin/role/edit?id=' + row.id + '"><i class="fa fa-edit"></i></a>';
                        return edit;
                    }
                }
            ]
        });
    };

    rs.PoliTable = function ($element, listUrl, csrf) {
        if (!$element.length) return null;
        return $element.DataTable({
            processing: true,
            serverSide: true,
            "deferRender": true,
            responsive: true,
            ajax: {
                'url': listUrl,
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': csrf
                }
            },
            dom: 'lBfrtip',
            "order": [[1, 'asc']],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    },
                    title: $('.print-datatable').attr('title')
                }
            ],
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    "orderable": false,
                    "searchable": false
                },
                {data: 'name', name: 'name'},
                {data: 'desc', name: 'desc'},
                {
                    "data": '',
                    "defaultContent": '',
                    "orderable": false,
                    "searchable": false,
                    "mRender": function (data, type, row) {
                        var edit = '<a href="/admin/poli/edit?id=' + row.id + '"><i class="fa fa-edit"></i></a>';
                        var remove = '<a href="javascript:;" class="btn-remove" data-id="' + row.id + '"><i class="fa fa-remove"></i></a>';
                        return edit + ' | ' + remove;
                    }
                }
            ]
        });
    };

    rs.ServiceTable = function ($element, listUrl, csrf) {
        if (!$element.length) return null;
        return $element.DataTable({
            processing: true,
            serverSide: true,
            "deferRender": true,
            responsive: true,
            ajax: {
                'url': listUrl,
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': csrf
                }
            },
            dom: 'lBfrtip',
            "order": [[1, 'asc']],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    },
                    title: $('.print-datatable').attr('title')
                }
            ],
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    "orderable": false,
                    "searchable": false
                },
                {data: 'name', name: 'name'},
                {data: 'cost', name: 'cost'},
                {data: 'desc', name: 'desc'},
                // {data: 'display_name', name: 'display_name'},
                {
                    "data": '',
                    "defaultContent": '',
                    "orderable": false,
                    "searchable": false,
                    "mRender": function (data, type, row) {
                        var edit = '<a href="/admin/tindakan/edit?id=' + row.id + '"><i class="fa fa-edit"></i></a>';
                        // var remove = '<a href="javascript:;" class="btn-remove" data-id="' + row.id + '"><i class="fa fa-remove"></i></a>';
                        return edit + '';
                    }
                }
            ]
        });
    };

    rs.SettingTable = function ($element, listUrl, csrf) {
        if (!$element.length) return null;
        return $element.DataTable({
            processing: true,
            serverSide: true,
            "deferRender": true,
            responsive: true,
            ajax: {
                'url': listUrl,
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': csrf
                }
            },
            dom: 'lBfrtip',
            "order": [[1, 'asc']],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    },
                    title: $('.print-datatable').attr('title')
                }
            ],
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    "orderable": false,
                    "searchable": false
                },
                {data: 'name', name: 'name'},
                {data: 'desc', name: 'desc'},
                {
                    "data": '',
                    "defaultContent": '',
                    "orderable": false,
                    "searchable": false,
                    "mRender": function (data, type, row) {
                        var edit = '<a href="/admin/setting/edit?id=' + row.id + '"><i class="fa fa-edit"></i></a>';
                        var remove = '<a href="javascript:;" class="btn-remove" data-id="' + row.id + '"><i class="fa fa-remove"></i></a>';
                        return edit + ' | ' + remove;
                    }
                }
            ]
        });
    };

    rs.StaffjobTable = function ($element, listUrl, csrf) {
        if (!$element.length) return null;
        return $element.DataTable({
            processing: true,
            serverSide: true,
            "deferRender": true,
            responsive: true,
            ajax: {
                'url': listUrl,
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': csrf
                }
            },
            dom: 'lBfrtip',
            "order": [[1, 'asc']],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    },
                    title: $('.print-datatable').attr('title')
                }
            ],
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    "orderable": false,
                    "searchable": false
                },
                {data: 'name', name: 'name'},
                {data: 'desc', name: 'desc'},
                {
                    "data": '',
                    "defaultContent": '',
                    "orderable": false,
                    "searchable": false,
                    "mRender": function (data, type, row) {
                        var edit = '<a href="/admin/staffjob/edit?id=' + row.id + '"><i class="fa fa-edit"></i></a>';
                        var remove = '<a href="javascript:;" class="btn-remove" data-id="' + row.id + '"><i class="fa fa-remove"></i></a>';
                        return edit + ' | ' + remove;
                    }
                }
            ]
        });
    };

    rs.StaffpositionTable = function ($element, listUrl, csrf) {
        if (!$element.length) return null;
        return $element.DataTable({
            processing: true,
            serverSide: true,
            "deferRender": true,
            responsive: true,
            ajax: {
                'url': listUrl,
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': csrf
                }
            },
            dom: 'lBfrtip',
            "order": [[1, 'asc']],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    },
                    title: $('.print-datatable').attr('title')
                }
            ],
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    "orderable": false,
                    "searchable": false
                },
                {data: 'name', name: 'name'},
                {data: 'desc', name: 'desc'},
                {
                    "data": '',
                    "defaultContent": '',
                    "orderable": false,
                    "searchable": false,
                    "mRender": function (data, type, row) {
                        var edit = '<a href="/admin/staffposition/edit?id=' + row.id + '"><i class="fa fa-edit"></i></a>';
                        var remove = '<a href="javascript:;" class="btn-remove" data-id="' + row.id + '"><i class="fa fa-remove"></i></a>';
                        return edit + ' | ' + remove;
                    }
                }
            ]
        });
    };

    rs.StaffTable = function ($element, listUrl, csrf) {
        if (!$element.length) return null;
        return $element.DataTable({
            processing: true,
            serverSide: true,
            "deferRender": true,
            responsive: true,
            ajax: {
                'url': listUrl,
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': csrf
                }
            },
            dom: 'lBfrtip',
            "order": [[1, 'asc']],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    },
                    title: $('.print-datatable').attr('title')
                }
            ],
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    "orderable": false,
                    "searchable": false
                },
                {data: 'nik', name: 'nik'},
                {data: 'full_name', name: 'full_name'},
                {data: 'gender', name: 'gender'},
                {data: 'staff_job.name', name: 'staff_job.name'},
                {
                    data: 'staff_position.name', name: 'staff_position.name', 'mRender': function (data) {
                        if(!data){
                            return '-';
                        }
                        return data;
                }
                },

                {
                    "data": '',
                    "defaultContent": '',
                    "orderable": false,
                    "searchable": false,
                    "mRender": function (data, type, row) {
                        var edit = '<a href="/admin/staff/edit?id=' + row.id + '"><i class="fa fa-edit"></i></a>';
                        var remove = '<a href="javascript:;" class="btn-remove" data-id="' + row.id + '"><i class="fa fa-remove"></i></a>';
                        return edit;
                    }
                }
            ]
        });
    };

    rs.ReferenseTable = function ($element, listUrl, csrf) {
        if (!$element.length) return null;
        return $element.DataTable({
            processing: true,
            serverSide: true,
            "deferRender": true,
            responsive: true,
            ajax: {
                'url': listUrl,
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': csrf
                }
            },
            dom: 'lBfrtip',
            "order": [[1, 'asc']],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    },
                    title: $('.print-datatable').attr('title')
                }
            ],
            columns: [
                {
                    data: 'id', name: 'id', "orderable": false,
                    "searchable": false,
                },
                {data: 'register.patient.number_medical_record', name: 'register.patient.number_medical_record'},
                {data: 'register.patient.full_name', name: 'register.patient.full_name'},
                {
                    data: 'status', name: 'status', "mRender": function (data) {
                    var status;
                    switch (data) {
                        case "1":
                            status = '<span class="alert-danger">Belum Diperiksa</span>';
                            break;
                        case "2":
                            status = '<span class="alert-warning">Dirujuk</span>';
                            break;
                        case "3":
                            status = '<span class="alert-info">Dirawat</span>';
                            break;
                        case "4":
                            status = '<span class="alert-success">Selesai di Periksa</span>';
                            break;
                    }
                    return status;
                }
                },
                {
                    "data": '',
                    "defaultContent": '',
                    "orderable": false,
                    "searchable": false,
                    "mRender": function (data, type, row) {
                        var detail = '<a href="/penata-jasa/kunjungan/detail/' + row.id + '"><i class="fa fa-info"></i></a>';
                        return detail;
                    }
                }
            ]
        });
    };

    rs.VisitorTable = function ($element, listUrl, csrf, role) {
        if (!$element.length) return null;
        return $element.DataTable({
            processing: true,
            serverSide: true,
            "deferRender": true,
            responsive: true,
            ajax: {
                'url': listUrl,
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': csrf
                }
            },
            dom: 'lBfrtip',
            "order": [[1, 'asc']],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    },
                    title: $('.print-datatable').attr('title')
                }
            ],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'number_medical_record', name: 'number_medical_record'},
                {data: 'full_name', name: 'full_name'},
                {
                    "data": '',
                    "defaultContent": '',
                    "orderable": false,
                    "searchable": false,
                    "mRender": function (data, type, row) {
                        var detail = '<a href="/' + role + '/pengunjung/detail/' + row.id + '"><i class="fa fa-info"></i></a>';
                        return detail;
                    }
                }
            ]
        });
    };

    rs.PaymentTable = function ($element, listUrl, csrf) {
        if (!$element.length) return null;
        return $element.DataTable({
            processing: true,
            serverSide: true,
            "deferRender": true,
            ajax: {
                'url': listUrl,
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': csrf
                }
            },
            dom: 'lBfrtip',
            "order": [[1, 'asc']],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    },
                    title: $('.print-datatable').attr('title')
                }
            ],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'patient.number_medical_record', name: 'patient.number_medical_record'},
                {data: 'patient.full_name', name: 'patient.full_name'},
                {data: 'created_at', name: 'created_at'},
                {
                    "data": '',
                    "defaultContent": '',
                    "mRender": function (data, type, row) {
                        var status;
                        switch (row.full_payment_status) {
                            case "1" :
                                status = '<span class="alert-warning">Belum Membayar / Ada Tunggakan</span>';
                                break;
                            default:
                                status = '<span class="alert-success">Pembayaran Success</span>';
                                break
                        }

                        return status;
                    }
                },
                {
                    "data": '',
                    "defaultContent": '',
                    "orderable": false,
                    "searchable": false,
                    "mRender": function (data, type, row) {
                        var detail = '<a href="/kasir/pembayaran/detail/' + row.id + '"><i class="fa fa-dollar"></i></a>';
                        return detail;
                    }
                }
            ]
        });
    };

    rs.DoctorServiceTable = function ($element, listUrl, csrf) {
        if (!$element.length) return null;
        return $element.DataTable({
            processing: true,
            serverSide: true,
            "deferRender": true,
            ajax: {
                'url': listUrl,
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': csrf
                }
            },
            dom: 'lBfrtip',
            "order": [[1, 'asc']],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    },
                    title: $('.print-datatable').attr('title')
                }
            ],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'full_name', name: 'full_name'},
                {
                    "data": '',
                    "defaultContent": '',
                    "orderable": false,
                    "searchable": false,
                    "mRender": function (data, type, row) {
                        var edit = '<a href="/admin/jasa-dokter/edit/' + row.id + '"><i class="fa fa-edit"></i></a>';
                        return edit;
                    }
                }
            ]
        });
    };

    rs.InventoryTable = function ($element, listUrl, csrf, role, category) {
        if (!$element.length) return null;
        return $element.DataTable({
            processing: true,
            serverSide: true,
            "deferRender": true,
            ajax: {
                'url': listUrl,
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': csrf
                }
            },
            dom: 'lBfrtip',
            "order": [[1, 'asc']],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    },
                    title: $('.print-datatable').attr('title')
                }
            ],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'code', name: 'code'},
                {data: 'name', name: 'name'},
                {data: 'category', name: 'category'},
                {data: 'type', name: 'type'},
                {data: 'total', name: 'total'},
                {data: 'stock_minimal', name: 'stock_minimal'},
                {data: 'stock_maximal', name: 'stock_maximal'},
                {data: 'sediaan', name: 'sediaan'},
                {
                    "data": '',
                    "defaultContent": '',
                    "orderable": false,
                    "searchable": false,
                    "mRender": function (data, type, row) {
                        var result;
                        var category_type;
                        if(category == 'medicine'){
                            category_type = 'obat';
                        } else{
                            category_type = 'inventory';
                        }
                        var maximal_add = row.stock_maximal - row.total;
                        var edit = '<a href="/'+role+'/'+category_type+'/edit?id='+row.id+'"><i class="fa fa-edit"></i></a>';
                        var remove = '<a href="javascript:;" data-id="'+row.id+'" class="btn-remove"><i class="fa fa-remove"></i></a>';
                        var batch = '<a class="btn-modal" data-id="'+row.id+'" data-max="'+maximal_add+'"><i class="fa fa-plus"></i> Batch</a>';
                        if(category == 'medicine'){
                            result = edit + ' | ' + remove + ' | ' + batch;
                        } else{
                            result =  edit + ' | ' + remove ;
                        }
                        return result;
                    }
                }
            ]
        });
    };

    rs.ApotekRecipeTable = function ($element, listUrl, csrf) {
        if (!$element.length) return null;
        return $element.DataTable({
            processing: true,
            serverSide: true,
            "deferRender": true,
            ajax: {
                'url': listUrl,
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': csrf
                }
            },
            dom: 'lBfrtip',
            "order": [[1, 'asc']],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    },
                    title: $('.print-datatable').attr('title')
                }
            ],
            columns: [
                {data: 'id', name: 'id'},
                {
                    "data": '',
                    "defaultContent": '',
                    "orderable": false,
                    "searchable": false,
                    "mRender": function (data, type, row) {
                        var name;
                        if(row.reference){
                            name = row.reference.register.patient.full_name
                        }else{
                            name = row.buyer.full_name
                        }
                        return name;
                    }
                },
                {data: 'number_recipe', name: 'number_recipe'},
                {
                    "data": '',
                    "defaultContent": '',
                    "orderable": true,
                    "searchable": true,
                    "mRender": function (data, type, row) {
                        var poly;
                        if(row.reference){
                            poly = row.reference.poly.name
                        }else{
                            poly = 'Pembeli Luar'
                        }
                        return poly;
                    }
                },
                {data: 'created_at', name: 'created_at'},
                {
                    "data": '',
                    "defaultContent": '',
                    "orderable": true,
                    "searchable": true,
                    "mRender": function (data, type, row) {
                        var detail = '<a href="/apotek/resep/detail/'+row.id+'"><i class="fa fa-info"></i></a>';
                        return detail;
                    }
                }
            ]
        });
    };


    function orderNumber($datatable) {
        $datatable.on('order.dt search.dt draw.dt', function () {
            var page = $datatable.page.info().page;
            $datatable.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1 + (page * 10);''
            });
        }).draw();
    }

    $(document).ready(function () {
        var socket = io.connect('http://localhost:8890');

        var $QueueTable = rs.QueueTable($('#table-queue'), '/loket/antrian-list', $('meta[name="csrf-token"]').attr('content'));


        var $UserTable = rs.UserTable($('#table-user'), '/admin/user-list', $('meta[name="csrf-token"]').attr('content'));
        if ($UserTable) {
            orderNumber($UserTable);
        }

        var $roleTable = rs.RoleTable($('#table-roles'), '/admin/role-list', $('meta[name="csrf-token"]').attr('content'));
        if ($roleTable) {
            orderNumber($roleTable);
        }

        var $ServiceTable = rs.ServiceTable($('#table-service'), '/admin/tindakan-list', $('meta[name="csrf-token"]').attr('content'));
        if ($ServiceTable) {
            orderNumber($ServiceTable);
        }


        var $PoliTable = rs.PoliTable($('#table-poli'), '/admin/poli-list', $('meta[name="csrf-token"]').attr('content'));
        if ($PoliTable) {
            orderNumber($PoliTable);
        }
        var $SettingTable = rs.SettingTable($('#table-setting'), '/admin/setting-list', $('meta[name="csrf-token"]').attr('content'));
        if ($SettingTable) {
            orderNumber($SettingTable);
        }

        var $StaffjobTable = rs.StaffjobTable($('#table-staffjob'), '/admin/staffjob-list', $('meta[name="csrf-token"]').attr('content'));
        if ($StaffjobTable) {
            orderNumber($StaffjobTable);
        }

        var $StaffpositionTable = rs.StaffpositionTable($('#table-staffposition'), '/admin/staffposition-list', $('meta[name="csrf-token"]').attr('content'));
        if ($StaffpositionTable) {
            orderNumber($StaffpositionTable);
        }

        var $StaffTable = rs.StaffTable($('#table-staff'), '/admin/staff-list', $('meta[name="csrf-token"]').attr('content'));
        if ($StaffTable) {
            orderNumber($StaffTable);
        }

        /*queue table*/
        var $QueueTable = rs.QueueTable($('#table-queue'), '/loket/antrian-list', $('meta[name="csrf-token"]').attr('content'), $('#table-queue').data('user'), 'loket');
        var bpjs = rs.QueueTable($('#table-queue-bpjs'), '/loket/antrian-list?type=bpjs', $('meta[name="csrf-token"]').attr('content'), $('#table-queue-bpjs').data('user'), 'loket');
        var umum = rs.QueueTable($('#table-queue-umum'), '/loket/antrian-list?type=umum', $('meta[name="csrf-token"]').attr('content'), $('#table-queue-umum').data('user'), 'loket');
        var contractor = rs.QueueTable($('#table-queue-contractor'), '/loket/antrian-list?type=contractor', $('meta[name="csrf-token"]').attr('content'), $('#table-queue-contractor').data('user'), 'loket');

        /*registration table*/
        var registration = rs.RegistrationTable($('#table-registration'), '/loket/pendaftaran-list', $('meta[name="csrf-token"]').attr('content'));
        if (registration) {
            orderNumber(registration);
        }
        /*queue table polies*/
        var polies = rs.QueueTable($('#table-queue-polies'), '/penata-jasa/antrian-list', $('meta[name="csrf-token"]').attr('content'), $('#table-queue-polies').data('user'), 'penata-jasa');
        /*kunjungan pasien di poly*/
        var reference = rs.ReferenseTable($('#table-reference'), '/penata-jasa/kunjungan-list', $('meta[name="csrf-token"]').attr('content'));
        if (reference) {
            orderNumber(reference);
        }

        var visitor = rs.VisitorTable($('#table-visitor'), '/' + $('#table-visitor').data('role') + '/pengunjung-list', $('meta[name="csrf-token"]').attr('content'), $('#table-visitor').data('role'));
        if (visitor) {
            orderNumber(visitor);
        }

        var payment = rs.PaymentTable($('#table-payment'), '/kasir/pembayaran-list', $('meta[name="csrf-token"]').attr('content'));
        if (payment) {
            orderNumber(payment);
        }

        var doctorService = rs.DoctorServiceTable($('#table-doctor-service'), '/admin/jasa-dokter-list', $('meta[name="csrf-token"]').attr('content'));
        if (doctorService) {
            orderNumber(doctorService);
        }

        var inventory = rs.InventoryTable($('#table-inventory'), '/'+$('#table-inventory').data('role')+'/inventory-list?type=non_medis', $('meta[name="csrf-token"]').attr('content'), $('#table-inventory').data('role'), 'inventory');
        if (inventory) {
            inventory.column(-2).visible(false);
            inventory.column(-3).visible(false);
            inventory.column(-4).visible(false);
            orderNumber(inventory);
        }

        var medicine = rs.InventoryTable($('#table-medicine'), '/'+$('#table-medicine').data('role')+'/inventory-list?type=medis', $('meta[name="csrf-token"]').attr('content'), $('#table-medicine').data('role'), 'medicine');
        if (medicine) {
            orderNumber(medicine);
        }

        var apotek_recipe = rs.ApotekRecipeTable($('#table-recipe'), '/apotek/resep-list', $('meta[name="csrf-token"]').attr('content'));
        if (apotek_recipe) {
            orderNumber(apotek_recipe);
        }


        //socket message
        socket.on('message', function (data) {
            switch (data) {
                case 'bpjs':
                    bpjs.ajax.reload();
                    break;
                case 'umum':
                    umum.ajax.reload();
                    break;
                case 'contractor':
                    contractor.ajax.reload();
                    break;
                case 'registration':
                    registration.ajax.reload();
                    break;
                case 'Poli Umum':
                    polies.ajax.reload();
                    break;
                case 'Poli Anak':
                    polies.ajax.reload();
                    break;
                case 'medicine':
                    medicine.ajax.reload();
                    break;
                default:
                    polies.ajax.reload();
            }
        });
    });

})(jQuery, window);