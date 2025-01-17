<?php
helper(['html', 'format']);
?>
<div class="card">
	<div class="card-body">
		<div class="card-body dashboard">
			<div class="row">
				<div class="col-lg-3 col-sm-6 col-xs-12 mb-4">
					<div class="card text-bg-primary shadow">
						<div class="card-body card-stats">
							<div class="description">
								<h5 class="card-title"><?= format_ribuan($jml_allToken) ?></h5>
								<p class="card-text">Total Token</p>
							</div>
							<div class="icon bg-warning-light">
								<i class="fas fa-database"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6 col-xs-12 mb-4">
					<div class="card text-white bg-success shadow">
						<div class="card-body card-stats">
							<div class="description">
								<h5 class="card-title"><?= format_ribuan($jml_aktifToken) ?></h5>
								<p class="card-text">Token Terdaftar</p>
							</div>
							<div class="icon">
								<i class="fas fa-circle-check"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6 col-xs-12 mb-4">
					<div class="card text-white bg-danger shadow">
						<div class="card-body card-stats">
							<div class="description">
								<h5 class="card-title"><?= format_ribuan($jml_nonaktifToken) ?></h5>
								<p class="card-text">Token Diblokir</p>
							</div>
							<div class="icon">
								<i class="fas fa-circle-xmark"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6 col-xs-12 mb-4">
					<div class="card text-white bg-secondary shadow">
						<div class="card-body card-stats">
							<div class="description">
								<h5 class="card-title"><?= format_ribuan($jml_user) ?></h5>
								<p class="card-text">Pengguna</p>
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


<!-- login log -->
<div class="card">
	<div class="card-header">
		<h5 class="card-title">Log Masuk</h5>
		<small><i class="text-muted">(10 data terakhir yang ditampilkan)</i></small>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="data-tables-pt" style="width:100%">
				<thead>
					<tr>
						<th>No</th>
						<th>Date</th>
						<th>IP</th>
						<th>Browser</th>
						<th>User</th>
					</tr>
				</thead>
				<tbody>
					<?php
					helper('html');
					foreach ($latest_login as $key => $val) {
						$no = $key + 1;
						echo '<tr class="text-center">
						<td width="5%">' . $no . '</td>
						<td width="20%">' . format_tanggal($val['time']) . '</td>
						<td width="15%">' . $val['ip'] . '</td>
						<td class="text-truncate" style="max-width: 250px;" title="' . $val['agent'] . '">' . $val['agent'] . '</td>
						<td>' . $val['nama'] . '</td>
					</tr>';
					}
					// $settings['dom'] = 'Bfrtip';
					$settings['order'] = [1, 'asc'];
					$settings['columnDefs'][] = ['targets' => [0], 'orderable' => false];
					?>
				</tbody>
			</table>
		</div>
		<span id="dataTables-setting" style="display:none"><?= json_encode($settings) ?></span>
		<?php
		?>
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