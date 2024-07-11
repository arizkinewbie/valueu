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
				<label class="col-sm-3 col-md-2 col-lg-2 col-form-label">Pilih Tahun PDDikti</label>
				<div class="col-sm-5">
					<div class="input-group">
						<select class="selectpicker form-control" id="date" name="date">
							<?php
							$displayedYears = []; // Array untuk menyimpan tahun-tahun yang sudah ditampilkan
							foreach ($tglInput as $tgl_input) :
								$tgl_input_value = $tgl_input['tgl_input'];
								$year = date('Y', strtotime($tgl_input_value)); // Ambil tahun dari tgl_input

								// Pengecekan apakah tahun sudah ditampilkan sebelumnya
								if (!in_array($year, $displayedYears)) :
									$selected = ($tgl_input_value == @$_GET['date']) ? 'selected' : '';
							?>
									<option value="<?= $tgl_input_value; ?>" <?= $selected; ?>><?= $year; ?></option>
							<?php
									// Tambahkan tahun ke array
									$displayedYears[] = $year;
								endif;
							endforeach;
							?>
						</select>

					</div>
					<small class="small" style="display:block; color:red">Ini akan mencadangkan dan menghapus data PDDikti yang tersedia di database SiReJak.</small>
				</div>
			</div>

			<div class="row">
				<div class="col-md-5">
					<?php
					$selectedYear = isset($_GET['date']) ? date('Y', strtotime($_GET['date'])) : ''; // Ambil tahun dari parameter date jika tersedia
					?>
					<a href="<?= current_url() ?>/backup?date=<?= @$_GET['date'] ?>" class="btn btn-warning btn-xs" id="backup-alert">
						<i class="fa-solid fa-database pe-1"></i> Backup PT
					</a>
					<a href="<?= current_url() ?>/backupProdi?date=<?= @$_GET['date'] ?>" class="btn btn-warning btn-xs" id="backup-alert-prodi">
						<i class="fa-solid fa-database pe-1"></i> Backup Prodi
					</a>
					<a href="<?= current_url() ?>/delete?date=<?= @$_GET['date'] ?>" class="btn btn-danger btn-xs" id="delete-alert">
						<i class="fa-solid fa-eraser pe-1"></i> Delete Data
					</a>
				</div>
			</div>

		</form>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#date').change(function() {
			var selectedDate = $('#date').val();
			window.location.href = '<?= current_url() ?>?date=' + selectedDate;
		});
	});

	document.getElementById('backup-alert').addEventListener('click', function(e) {
		e.preventDefault();
		Swal.fire({
			title: 'Apa anda yakin?',
			text: 'Data PT akan dicadangkan.',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak'
		}).then((result) => {
			if (result.isConfirmed) {
				Swal.fire({
						icon: 'success',
						title: 'Berhasil!',
						text: 'Data telah dicadangkan.',
						showConfirmButton: false,
						timer: 1500,
					}),
					setTimeout(function() {
						window.location.href = document.getElementById('backup-alert').getAttribute('href');
					}, 1500);
			}
		})
	});

	document.getElementById('backup-alert-prodi').addEventListener('click', function(e) {
		e.preventDefault();
		Swal.fire({
			title: 'Apa anda yakin?',
			text: 'Data Prodi akan dicadangkan.',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak'
		}).then((result) => {
			if (result.isConfirmed) {
				Swal.fire({
						icon: 'success',
						title: 'Berhasil!',
						text: 'Data telah dicadangkan.',
						showConfirmButton: false,
						timer: 1500,
					}),
					setTimeout(function() {
						window.location.href = document.getElementById('backup-alert').getAttribute('href');
					}, 1500);
			}
		})
	});

	document.getElementById('delete-alert').addEventListener('click', function(e) {
		e.preventDefault();
		Swal.fire({
			title: 'Apa anda yakin?',
			text: 'Semua Data Prodi & PT akan dihapus.',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak'
		}).then((result) => {
			if (result.isConfirmed) {
				Swal.fire({
						icon: 'success',
						title: 'Berhasil!',
						text: 'Data telah dihapus.',
						showConfirmButton: false,
						timer: 1500,
					}),
					setTimeout(function() {
						window.location.href = document.getElementById('delete-alert').getAttribute('href');
					}, 1500);
			}
		})
	});
</script>