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
    });

})(jQuery, window);