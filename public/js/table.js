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
            buttons : ['print'],
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
                        var btn = '<a class="btn btn-default btn-play" data-sound="'+row.location+'">Panggil</a>';
                        var process = '<a href="/loket/pendaftaran/tambah?id='+row.id+'" class="btn btn-default btn-process" id="'+row.queue_number+'_'+row.type+'">Register</a>';
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
            buttons : ['print'],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    "orderable": false,
                    "searchable": false
                },
                {data: 'number_medical_record', name: 'number_medical_record'},
                {data: 'full_name', name: 'full_name'},
                {data: 'address', name: 'address'},
                {data: 'address', name: 'address'},
                {data: 'age', name: 'age'},
                {data: 'payment_method', name: 'payment_method'},
                {data: 'doctor_name', name: 'doctor_name'},
                {
                    "data": '',
                    "defaultContent": '',
                    "orderable": false,
                    "searchable": false,
                    "mRender": function (data, type, row) {
                        return '-';
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
                    data: 'roles[0].display_name', name: 'roles[0].display_name'  },
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
<<<<<<< HEAD

        // var socket = io.connect('http://localhost:8890');

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
=======
        var socket = io.connect('http://localhost:8890');
        /*queue table*/
        var bpjs = rs.QueueTable($('#table-queue-bpjs'), '/loket/antrian-list?type=bpjs', $('meta[name="csrf-token"]').attr('content'));
        var umum = rs.QueueTable($('#table-queue-umum'), '/loket/antrian-list?type=umum', $('meta[name="csrf-token"]').attr('content'));
        var contractor = rs.QueueTable($('#table-queue-contractor'), '/loket/antrian-list?type=contractor', $('meta[name="csrf-token"]').attr('content'));

        /*registration table*/
        var registration = rs.RegistrationTable($('#table-registration'), '/loket/pendaftaran-list', $('meta[name="csrf-token"]').attr('content'));
        if(registration){
            orderNumber(registration);
        }

        //socket message delete antrian yang close
        socket.on('message', function (data) {
            var result = data.split("_");
            switch (result[1]){
                case 'bpjs':
                    bpjs.row( $('#'+result[0]).parents('tr') )
                        .remove()
                        .draw();
                    break;
                case 'umum':
                    umum.row( $('#'+result[0]).parents('tr') )
                        .remove()
                        .draw();
                    break;
                case 'contractor':
                    contractor.row( $('#'+result[0]).parents('tr') )
                        .remove()
                        .draw();
                    break;
            }
        });
>>>>>>> f8d92ffe69393f49a37790db003f4f051d4575e9
    });

})(jQuery, window);