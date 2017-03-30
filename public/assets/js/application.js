/* loader */
$(window).on('load', function(){
	$('#loader').transition('fade');
})

$(function(){
    /* menu sidebar toggle */
    /* mobile display */
    $(document).on('click', '.module-left-bars', function(){
        var vis = $('.module-left-container').hasClass("visible"); 
        $('.module-left-container').transition('slide right');
        
        if(vis == false){
            $('.module-content-container').addClass('mobile-ver');
            $(this).empty().append('<i class="ti-close"></i>');
            $('.module-content-container').css("position", "fixed");
        }else{
            $('.module-content-container').removeClass('mobile-ver');
            $(this).empty().append('<i class="ti-menu"></i>');
            $('.module-content-container').css("position", "relative");
        }
    });
    $(document).on('click', '.mobile-ver', function(){
        $(this).removeClass('mobile-ver');
        $('.module-left-container').transition('slide right');
        $('.module-left-bars').empty().append('<i class="ti-menu"></i>');
        $('.module-content-container').css("position", "relative");
    });

    /* metismenu */
    $('#module-left-menu').metisMenu();

    /* slimscroll */
    $('.module-left-nav').slimScroll({
        height: '100%',
        size: '10px'
    });
});

$(document).ready(function(){
    /* datatable */
    $('#example').DataTable({
        'dom':'<"top"f>rt<"bottom"<"col-md-6"i><"col-md-6 right"p>><"clear">',
        'language': {
            'zeroRecords': 'Maaf, Data tidak ditemukan',
            'infoEmpty' : 'Tidak ada record data',
            'info' : 'Halaman _PAGE_ dari _PAGES_. Total records: _TOTAL_',
            'search': '<form class="ui form"><div class="field"><div class="ui left icon input"><i class="search icon"></i> _INPUT_ </div></div></form>',
            'searchPlaceholder': 'Search...',
            'paginate':{
                'previous': '&laquo',
                'next': '&raquo'

            },
            'infoFiltered': '<br/>(dari _MAX_ total record)',
            'responsive': true,
            'columnDefs': [
                { 'responsivePriority': 1, 'targets': 0 },
                { 'responsivePriority': 2, 'targets': -1 }
            ]
        }
    });
});