(function ($, window, undefined) {
    var rs = {};
    moment.locale('id');

    /*queue table*/
    rs.QueueTable = function ($element, listUrl, csrf, userId) {
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
                    data: 'queue_number',
                    name: 'queue_number',
                    "orderable": false,
                    "searchable": false
                },
                {
                    data: 'status',
                    name: 'status',
                    "orderable": false,
                    "searchable": false,
                    "mRender" : function (data) {
                        var status;
                        if(data == 1){
                            status = '<span class="alert-success">Open</span>';
                        } else {
                            status = '<span class="alert-warning">On Process</span>';
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
                        if(row.status == 1) {
                            var btn = '<a class="btn btn-primary btn-play" data-sound="' + row.location + '">Panggil</a>';
                            var process = '<a href="/loket/pendaftaran/tambah?id=' + row.id + '" class="btn btn-primary btn-process" id="' + row.queue_number + '_' + row.type + '">Register</a>';
                            return btn + ' | ' + process;
                        } else{
                            if(row.staff_id == userId){
                                var btn = '<a class="btn btn-primary btn-play" data-sound="' + row.location + '">Panggil</a>';
                                var process = '<a href="/loket/pendaftaran/tambah?id=' + row.id + '" class="btn btn-primary btn-process" id="' + row.queue_number + '_' + row.type + '">Register</a>';
                                return btn + ' | ' + process;
                            } else{
                                return '-'
                            }
                        }
                    }
                }
            ]
        });
    };

    /*registration table*/
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
                        if(data == 1 || data == "1"){
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
                        var reference = '<a href="/loket/pendaftaran/'+row.id+'/tambah-rujukan"><i class="fa fa-plus"></i> Rujukan</a>';
                        return reference;
                    }
                }
            ]
        });
    };

    /*usertable*/
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
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                // {data: 'display_name', name: 'display_name'},
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
                        console.log(row)
                        var edit = '<a href="/admin/poli/edit?id=' + row.id + '"><i class="fa fa-edit"></i></a>';
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
                        console.log(row)
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
                        console.log(row)
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
                {data: 'place', name: 'place'},
                {data: 'birth', name: 'birth'},
                {data: 'age', name: 'age'},
                {data: 'address', name: 'address'},
                {data: 'religion', name: 'religion'},
                {data: 'province', name: 'province'},
                {data: 'city', name: 'city'},
                {data: 'district', name: 'district'},
                {data: 'sub_district', name: 'sub_district'},
                {data: 'rt_rw', name: 'rt_rw'},
                {data: 'phone_number', name: 'phone_number'},
                {data: 'last_education', name: 'last_education'},
                {data: 'staffjob[0].name', name: 'staffjob[0].name'},
                {data: 'staffposition[0].name', name: 'staffposition[0].name'},

                {
                    "data": '',
                    "defaultContent": '',
                    "orderable": false,
                    "searchable": false,
                    "mRender": function (data, type, row) {
                        console.log(row)
                        var edit = '<a href="/admin/staff/edit?id=' + row.id + '"><i class="fa fa-edit"></i></a>';
                        var remove = '<a href="javascript:;" class="btn-remove" data-id="' + row.id + '"><i class="fa fa-remove"></i></a>';
                        return edit + ' | ' + remove;
                    }
                }
            ]
        });
    };

    function orderNumber($datatable) {
        $datatable.on('order.dt search.dt draw.dt', function () {
            var page = $datatable.page.info().page;
            $datatable.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1 + (page * 10);
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


        var $PoliTable = rs.PoliTable($('#table-poli'), '/admin/poli-list', $('meta[name="csrf-token"]').attr('content'));
        if ($PoliTable) {
            orderNumber($PoliTable);
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
        var $QueueTable = rs.QueueTable($('#table-queue'), '/loket/antrian-list', $('meta[name="csrf-token"]').attr('content'), $('#table-queue').data('user'));
        var bpjs = rs.QueueTable($('#table-queue-bpjs'), '/loket/antrian-list?type=bpjs', $('meta[name="csrf-token"]').attr('content'), $('#table-queue-bpjs').data('user'));
        var umum = rs.QueueTable($('#table-queue-umum'), '/loket/antrian-list?type=umum', $('meta[name="csrf-token"]').attr('content'), $('#table-queue-umum').data('user'));
        var contractor = rs.QueueTable($('#table-queue-contractor'), '/loket/antrian-list?type=contractor', $('meta[name="csrf-token"]').attr('content'), $('#table-queue-contractor').data('user'));

        /*registration table*/
        var registration = rs.RegistrationTable($('#table-registration'), '/loket/pendaftaran-list', $('meta[name="csrf-token"]').attr('content'));
        if (registration) {
            orderNumber(registration);
        }
        /*queue table polies*/
        var polies = rs.QueueTable($('#table-queue-polies'), '/penata-jasa/antrian-list', $('meta[name="csrf-token"]').attr('content'), $('#table-polies').data('user'));


        //socket message delete antrian yang close
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
            }
        });
    });

})(jQuery, window);