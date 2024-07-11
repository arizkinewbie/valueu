<div class="card">
	<div class="card-header">
		<h5 class="card-title"><?= $title ?></h5>
	</div>

	<div class="card-body">
		<?php
		helper(['html', 'format']);
		if (!empty($message)) {
			show_message($message);
		}
		?>
		<form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="tab-content" id="myTabContent">
				<div class="row mb-3">
					<div class="mt-1">Contoh file: <br>
						<a title="Contoh Data Perguruan Tinggi" href="<?= $config->baseURL ?>public/files/Format Data Perguruan Tinggi.xlsx">Data Perguruan Tinggi.xlsx</a> <br>
						<a title="Contoh Data Program Studi" href="<?= $config->baseURL ?>public/files/Format Data Program Studi.xlsx">Data Program Studi.xlsx</a>
					</div>
					<small>Baris pertama file excel harus disertakan, dan tidak boleh dirubah, karena akan diidentifikasi sebagai nama kolom tabel database</small>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">File Perguruan Tinggi</label>
					<div class="col-sm-5">
						<input type="file" class="file form-control" name="file_excel_perguruan" accept=".xlsx">
						<?php if (!empty($form_errors['file_excel_perguruan'])) echo '<small class="alert alert-danger">' . $form_errors['file_excel_perguruan'] . '</small>' ?>
						<small class="small" style="display:block">Ekstensi file harus .xlsx</small>
						<div class="upload-file-thumb"><span class="file-prop"></span></div>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">File Program Studi</label>
					<div class="col-sm-5">
						<input type="file" class="file form-control" name="file_excel_prodi" accept=".xlsx">
						<?php if (!empty($form_errors['file_excel_prodi'])) echo '<small class="alert alert-danger">' . $form_errors['file_excel_prodi'] . '</small>' ?>
						<small class="small" style="display:block">Ekstensi file harus .xlsx</small>
						<div class="upload-file-thumb"><span class="file-prop"></span></div>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Input Tanggal Data PDDikti</label>
					<div class="col-sm-5">
						<input name="tgl_input" id="tgl_input" type="date" class="form-control" />
					</div>
				</div>
				<div class="row">
					<div class="col-sm-5">
						<button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
						<input type="hidden" name="id" value="<?= @$_GET['id'] ?>" />
					</div>
				</div>
			</div>
		</form>
	</div>
</div>