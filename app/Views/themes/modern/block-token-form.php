<style>
	#qrCodeReader {
		width: 100%;
		max-width: 400px;
		margin: 7px;
		border: 2px solid red;
	}
</style>
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
			'url' => $config->baseURL . '/token',
			'icon' => 'fa fa-arrow-circle-left',
			'label' => 'Token History',
		]);
		?>

		<hr />
		<?php
		if (!empty($msg)) {
			show_message($msg['content'], $msg['status']);
			if (isset($msg['redirect']) && $msg['redirect']) {
				echo '<meta http-equiv="refresh" content="2;url=' . $config->baseURL . $current_module['nama_module'] . '">';
			}
		}
		?>
		<form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="tab-content" id="myTabContent">
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label"><a href="#" class="btn btn-secondary btn-xs" id="scanQrCodeBtn" title="Click to scan QR Code">Scan QR Code</a></label>
					<div class="col-sm-5">
						<video id="qrCodeReader" style="display:none;"></video>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Token</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="token" id="token" placeholder="Token berawal eyJhbGci......" required />
						<small>Token dari data dokumen yang disahkan</small>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Pengaju</label>
					<div class="col-sm-5">
						<input readonly title="read only" class="form-control" type="text" name="id_user" value="<?= $user['id_user'] ?> - <?= $user['nama'] ?>" />
						<small>User yang melakukan pemblokiran token</small>
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
<script type="text/javascript" src="<?= $config->baseURL . 'public/themes/modern/js/qrcode.js' ?>"></script>