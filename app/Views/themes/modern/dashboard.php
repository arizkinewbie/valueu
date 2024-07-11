<?php
helper(['html', 'format']);
?>
<div class="card">
	<div class="card-body">
		<div class="row mb-3">
			<label class="col-sm-3 col-md-2 col-lg-2 col-form-label">Pilih Tanggal Data PDDIKTI</label>
			<div class="col-sm-3">
				<div class="input-group">
					<select class="form-control" id="date" name="date">
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

		<div class="card-body dashboard">
			<div class="row">
				<div class="col-lg-3 col-sm-6 col-xs-12 mb-4">
					<div class="card text-bg-primary shadow">
						<div class="card-body card-stats">
							<div class="description">
								<h5 class="card-title"><?= format_ribuan($jml_pt) ?></h5>
								<p class="card-text">Perguruan Tinggi</p>
							</div>
							<div class="icon bg-warning-light">
								<i class="fas fa-graduation-cap"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6 col-xs-12 mb-4">
					<div class="card text-white bg-success shadow">
						<div class="card-body card-stats">
							<div class="description">
								<h5 class="card-title"><?= format_ribuan($jml_prodi) ?></h5>
								<p class="card-text">Program Studi</p>
							</div>
							<div class="icon">
								<i class="fas fa-book-open-reader"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6 col-xs-12 mb-4">
					<div class="card text-white bg-danger shadow">
						<div class="card-body card-stats">
							<div class="description">
								<h5 class="card-title"><?= format_ribuan($jml_yayasan) ?></h5>
								<p class="card-text">Yayasan</p>
							</div>
							<div class="icon">
								<i class="fas fa-solid fa-house"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6 col-xs-12 mb-4">
					<div class="card text-white bg-secondary shadow">
						<div class="card-body card-stats">
							<div class="description">
								<h5 class="card-title"><?= format_ribuan($jml_mhs) ?></h5>
								<p class="card-text">Mahasiswa</p>
							</div>
							<div class="icon">
								<i class="material-icons">person</i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script>
	$(document).ready(function() {
		$('#date').change(function() {
			var selectedDate = $('#date').val();
			window.location.href = '<?= current_url() ?>?date=' + selectedDate;
		});
	});
</script>