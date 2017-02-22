(function ($, window, undefined) {
    var rs = {};
    moment.locale('id');

    rs.QueueTable = function ($element, listUrl, csrf) {
        if (!$element.length) return null;
        return $element.DataTable({
            processing: true,
            serverSide: true,
            "deferRender": true,
            buttons: [
                'print'
            ],
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
                        columns: [0, 1, 2, 3, 4]
                    },
                    title: $('.print-datatable').attr('title')
                }
            ],
            columns: [
                {data: 'queue_number', name: 'queue_number'},
                {data: 'status', name: 'status'},
                {data: 'type', name: 'type'},
                {
                    "data": '',
                    "defaultContent": '',
                    "orderable": false,
                    "searchable": false,
                    "mRender": function (data, type, row) {
                        var btn = '<a class="btn btn-default btn-play" data-sound="'+row.sound+'">Panggil</a>';
                        var process = '<a href="/loket/register?id='+row.id+'" class="btn btn-default btn-process" id="'+row.queue_number+'_'+row.type+'">Register</a>';
                        return btn + ' | ' + process;
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

        socket.on('message', function (data) {
            $QueueTable.row( $('#'+data).parents('tr') )
                .remove()
                .draw();
        });
    });

})(jQuery, window);