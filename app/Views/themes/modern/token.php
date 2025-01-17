<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
<div class="card">
	<div class="card-header">
		<h5 class="card-title"><?= $current_module['judul_module'] ?></h5>
		<small><?= $title ?></small>
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
			<a href="<?= base_url() ?>/add-document" class="btn btn-success btn-xs mb-3">Add Document</a>
			<a href="<?= base_url() ?>/block-document" class="btn btn-warning btn-xs mb-3">Block Document</a>
			<div class="qr-container alert alert-dismissible fade show alert-success mb-3" style="display: none;">
				<canvas id="myCanvas" width="200" height="200"></canvas>
				<div id="btn-container">
					<button type="button" class="btn btn-primary" style="margin-top: 10px;" onclick="downloadQr(this)" value="<?= isset($jwtoken) ? $jwtoken : '' ?>">Download</button>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover" id="data-tables-token" style="width:100%">
					<thead>
						<tr>
							<th>No</th>
							<th>No. Surat</th>
							<th>Token</th>
							<th>Status</th>
							<th>Pembuat</th>
							<th>Tanggal Pembuatan</th>
							<th>Masa Berlaku</th>
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
						<td title="click for download QR Code this"><a href="#" onclick="generateQRCode(this)" data-value="' . $val['token'] . '">' . $val['no_surat'] . '</a></td>
						<td class="text-truncate" style="max-width: 400px;" title="' . $val['token'] . '">' . $val['token'] . '</td>
						<td class="text-center"> ' . $status . '</td>
						<td>' . $val['creator'] . '</td>
						<td>' . format_tanggal($val['ctime']) . '</td>
						<td>' . $expired . '</td>
					</tr>';
					}
				}
				// $settings['dom'] = 'Bfrtip';
				$settings['order'] = [5, 'desc'];
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
<script type="text/javascript" src="<?= $config->baseURL . 'public/themes/modern/js/qrcode.js' ?>"></script>