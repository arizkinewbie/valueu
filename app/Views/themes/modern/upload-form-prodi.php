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
		if (@$tgl_kadal_aps) {
			$exp = explode('-', $tgl_kadal_aps);
			$tgl_kadal_aps = $exp[2] . '-' . $exp[1] . '-' . $exp[0];
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
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Jenjang</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="jenjang" value="<?=set_value('jenjang', @$jenjang)?>"/>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Kode Prodi</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="kode_prodi" value="<?=set_value('kode_prodi', @$kode_prodi)?>"/>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Nama Prodi</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="nama_prodi" value="<?=set_value('nama_prodi', @$nama_prodi)?>"/>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Semester Awal Prodi</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="smt_awal_prodi" value="<?=set_value('smt_awal_prodi', @$smt_awal_prodi)?>"/>
					</div>
				</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Tanggal Kadal APS</label>
					<div class="col-sm-5">
						<input class="form-control date-picker" type="text" name="tgl_kadal_aps" value="<?=set_value('tgl_kadal_aps', @$tgl_kadal_aps)?>"/>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">APS</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="aps" value="<?=set_value('aps', @$aps)?>"/>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Rasio Mahasiswa Prodi</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="rasio_mhs_prodi" value="<?=set_value('rasio_mhs_prodi', @$rasio_mhs_prodi)?>"/>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Jumlah Mahasiswa Prodi</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="jml_mhs_prodi" value="<?=set_value('jml_mhs_prodi', @$jml_mhs_prodi)?>"/>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Jumlah Dosen Rasio</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="jml_dosen_rasio" value="<?=set_value('jml_dosen_rasio', @$jml_dosen_rasio)?>"/>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Jumlah Dosen Tetap Prodi</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="jml_dosen_tetap_prodi" value="<?=set_value('jml_dosen_tetap_prodi', @$jml_dosen_tetap_prodi)?>"/>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Laporan Akhir</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="lap_akhir" value="<?=set_value('lap_akhir', @$lap_akhir)?>"/>
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