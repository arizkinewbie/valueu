<?php
helper(['html', 'format']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- Primary Meta Tags -->
	<title><?= $site_desc ?> | <?= $site_title ?></title>
	<meta name="title" content="<?= $site_title ?>" />
	<meta name="description" content="<?= $site_desc ?>" />
	<meta name="image" content="<?= $config->baseURL ?>public/images/favicon.png" />
	<meta name="keyword" content="<?= $site_title ?>, rekam jejak, perguruan tinggi, kampus merdeka, merdeka belajar, lldikti 3, kemendikbudristek">
	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?= $config->baseURL ?>" />
	<meta property="og:title" content="<?= $site_title ?>" />
	<meta property="og:description" content="<?= $site_desc ?>" />
	<meta property="og:image" content="<?= $config->baseURL ?>public/images/favicon.png" />
	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image" />
	<meta property="twitter:url" content="<?= $config->baseURL ?>" />
	<meta property="twitter:title" content="<?= $site_title ?>" />
	<meta property="twitter:description" content="<?= $site_desc ?>" />
	<meta property="twitter:image" content="<?= $config->baseURL ?>public/images/favicon.png" />
	<link rel="shortcut icon" href="<?= $config->baseURL ?>public/images/favicon.png" />
	<!--  -->
	<link rel="stylesheet" type="text/css" href="<?= $config->baseURL . 'public/vendors/fontawesome/css/all.css' ?>" />
	<link rel="stylesheet" type="text/css" href="<?= $config->baseURL . 'public/vendors/bootstrap/css/bootstrap.min.css?r=' . time() ?>" />
	<link rel="stylesheet" type="text/css" href="<?= $config->baseURL . 'public/vendors/bootstrap-icons/bootstrap-icons.css?r=' . time() ?>" />
	<link rel="stylesheet" type="text/css" href="<?= $config->baseURL ?>public/vendors/material-icons/css.css" />
	<link rel="stylesheet" type="text/css" href="<?= $config->baseURL ?>public/themes/modern/css/dashboard.css" />
	<link rel="stylesheet" type="text/css" href="<?= $config->baseURL ?>public/home/css/index.css" />

	<!-- SweetAlert2 -->
	<script type="text/javascript" src="<?= $config->baseURL . 'public/vendors/sweetalert2/sweetalert2.min.js' ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?= $config->baseURL . 'public/vendors/sweetalert2/sweetalert2.min.css?r=' . time() ?>" />

	<!-- Bootstrap Select -->
	<!-- <script type="text/javascript" src="<?= $config->baseURL . 'public/vendors/bootstrap-select/dist/js/bootstrap-select.min.js' ?>" /> -->
	<link rel="stylesheet" type="text/css" href="<?= $config->baseURL . 'public/vendors/bootstrap-select/dist/css/bootstrap-select.min.css' ?>" />
</head>

<body>
	<!-- HEADER -->
	<header class="header">
		<nav class="header__nav">
			<div class="header__container">
				<!-- Logo -->
				<a href="#">
					<img src="<?= $config->baseURL . 'public/images/' . $settingAplikasi['logo_app'] ?>" alt="<?= $site_title ?> logo" class="header__logo" />
				</a>

				<!-- Header links -->
				<div class="header__links">
					<ul class="header__links-container">
						<li><a href="#" class="header__link">Beranda</a></li>
						<li><a href="#about" class="header__link">Tentang</a></li>
						<li><a href="#objectives" class="header__link">FAQ</a></li>
						<li><a href="#footer" class="header__link">Kontak</a></li>
						<li><a href="<?= $config->baseURL ?>dashboard" class="header__link">Dashboard</a></li>
					</ul>
				</div>
				<a href="<?= $config->baseURL ?>dashboard" class="header__play-store button button--secondary">Admin Dashboard</a>
				<!-- Header cta -->
			</div>
		</nav>
	</header>

	<!-- MAIN -->
	<main>
		<!-- HERO -->
		<section class="hero">
			<div class="container hero__container">
				<div class="hero__copy">
					<div class="hero__text">
						<h1>Sistem Pengesahan Dokumen</h1>
						<p>menjamin keamanan dan validasi data dokumen</p>
					</div>
					<div class="card-body">
						<div class="card-body dashboard">
							<div class="row">
								<div class="col-lg-6 col-sm-6 col-xs-12 mb-4">
									<div class="card text-white bg-success shadow">
										<div class="card-body card-stats">
											<div class="description">
												<h3 class="card-title"><?= format_ribuan($jml_aktifToken) ?></h3>
												<p class="card-text">Dokumen Terdaftar</p>
											</div>
											<div class="icon">
												<i class="fas fa-circle-check"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-xs-12 mb-4">
									<div class="card text-white bg-danger shadow">
										<div class="card-body card-stats">
											<div class="description">
												<h3 class="card-title"><?= format_ribuan($jml_nonaktifToken) ?></h3>
												<p class="card-text">Token Diblokir</p>
											</div>
											<div class="icon">
												<i class="fas fa-circle-xmark"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-xs-12 mb-4">
									<div class="card text-bg-primary shadow">
										<div class="card-body card-stats">
											<div class="description">
												<h3 class="card-title"><?= format_ribuan($jml_allToken) ?></h3>
												<p class="card-text">Total Dokumen</p>
											</div>
											<div class="icon bg-warning-light">
												<i class="fas fa-database"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-xs-12 mb-4">
									<div class="card text-white bg-secondary shadow">
										<div class="card-body card-stats">
											<div class="description">
												<h3 class="card-title"><?= format_ribuan($jml_user) ?></h3>
												<p class="card-text">Pengguna</p>
											</div>
											<div class="icon">
												<i class="fas fa-solid fa-users"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- <form method="POST " id="myForm" action="" class="form-horizontal" enctype="multipart/form-data" target="_blank">
						<div class="row mb-3" id="ptSelectLabel">
							<label class="col-sm-3 col-md-2 col-lg-6 col-xl-2 col-form-label">Pilih Perguruan Tinggi</label>
							<div class="col-sm-5">
								<select class="selectpicker form-control" title="Pilih Salah Satu" id="ptSelect" name="ptSelect">
									<?php foreach ($ptNames as $pt) : ?> <option value="<?= $pt['nama_pt']; ?>"> <?= $pt['nama_pt']; ?> </option> <?php endforeach; ?>
								</select>
								<div id="ptSelectValidation" style="display: none; color: red;">Pilih PT harus diisi</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-5">
								<button type="submit" name="submit" value="submit" class="btn btn-primary">Telusuri</button>
							</div>
						</div>
					</form>
					<a href="#" class="btn btn-primary" id="submit">Telusuri</a> -->
					<script>
						document.getElementById('kirim').addEventListener('click', function(e) {
							e.preventDefault();
							Swal.fire({
								title: 'Tahap Pengembangan',
								text: 'Coming Soon.',
								icon: 'info',
							}).then(function() {
								window.location.href = '<?= $config->baseURL ?>dashboard';
							});
						});
					</script>
				</div>
				<img class="hero__img" src="<?= $config->baseURL ?>public/home/assets/el.png" alt="si El" />
			</div>

		</section>

		<!-- ADVANTAGES -->
		<section class="advantages">
			<div id="about" class="container advantages__container">
				<div class="advantages__copy">
					<h2>
						Kenalin, <?= $site_title ?>.
						<span>Data Perguruan Tinggi Wilayah yang akurat</span>
						<span>Pertama di Indonesia.</span>
					</h2>
					<p>
						<?= $site_title ?> adalah Sistem untuk mengelola Rekam Jejak Perguruan Tinggi yang terintegrasi dengan data yang bersumber dari <a href="https://pddikti.kemdikbud.go.id/">PDDikti,</a> <?= $site_title ?> di bawah naungan LLDIKTI Wilayah III. Tujuan utama dari <?= $site_title ?> adalah menyediakan platform digital yang efisien dan akurat untuk merekam dan mengelola jejak akademis serta administratif perguruan tinggi.
					</p>
				</div>
				<div class="advantages__items">
					<article class="advantages__item">
						<img src="<?= $config->baseURL ?>public/home/assets/advantages-kecerdasan-buatan.svg" alt="" />
						<div>
							<h3>Inovasi Mengelola Data Perguruan Tinggi</h3>
							<p><?= $site_title ?> bisa membantu analisa data Perguruan Tinggi sesuai kebutuhan.</p>
						</div>
					</article>
					<article class="advantages__item">
						<img src="<?= $config->baseURL ?>public/home/assets/advantages-kesehatan-cepat.svg" alt="" />
						<div>
							<h3>Tindakan data sesuai tanggal input PDDikti</span></h3>
							<p>Temukan data Perguran Tinggi sesuai tanggal input PDDikti dengan cepat.</p>
						</div>
					</article>
					<article class="advantages__item">
						<img src="<?= $config->baseURL ?>public/home/assets/advantages-kualitas-pelayanan.svg" alt="" />
						<div>
							<h3>Mengubah pelayanan secara digitalisasi</h3>
							<p><?= $site_title ?> membantu meningkatkan kualitas pelayanan dalam membantu mencari data Perguruan Tinggi.</p>
						</div>
					</article>
				</div>
			</div>
		</section>

		<!-- VISION & MISSION -->
		<section class="objectives" id="objectives">
			<div class="container objectives__container">
				<div class="objectives__copy">
					<img src="<?= $config->baseURL ?>public/home/assets/icon-quote-mark.svg" alt="" />
					<h2>Frequently Asked Questions (FAQ)</h2>
				</div>

				<div class="objectives__group">
					<article class="objectives__vision">
						<div>
							<img src="<?= $config->baseURL ?>public/home/assets/icon-quote-mark.svg" alt="" />
							<p>
								Menjadi Sistem Rekam Jejak unggulan yang mendukung keberlanjutan dan peningkatan kualitas perguruan tinggi di wilayah III.
							</p>
						</div>
					</article>

					<article class="objectives__mission">
						<div class="accordion">
							<!-- Accordion 1 -->
							<div class="accordion__item">
								<button type="button" class="accordion__button">
									<h4 class="accordion__question">Apa Keuntungan Menggunakan <?= $site_title ?>?</h4>
									<div class="accordion__icon">
										<img src="<?= $config->baseURL ?>public/home/assets/icon-expand.svg" alt="Expand icon" />
									</div>
								</button>
								<div class="accordion__collapse">
									<div class="accordion__body">
										<p class="accordion__answer">
											<?= $site_title ?> memberikan keuntungan efisiensi administrasi, akurasi data, dan dukungan strategis dalam pengelolaan akademik perguruan tinggi.
										</p>
									</div>
								</div>
							</div>

							<!-- Accordion 2 -->
							<div class="accordion__item">
								<button type="button" class="accordion__button">
									<h4 class="accordion__question">Bagaimana Cara Mengakses Catatan Telaah Akademik?</h4>
									<div class="accordion__icon">
										<img src="<?= $config->baseURL ?>public/home/assets/icon-expand.svg" alt="Expand icon" />
									</div>
								</button>
								<div class="accordion__collapse">
									<div class="accordion__body">
										<p class="accordion__answer">
											Pengguna dapat mengakses catatan telaah di atas. Untuk lebih lengkap harus melalui menu yang tersedia setelah login ke dalam sistem.
										</p>
									</div>
								</div>
							</div>

							<!-- Accordion 3 -->
							<div class="accordion__item">
								<button type="button" class="accordion__button">
									<h4 class="accordion__question">Apakah <?= $site_title ?> Mendukung Penggunaan dari Berbagai Perangkat?</h4>
									<div class="accordion__icon">
										<img src="<?= $config->baseURL ?>public/home/assets/icon-expand.svg" alt="Expand icon" />
									</div>
								</button>
								<div class="accordion__collapse">
									<div class="accordion__body">
										<p class="accordion__answer">
											Ya, <?= $site_title ?> dirancang responsif dan dapat diakses melalui berbagai perangkat, termasuk komputer, tablet, dan ponsel pintar.
										</p>
									</div>
								</div>
							</div>
						</div>
					</article>
				</div>
			</div>
		</section>

		<!-- TEAM -->
		<section class="team">
			<div id="team" class="container team__container">
				<h2>Tim <?= $site_title ?></h2>

				<div class="team__company">
					<div class="team__actions">
						<button type="button" id="staff-prev-btn">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<mask id="mask0_964_17215" style="mask-type: alpha" maskUnits="userSpaceOnUse" x="5" y="0" width="14" height="24">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M18.5484 0.939574C19.1505 1.52535 19.1505 2.47507 18.5484 3.06084L9.36091 12L18.5484 20.9391C19.1505 21.5249 19.1505 22.4746 18.5484 23.0604C17.9464 23.6462 16.9702 23.6462 16.3682 23.0604L5.00049 12L16.3682 0.939574C16.9702 0.353801 17.9464 0.353801 18.5484 0.939574Z" fill="#1688E8" />
								</mask>
								<g mask="url(#mask0_964_17215)">
									<rect x="0.000488281" y="-0.00170898" width="23.9991" height="23.9994" />
								</g>
							</svg>
						</button>
						<button class="active" type="button" id="staff-next-btn">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<mask id="mask0_964_17217" style="mask-type: alpha" maskUnits="userSpaceOnUse" x="5" y="0" width="14" height="24">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M5.45184 0.939574C4.84979 1.52535 4.84979 2.47507 5.45184 3.06084L14.6393 12L5.45184 20.9391C4.84979 21.5249 4.84979 22.4746 5.45184 23.0604C6.05389 23.6462 7.03 23.6462 7.63205 23.0604L18.9998 12L7.63205 0.939574C7.03 0.353801 6.05389 0.353801 5.45184 0.939574Z" fill="#1688E8" />
								</mask>
								<g mask="url(#mask0_964_17217)">
									<rect x="0.000488281" y="-0.00170898" width="23.9991" height="23.9994" />
								</g>
							</svg>
						</button>
					</div>
					<div class="team__staffs">
						<!-- Team 1 -->
						<div class="team__staff active">
							<div class="team__staff-info">
								<span>LEADER</span>
								<p>Arizki Putra Rahman</p>
								<img src="<?= $config->baseURL ?>public/home/assets/ueu.png" alt="Universitas Esa Unggul Logo" />
								<span>Mahasiswa Teknik Informatika<br>Universitas Esa Unggul</span>

							</div>
							<img src="<?= $config->baseURL ?>public/home/assets/arizki.png" width="430" alt="Arizki Putra Rahman" />
						</div>

						<!-- Team 2 -->
						<div class="team__staff">
							<div class="team__staff-info">
								<span>MEMBER</span>
								<p>Meryl Putra Pratama</p>
								<img src="<?= $config->baseURL ?>public/home/assets/bsi.png" alt="Universitas Bina Sarana Informatika Logo" />
								<span>Mahasiswa Sistem Informasi<br>Universitas Bina Sarana Informatika</span>
							</div>
							<img src="<?= $config->baseURL ?>public/home/assets/meryl.png" width="350" alt="Meryl Putra Pratama" />
						</div>

						<!-- Team 3 -->
						<div class="team__staff">
							<div class="team__staff-info">
								<span>MEMBER</span>
								<p>Aria Fata Abydza</p>
								<img src="<?= $config->baseURL ?>public/home/assets/ug.png" alt="Universitas Gunadarma Logo" />
								<span>Mahasiswa Teknik Informatika<br>Universitas Gunadarma</span>
							</div>
							<img src="<?= $config->baseURL ?>public/home/assets/aria.png" width="ATUR SENDIRI" alt="Aria Fata Abydza" />
						</div>
					</div>
				</div>


			</div>
		</section>

		<!-- CTA -->
		<section class="cta">
			<div class="cta__copy-container">
				<div class="container cta__copy">
					<h2>Belum punya aplikasi <?= $site_title ?>? Yuk, unduh sekarang.</h2>
					<p>Dapatkan yang terbaik dari <?= $site_title ?> dan nikmati akses ke fitur-fitur terlengkap.</p>
					<a href="#">
						<img src="<?= $config->baseURL ?>public/home/assets/cta-google-play-color.svg" alt="Get on Google Play icon" />
					</a>
				</div>
			</div>
			<!-- <div class="cta__app-preview">
				<img src="<?= $config->baseURL ?>public/home/assets/cta-mobile-app-preview.png" alt="<?= $site_title ?> mobile app preview" />
			</div> -->
			<div class="cta__app-preview">
				<img src="<?= $config->baseURL ?>public/home/assets/mobile.png" alt="<?= $site_title ?> mobile app preview" />
			</div>
		</section>

		<!-- SLOGAN -->
		<section class="slogan">
			<div class="container slogan__container">
				<h3>Bersama <span>#<?= $site_title ?></span>, Dari Jakarta Untuk Indonesia!</h3>
			</div>
		</section>
	</main>

	<!-- FOOTER -->
	<footer class="footer">
		<div id="footer" class="container footer__container">
			<div class="footer__company">
				<img src="<?= $config->baseURL ?>public/home/assets/ueu.png" alt="ueu logo" class="footer__logo" width="300" />
				<p class="footer__copyright mt-3"><?php
																					echo '© ', date('Y');
																					?>
					<a href="https://lldikti3.kemdikbud.go.id/v6/" target="_blank"><?= $site_title ?>, <?= $site_desc ?>.</a>
				</p>
			</div>

			<div class="footer__links">
				<!-- Links grop 1 -->
				<div class="footer__links-group">
					<h5>Tentang</h5>
					<ul>
						<li><a href="#" class="footer__link">Fitur</a></li>
						<li><a href="#" class="footer__link">Partner</a></li>
					</ul>
				</div>

				<!-- Links group 2 -->
				<div class="footer__links-group">
					<h5>Dukungan</h5>
					<ul>
						<li><a href="" class="footer__link">Pusat bantuan</a></li>
						<li><a href="" class="footer__link">Syarat dan ketentuan</a></li>
						<li>
							<a href="" class="footer__link">Pemberitahuan privasi</a>
						</li>
						<li><a href="" class="footer__link">Atribusi data</a></li>
						<li><a href="" class="footer__link">Pengaturan cookie</a></li>
					</ul>
				</div>

				<!-- links group 3 -->
				<div class="footer__links-group">
					<h5>Hubungi kami</h5>
					<ul>
						<li><a href="" class="footer__link">Website</a></li>
						<li><a href="" class="footer__link">Facebook</a></li>
						<li><a href="" class="footer__link">X</a></li>
						<li><a href="" class="footer__link">Instagram</a></li>
						<li><a href="" class="footer__link">LinkedIn</a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>

	<script src="<?= $config->baseURL ?>public/home/app/js/index.js"></script>
</body>

</html>