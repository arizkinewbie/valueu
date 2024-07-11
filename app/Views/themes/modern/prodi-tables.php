<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
<div class="card">
	<div class="card-header">
		<h5 class="card-title"><?=$current_module['judul_module']?></h5>
	</div>
	<div class="card-body">
		<div class="row mb-3">
			<label class="col-sm-3 col-md-2 col-lg-2 col-form-label">Pilih Tanggal Data PDDIKTI</label>
			<div class="col-sm-3">
				<form id="filterForm" action="">
					<div class="input-group">
						<select class="form-control" id="date" name="date">
							<option value="all">-- Semua Data --</option>
							<?php foreach ($tglInput as $tgl_input) : ?>
								<?php
									$tgl_input_value = $tgl_input['tgl_input'];
									$selected = ($tgl_input_value == @$_GET['date']) ? 'selected' : '';
								?>
								<option value="<?= $tgl_input_value; ?>" <?= $selected; ?>><?= format_tanggal($tgl_input_value); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</form>
			</div>
		</div>
	  
		<?php 
		if (!$result) {
			show_message('Data tidak ditemukan', 'error', false);
		} else {
			if (!empty($msg)) {
				show_alert($msg);
			}
			?>
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="data-tables-prodi">
			<thead>
			<tr>
				<th>No</th>
				<th>Tanggal Data PDDikti</th>
				<th>Kode PT</th>
				<th>Nama PT</th>
				<th>Jenjang</th>
				<th>Kode Prodi</th>
				<th>Nama Prodi</th>
				<th>Semester Awal Prodi</th>
				<th>Tanggal Kadal APS</th>
				<th>APS</th>
				<th>Rasio Mahasiswa Prodi</th>
				<th>Jumlah Mahasiswa Prodi</th>
				<th>Jumlah Dosen Rasio</th>
				<th>Jumlah Dosen Tetap Prodi</th>
				<th>Laporan Akhir</th>
				<th>Aksi</th>
			</tr>
			</thead>
			<tbody>
			<?php
			helper('html');
			
			$i = 1;
			
			foreach ($result as $key => $val) 
				
				echo '<tr>
						<td>' . $i . '</td>
						<td>' . format_tanggal($val['tgl_input']) . '</td>
						<td>' . $val['kode_pt'] . '</td>
						<td>' . $val['nama_pt'] . '</td>
						<td>' . $val['jenjang'] . '</td>
						<td>' . $val['kode_prodi'] . '</td>
						<td>' . $val['nama_prodi'] . '</td>
						<td>' . $val['smt_awal_prodi'] . '</td>
						<td>' . format_tanggal($val['tgl_kadal_aps']) . '</td>
						<td>' . $val['aps'] . '</td>
						<td>' . $val['rasio_mhs_prodi'] . '</td>
						<td>' . $val['jml_mhs_prodi'] . '</td>
						<td>' . $val['jml_dosen_rasio'] . '</td>
						<td>' . $val['jml_dosen_tetap_prodi'] . '</td>
						<td>' . $val['lap_akhir'] . '</td>
						<td>'. btn_action([
									'edit' => ['url' => current_url() . '/edit?id='. $val['id_prodi']]
							]) .
						'</td>
					</tr>';
					$i++;
			}
			
			// $settings['dom'] = 'Bfrtip';
			$settings['order'] = [2,'asc'];			
			$settings['columnDefs'][] = ['targets' => [0], 'orderable' => false];
			?>
			</tbody>
			</table>
			</div>
			<span id="dataTables-setting" style="display:none"><?=json_encode($settings)?></span>
			<?php 
		 ?>
	</div>
</div>
	<script>
		$(document).ready(function () {
			$('#date').change(function () {
				var selectedDate = $('#date').val();
				window.location.href = '<?= current_url() ?>?date=' + selectedDate;
			});
		});
	</script>
	<script>
		document.getElementById('backup-alert').addEventListener('click', function (e) {
			e.preventDefault();

			Swal.fire({
				title: 'Apa anda yakin?',
				text: '<?=$current_module['judul_module']?> ini akan dicadangkan.',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya',
				cancelButtonText: 'Tidak'
			}).then((result) => {
				if (result.isConfirmed) {
				Swal.fire({
					icon: 'success',
					title: 'Berhasil!',
					text: '<?=$current_module['judul_module']?> telah dicadangkan.',
					showConfirmButton: false,
					timer: 1500,
				}),
				setTimeout(function () {
				window.location.href = document.getElementById('backup-alert').getAttribute('href');
				}, 1500);
				}
			})
		});

		document.getElementById('delete-alert').addEventListener('click', function (e) {
			e.preventDefault();

			Swal.fire({
				title: 'Apa anda yakin?',
				text: '<?=$current_module['judul_module']?> ini akan dihapus.',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya',
				cancelButtonText: 'Tidak'
			}).then((result) => {
				if (result.isConfirmed) {
				Swal.fire({
					icon: 'success',
					title: 'Berhasil!',
					text: '<?=$current_module['judul_module']?> telah dihapus.',
					showConfirmButton: false,
					timer: 1500,
				}),
				setTimeout(function () {
				window.location.href = document.getElementById('delete-alert').getAttribute('href');
				}, 1500);
				}
			})
		});
	</script>