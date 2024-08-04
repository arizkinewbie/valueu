<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
<div class="card">
	<div class="card-header">
		<h5 class="card-title"><?= $current_module['judul_module'] ?></h5>
	</div>
	<div class="card-body">
		<?php
		if (!$result) {
			show_message('Data tidak ada', 'error', false);
		} else {
			if (!empty($msg)) {
				show_alert($msg);
			}
		?>
			<a href="<?= $module_url ?>/block-token" class="btn btn-success btn-xs mb-3"><i class="fa fa-plus pe-1"></i> Block Token</a>
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover" id="data-tables-token" style="width:100%">
					<thead>
						<tr>
							<th>No</th>
							<th>Token</th>
							<th>Status</th>
							<th>Pembuat</th>
							<th>Tanggal Pembuatan</th>
							<th>Tanggal Berlaku</th>
						</tr>
					</thead>
					<tbody>
					<?php
					foreach ($result as $key => $val) {
						if ($val['status'] == 1) {
							$status = '<span class="badge rounded-pill bg-danger"> Blokir</span>';
						} else {
							$status = '<span class="badge rounded-pill bg-success"> Aktif</span>';
						}
						$expired = $val['expired'] ? format_tanggal($val['expired']) : 'Tidak ada';
						echo '<tr>
						<td class="text-center">' . $key . '</td>
						<td class="text-truncate" style="max-width: 450px;" title="' . $val['token'] . '">' . $val['token'] . '</td>
						<td class="text-center"> ' . $status . '</td>
						<td>' . $val['creator'] . '</td>
						<td>' . format_tanggal($val['ctime']) . '</td>
						<td>' . $expired . '</td>
					</tr>';
					}
				}

				// $settings['dom'] = 'Bfrtip';
				$settings['order'] = [4, 'asc'];
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
</script>