<div class="card">
	<div class="card-header">
		<h5 class="card-title"><?= $title ?></h5>
	</div>

	<div class="card-body">
		<?php
		helper('html');

		echo btn_link([
			'attr' => ['class' => 'btn btn-light btn-xs'],
			'url' => $config->baseURL . $current_module['nama_module'],
			'icon' => 'fa fa-arrow-circle-left',
			'label' => $current_module['judul_module']
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
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Token</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="token" placeholder="Token berawal eyJhbGci......" required />
						<small><i>Token yang telah dibuat sebelumnya</i></small>
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