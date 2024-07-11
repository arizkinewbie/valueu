<div class="card">
	<div class="card-header">
		<h5 class="card-title"><?=$title?></h5>
	</div>
	
	<div class="card-body">
		<?php 
			helper ('html');
			echo btn_link(['attr' => ['class' => 'btn btn-success btn-xs'],
				'url' => $config->baseURL . $current_module['nama_module'] . '/add',
				'icon' => 'fa fa-plus',
				'label' => 'Tambah Data'
			]);
			
			echo btn_link(['attr' => ['class' => 'btn btn-light btn-xs'],
				'url' => $config->baseURL . $current_module['nama_module'],
				'icon' => 'fa fa-arrow-circle-left',
				'label' => $current_module['judul_module']
			]);
		?>
		<hr/>
		<?php
		if (@$tgl_kadal_aipt) {
			$exp = explode('-', $tgl_kadal_aipt);
			$tgl_kadal_aipt = $exp[2] . '-' . $exp[1] . '-' . $exp[0];
		}
		if (!empty($msg)) {
			show_message($msg['content'], $msg['status']);
		}
		?>
		<form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="tab-content" id="myTabContent">
			<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Kode PT</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="kode_pt" value="<?=set_value('kode_pt', @$kode_pt)?>"/>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Nama PT</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="nama_pt" value="<?=set_value('nama_pt', @$nama_pt)?>"/>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Semester Awal PT</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="smt_awal_pt" value="<?=set_value('smt_awal_pt', @$smt_awal_pt)?>"/>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Jumlah Prodi</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="jml_prodi" value="<?=set_value('jml_prodi', @$jml_prodi)?>"/>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Semester Lapor</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="smt_lapor" value="<?=set_value('smt_lapor', @$smt_lapor)?>"/>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Persen Lapor</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="persen_lapor" value="<?=set_value('persen_lapor', @$persen_lapor)?>"/>
					</div>
				</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Tanggal Kadal AIPT</label>
					<div class="col-sm-5">
						<input class="form-control date-picker" type="text" name="tgl_kadal_aipt" value="<?=set_value('tgl_kadal_aipt', @$tgl_kadal_aipt)?>"/>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">AIPT</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="aipt" value="<?=set_value('aipt', @$aipt)?>"/>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Jumlah Mahasiswa</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="jml_mhs" value="<?=set_value('jml_mhs', @$jml_mhs)?>"/>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Rasio Mahasiswa</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="rasio_mhs" value="<?=set_value('rasio_mhs', @$rasio_mhs)?>"/>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Jumlah Dosen Rasio</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="jml_dosen_rasio" value="<?=set_value('jml_dosen_rasio', @$jml_dosen_rasio)?>"/>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Jumlah Dosen Tetap PT</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="jml_dosen_tetap_pt" value="<?=set_value('jml_dosen_tetap_pt', @$jml_dosen_tetap_pt)?>"/>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Yayasan</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="yayasan" value="<?=set_value('yayasan', @$yayasan)?>"/>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Alamat Yayasan</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="alamat_yayasan" value="<?=set_value('alamat_yayasan', @$alamat_yayasan)?>"/>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-5">
						<button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
						<input type="hidden" name="id" value="<?=@$_GET['id']?>"/>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>