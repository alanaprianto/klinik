(function ($, window, undefined) {
    var rs = {};
    moment.locale('id');

    /*queue table*/
    rs.QueueTable = function ($element, listUrl, csrf) {
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
                    "searchable": false
                },
                {
                    "data": '',
                    "defaultContent": '',
                    "orderable": false,
                    "searchable": false,
                    "mRender": function (data, type, row) {
                        var btn = '<a class="btn btn-default btn-play" data-sound="' + row.location + '">Panggil</a>';
                        var process = '<a href="/loket/pendaftaran/tambah?id=' + row.id + '" class="btn btn-default btn-process" id="' + row.queue_number + '_' + row.type + '">Register</a>';
                        return btn + ' | ' + process;
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
                        console.log(row)
                        var edit = '<a href="/admin/user/edit?id=' + row.id + '"><i class="fa fa-edit"></i></a>';
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

        var $QueueTable = rs.QueueTable($('#table-queue'), '/loket/antrian-list', $('meta[name="csrf-token"]').attr('content'));
        // socket.on('message', function (data) {
        //     $QueueTable.row( $('#'+data).parents('tr') )
        //         .remove()
        //         .draw();
        // });
        var $UserTable = rs.UserTable($('#table-user'), '/admin/user-list', $('meta[name="csrf-token"]').attr('content'));
        if ($UserTable) {
            orderNumber($UserTable);
        }
        var socket = io.connect('http://localhost:8890');
        /*queue table*/
        var bpjs = rs.QueueTable($('#table-queue-bpjs'), '/loket/antrian-list?type=bpjs', $('meta[name="csrf-token"]').attr('content'));
        var umum = rs.QueueTable($('#table-queue-umum'), '/loket/antrian-list?type=umum', $('meta[name="csrf-token"]').attr('content'));
        var contractor = rs.QueueTable($('#table-queue-contractor'), '/loket/antrian-list?type=contractor', $('meta[name="csrf-token"]').attr('content'));

        /*registration table*/
        var registration = rs.RegistrationTable($('#table-registration'), '/loket/pendaftaran-list', $('meta[name="csrf-token"]').attr('content'));
        if (registration) {
            orderNumber(registration);
        }

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