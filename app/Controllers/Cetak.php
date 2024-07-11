<?php

namespace App\Controllers;

use App\Models\CetakModel;
use App\Models\DateModel;

class Cetak extends BaseController
{
	protected $model;

	public function __construct()
	{
		parent::__construct();
		$this->model = new CetakModel;
		$this->modelDate = new DateModel;
		$this->addJs($this->config->baseURL . 'public/vendors/bootstrap-select/dist/js/bootstrap-select.min.js');
		// $this->addJs($this->config->baseURL . 'public/vendors/bootstrap-select/ddist/js/i18n/defaults-*.min.js');
		$this->addStyle($this->config->baseURL . 'public/vendors/bootstrap-select/dist/css/bootstrap-select.min.css');
	}

	public function index()
	{
		$this->data['title'] = 'Cetak Data';
		$this->data['tglInput'] = $this->modelDate->getTglInput('perguruan');

		// Tambahkan ini untuk mengambil nilai default dari model
		$defaultDate = $this->modelDate->getLatestTglInput();

		// Tambahkan parameter "date" ke URL jika belum ada
		// if (empty($this->request->getGet('date'))) {
		// 	$url = current_url() . '?date=' . urlencode($defaultDate);
		// 	return redirect()->to($url);
		// }

		$selectedDate = $this->request->getGet('date');
		$selectedYayasan = $this->request->getGet('yayasanSelect');
		$this->data['yayasanNames'] = $this->model->getYayasanNames($selectedDate);
		$this->data['ptNames'] = $this->model->getPTNames($selectedDate, $selectedYayasan);

		if (isset($_GET['submit'])) {
			$usedTglInput = $this->request->getGet('date');
			$this->data['selectedYayasan'] = $this->request->getGet('yayasanSelect');
			$selectedPT = $this->data['selectedPT'] = $this->request->getGet('ptSelect');
			$telaahOption = $this->request->getGet('telaahOption');
			$this->data['telaahOption'] = $telaahOption;
			$selectedValues = $this->request->getGet('selectedValues');
			$usedPT_Array = explode(',', $selectedValues);

			// Mengurutkan selectedValues dengan memulai dari selectedPT
			if ($telaahOption == 'Telaah PT') {
				if (($key = array_search($selectedPT, $usedPT_Array)) !== false) {
					unset($usedPT_Array[$key]);
				}
				array_unshift($usedPT_Array, $selectedPT);
			}

			// manipulasi data untuk ditampilkan di view
			$PTData = [];
			$ProdiData = [];
			foreach ($usedPT_Array as $usedPTValues) {
				$PTData[] = $this->model->getDataPT($usedTglInput, $usedPTValues);
				$ProdiData[] = $this->model->getDataProdi($usedTglInput, $usedPTValues);
			}
			$this->data['PT'] = $PTData;
			$this->data['Prodi'] = $ProdiData;

			// Manipulasi total PT dan nama PT untuk ditampilkan di catatan telaah
			$this->data['TotalPT'] = count($usedPT_Array);
			if (count($usedPT_Array) == 1) {
				$this->data['T_PTArray'] = $usedPT_Array[0];
			} else {
				// Gabungkan semua elemen kecuali yang terakhir dengan koma dan spasi
				$this->data['T_PTArray'] = implode(', ', array_slice($usedPT_Array, 0, -1));
				// Tambahkan "dan" diikuti dengan elemen terakhir
				$this->data['T_PTArray'] .= " dan " . end($usedPT_Array);
			}

			require_once ROOTPATH . 'app/ThirdParty/MPdf/autoload.php';
			$mpdf = new \Mpdf\Mpdf([
				'mode' => 'utf-8',
				'format' => 'A4',
				'margin_left' => 12, 7,
				'margin_right' => 12, 7,
				'margin_top' => 17, 8,
				'margin_bottom' => 17, 8,
				'orientation' => 'P'
			]);
			$mpdf->SetWatermarkImage('public/images/watermark.png', 0.2);
			$mpdf->showWatermarkImage = true;
			$mpdf->SetAuthor($_ENV['Author']);
			$mpdf->SetSubject('Cetak Telaah dari Sistem Rekam Jejak Perguruan Tinggi (' . $_ENV['Author'] . ')');
			$mpdf->SetTitle(base64_decode('Rm9ybSAyIDogVGVsYWFoIFJla2FtIEplamFr'));
			$mpdf->SetKeywords(base64_decode('UFQsIFlheWFzYW4sIFRlbGFhaCwgUERGLCBTaVJlSmFr'));
			$mpdf->SetCreator(base64_decode('QXJpemtpIFB1dHJhIFJhaG1hbg=='));
			$html = view('themes/modern/cetak-result', $this->data);
			$html2 = view('themes/modern/cetak-footer', $this->data);
			$mpdf->WriteHTML($html);
			$mpdf->AddPage();
			$mpdf->WriteHTML($html2);
			if ($telaahOption == 'Telaah Yayasan') {

				$mpdf->Output('Telaah Rekam Jejak - ' . $this->data['selectedYayasan'] . '.pdf', 'I');
			} else {
				$mpdf->Output('Telaah Rekam Jejak - ' . $this->data['selectedPT'] . '.pdf', 'I');
			}
			exit();
		}
		$this->view('cetak', $this->data);
	}
}
