<div class="card">
  <div class="card-header">
    <h5 class="card-title"> <?= $title ?> </h5>
  </div>
  <div class="card-body">
    <?php
    helper(['html', 'format']);
    if (!empty($message)) {
      show_message($message);
    }
    ?>
    <form method="get" id="myForm" action="" class="form-horizontal" enctype="multipart/form-data" target="_blank">
      <div class="row mb-3">
        <label class="col-sm-3 col-md-2 col-lg-2 col-form-label">Pilih Tanggal Data PDDIKTI</label>
        <div class="col-sm-5">
          <div class="input-group">
            <select class="selectpicker form-control" title="Pilih Salah Satu" data-live-search="true" id="date" name="date">
              <?php foreach ($tglInput as $tgl_input) : ?>
                <?php
                $tgl_input_value = $tgl_input['tgl_input'];
                $selected = ($tgl_input_value == @$_GET['date']) ? 'selected' : '';
                ?>
                <option value="<?= $tgl_input_value; ?>" <?= $selected; ?>><?= format_tanggal($tgl_input_value); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </div>

      <div class="row mb-3">
        <label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Pilih Yayasan</label>
        <div class="col-sm-5">
          <select class="selectpicker form-control" title="Pilih Salah Satu" data-live-search="true" id="yayasanSelect" name="yayasanSelect">
            <?php foreach ($yayasanNames as $yayasan) : ?>
              <?php
              $yayasan_value = $yayasan['yayasan'];
              $selected = ($yayasan_value == @$_GET['yayasanSelect']) ? 'selected' : '';
              ?>
              <option value="<?= $yayasan_value ?>" <?= $selected; ?>><?= $yayasan_value; ?> </option>
            <?php endforeach; ?>
          </select>
          <div id="yayasanSelectValidation" style="display: none; color: red;">Pilih Yayasan harus diisi</div>
        </div>
      </div>

      <div class="row mb-3">
        <label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Telaah Opsi</label>
        <div class="col-sm-9">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="telaahOption" id="telaahYayasan" value="Telaah Yayasan" checked>
            <label class="form-check-label" for="telaahYayasan">Telaah Yayasan</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="telaahOption" id="telaahPT" value="Telaah PT">
            <label class="form-check-label" for="telaahPT">Telaah Perguruan Tinggi</label>
          </div>
        </div>
      </div>

      <div class="row mb-3" id="ptSelectLabel">
        <label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Pilih Perguruan Tinggi</label>
        <div class="col-sm-5">
          <select class="selectpicker form-control" title="Pilih Salah Satu" id="ptSelect" name="ptSelect">
            <?php foreach ($ptNames as $pt) : ?> <option value="<?= $pt['nama_pt']; ?>"> <?= $pt['nama_pt']; ?> </option> <?php endforeach; ?>
          </select>
          <div id="ptSelectValidation" style="display: none; color: red;">Pilih PT harus diisi</div>
        </div>
      </div>
      <input type="hidden" name="selectedValues" id="selectedValues" value="">

      <div class="row">
        <div class="col-sm-5">
          <button type="submit" name="submit" value="submit" class="btn btn-primary">Cetak</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var currentUrl = window.location.href;
    var baseUrl = '<?= base_url(); ?>/cetak';

    // Cek apakah URL saat ini sama dengan baseUrl dan tidak memiliki parameter tambahan
    if (currentUrl === baseUrl || currentUrl === baseUrl + '/') {
      document.getElementById("myForm").style.display = 'none';
      Swal.fire({
        title: 'Konfirmasi',
        text: "Apakah badan penyelenggara telah terdata?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Terdata',
        cancelButtonText: 'Belum'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById("myForm").style.display = 'block';
        } else {
          Swal.fire({
            title: 'Coming Soon',
            text: 'Fitur ini akan segera hadir!',
            icon: 'info',
            willClose: () => {
              window.location.href = '<?= base_url(); ?>/dashboard';
            }
          });
        }
      });
    } else {
      document.getElementById("myForm").style.display = 'block';
    }

    const selectedValuesInput = document.getElementById("selectedValues");
    const ptNames = <?= json_encode($ptNames); ?>;
    const ptNamesValues = ptNames.map(pt => pt.nama_pt);
    selectedValuesInput.value = ptNamesValues.join(",");
  });



  document.getElementById("myForm").addEventListener("submit", function(event) {
    var selectedYayasan = document.getElementById("yayasanSelect");
    var yayasanSelectValidation = document.getElementById("yayasanSelectValidation");
    var selectedPT = document.getElementById("ptSelect");
    var ptSelectValidation = document.getElementById("ptSelectValidation");
    var telaahPT = document.getElementById("telaahPT");
    yayasanSelectValidation.style.display = "none";
    ptSelectValidation.style.display = "none";
    if (selectedYayasan.value === "") {
      yayasanSelectValidation.style.display = "block";
      event.preventDefault();
    } else if (telaahPT.checked && selectedPT.value === "") {
      ptSelectValidation.style.display = "block";
      event.preventDefault();
    }
  });

  $(document).ready(function() {
    // Get the current URL
    var currentURL = window.location.href;
    $('#ptSelectLabel').hide();

    $('#date').change(function() {
      var selectedDate = $('#date').val();
      // Get the current URL
      var url = new URL(window.location.href);
      url.searchParams.delete('yayasanSelect');
      url.searchParams.set('date', selectedDate);
      window.location.href = url.toString();
    });


    $('#yayasanSelect').change(function() {
      var selectedYayasan = $('#yayasanSelect').val();
      var url = new URL(currentURL);
      url.searchParams.set('yayasanSelect', selectedYayasan);
      window.location.href = url.toString();
    });

    $('#telaahYayasan, #telaahPT').change(function() {
      // Show/hide PT select based on selected radio button
      if ($('#telaahPT').prop('checked')) {
        $('#ptSelectLabel').show();
      } else {
        $('#ptSelectLabel').hide();
        $('#ptSelect').val('all');
      }
    });
  });
</script>