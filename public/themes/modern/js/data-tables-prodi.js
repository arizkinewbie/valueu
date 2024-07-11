jQuery(document).ready(function () {
  if ($("#data-tables-prodi").length) {
    const $setting = $("#dataTables-setting");
    let settings = {};
    if ($setting.length > 0) {
      settings = $.parseJSON($("#dataTables-setting").html());
    }

    const addSettings = {
      buttons: [
        {
          title: "Backup Data Prodi",
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
            modifier: { selected: null },
          },
          className: "btn-light me-1",
        },
      ],
    };

    // Merge settings
    // settings['lengthChange'] = false;
    settings = { ...settings, ...addSettings };

    // settings['buttons'] = [ 'copy', 'excel', 'pdf', 'colvis' ];
    var table = $("#data-tables-prodi").DataTable(settings);
    table.buttons().container().appendTo("#data-tables-prodi_wrapper .col-md-6:eq(0)");

    // No urut
    table
      .on("order.dt search.dt", function () {
        table
          .column(0, { search: "applied", order: "applied" })
          .nodes()
          .each(function (cell, i) {
            cell.innerHTML = i + 1;
          });
      })
      .draw();
  }
});
