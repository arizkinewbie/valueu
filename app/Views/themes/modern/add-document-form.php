<div class="card">
  <div class="card-header">
    <h5 class="card-title"><?= $current_module['judul_module'] ?></h5>
    <small><?= $title ?></small>
  </div>

  <div class="card-body">
    <?php
    helper('html');
    echo btn_link([
      'attr' => ['class' => 'btn btn-light btn-xs'],
      'url' => $config->baseURL . 'token',
      'icon' => 'fa fa-arrow-circle-left',
      'label' => 'Token History',
    ]);
    ?>
    <hr />
    <?php
    if (!empty($msg)) {
      show_message($msg['content'], $msg['status']);
    }
    ?>
    <input type="hidden" name="jwtoken" id="jwtoken" value="<?= isset($jwtoken) ? $jwtoken : '' ?>" />
    <div class="qr-container alert alert-dismissible fade show alert-success mb-3" style="display: none;">
      <canvas id="myCanvas" width="200" height="200"></canvas>
      <div id="btn-container">
        <button type="button" class="btn btn-primary" style="margin-top: 10px;" onclick="downloadQr(this)" value="<?= isset($jwtoken) ? $jwtoken : '' ?>">Download</button>
      </div>
    </div>
    <form method="post" action="" id="form-container" enctype="multipart/form-data">
      <div class="tab-content" id="myTabContent">
        <div class="row mb-3">
          <label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Tanggal Surat <span class="text-danger">*</span></label>
          <div class="col-sm-5">
            <input class="form-control date-picker" type="text" name="tgl_terbit" placeholder="Tanggal Surat diterbitkan" value="<?= date('d-m-Y') ?>" required />
            <small>Tanggal Surat diterbitkan</small>
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Nomor Surat <span class="text-danger">*</span></label>
          <div class="col-sm-5">
            <input class="form-control" type="text" name="nomor" placeholder="Nomor Surat yang tertera" required />
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Perihal Surat <span class="text-danger">*</span></label>
          <div class="col-sm-5">
            <input class="form-control" type="text" name="hal" placeholder="Perihal surat yang tertera" required="required" />
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Nama/Pihak Pengaju <span class="text-danger">*</span></label>
          <div class="col-sm-5">
            <input class="form-control" type="text" name="pengaju" placeholder="Nama pihak/pengaju surat" required="required" />
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Masa Berlaku</label>
          <div class="col-sm-5">
            <?php
            echo options(
              ['name' => 'expiredOption'],
              ['N' => 'Tidak Ada', 'Y' => 'Ada'],
            );
            ?>
          </div>
        </div>
        <div class="row mb-3" id="form-tgl-berlaku" style="display: none;">
          <label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Pilih Tanggal <span class="text-danger">*</span></label>
          <div class="col-sm-5">
            <input class="form-control date-picker" type="text" name="tgl_berlaku" placeholder="Menentukan batas surat dinyatakan sah" value="<?= date('d-m-Y') ?>" disabled />
            <small>Menentukan batas surat dinyatakan sah</small>
          </div>
        </div>
        <div class="row mb-3" hidden>
          <label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Pihak terkait</label>
          <div class="col-sm-5">
            <?php
            if (!$users) {
              echo '<div class="alert alert-danger">Data pengguna masih kosong, silakan diisi terlebih dahulu</div>';
            } else {
              echo options(
                ['class' => 'select2', 'name' => 'pihak_terkait[]', 'multiple' => 'multiple'],
                $users,
              );
            } ?>
            <small>termasuk yang mengetahui / menyetujui</small>
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Keterangan</label>
          <div class="col-sm-5">
            <textarea class="form-control" type="text" id="form-keterangan" name="keterangan" placeholder="Keterangan / catatan tambahan"></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-5">
            <button type="submit" name="submit" id="btn-submit" value="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript" src="<?= $config->baseURL . 'public/themes/modern/js/qrcode.js' ?>"></script>