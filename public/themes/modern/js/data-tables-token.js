jQuery(document).ready(function () {
    if ($('#data-tables-token').length) {
        const $setting = $('#dataTables-setting');
        let settings = {};
        if ($setting.length > 0) {
            settings = $.parseJSON($('#dataTables-setting').html());
        }
        // Merge settings
        // settings['lengthChange'] = false;
        settings = { ...settings };

        // settings['buttons'] = [ 'copy', 'excel', 'pdf', 'colvis' ];
        var table = $('#data-tables-token').DataTable(settings);
        table.buttons().container()
            .appendTo('#data-tables-token_wrapper .col-md-6:eq(0)');

        // No urut
        table.on('order.dt search.dt', function () {
            table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

    }
});