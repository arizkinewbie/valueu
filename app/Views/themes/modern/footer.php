	</div><!-- cotent-wrapper -->
	</div><!-- cotent -->
	</div><!-- site-content -->
	<footer class="shadow">
		<div class="footer-copyright">
			<div class="wrapper">
				<!-- 
				<a href="https://lldikti3.kemdikbud.go.id/v6/" target="_blank">Lembaga Layanan Pendidikan Tinggi Wilayah III</a> -->
				<?php $footer = $settingAplikasi['footer_login'] ? str_replace('{{YEAR}}', date('Y'), html_entity_decode($settingAplikasi['footer_login'])) : '';
				echo $footer;
				?>
			</div>
		</div>
	</footer>
	</body>

	</html>