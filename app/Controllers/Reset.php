<?php

namespace App\Controllers;

use App\Models\ResetModel;
use App\Models\DateModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\writer\xlsx;

class Reset extends BaseController
{
	protected $model;

	public function __construct()
	{
		parent::__construct();
		$this->model = new ResetModel;
		$this->modelDate = new DateModel;
		$this->addJs($this->config->baseURL . 'public/vendors/bootstrap-select/dist/js/bootstrap-select.min.js');
		// $this->addJs($this->config->baseURL . 'public/vendors/bootstrap-select/ddist/js/i18n/defaults-*.min.js');
		$this->addStyle($this->config->baseURL . 'public/vendors/bootstrap-select/dist/css/bootstrap-select.min.css');
	}

	public function index()
	{
		$tabel_options = [
			'prodi' => 'Prodi',
			'perguruan' => 'Perguruan',
		];

		// Menyediakan variabel $tabel_options ke dalam view
		$this->data['tabel_options'] = $tabel_options;
		$this->data['title'] = 'Reset Data';
		$this->data['tglInput'] = $this->modelDate->getTglInput('perguruan');
		$this->data['tglInput'] = $this->modelDate->getTglInput('prodi');

		// Tambahkan ini untuk mengambil nilai default dari model
		$defaultDate = $this->modelDate->getLatestTglInputYear();

		// Tambahkan parameter "date" ke URL jika belum ada
		if (empty($this->request->getGet('date'))) {
			$url = current_url() . '?date=' . urlencode($defaultDate);
			return redirect()->to($url);
		}

		$selectedYear = $this->request->getGet('year');
		$this->data['ptNames'] = $this->model->getPTNames($selectedYear);
		$this->data['prodiNames'] = $this->model->getProdiNames($selectedYear);
		$this->view('reset', $this->data);
	}
	public function delete()
	{
		$selectedYear = $this->request->getGet('date');
		// $selectedTable = $this->request->getGet('table'); 
		//jika mau seperti ini harus ditambahkan form pilih table
		// if (!$selectedTable) {
		// 	$selectedTable = 'perguruan';
		// 	$selectedTable = 'prodi';
		// }

		// $this->model->deleteDataByYear($selectedTable, $selectedYear);

		$this->model->deleteDataByYear('prodi', $selectedYear);
		$this->model->deleteDataByYear('perguruan', $selectedYear);
		return redirect()->to(base_url('/upload-data'));
	}
	public function backup()
	{
		$selectedYear = $this->request->getGet('date');
		$perguruan = $this->model->getData('perguruan', $selectedYear);

		require_once ROOTPATH . 'app/ThirdParty/PHPSpreadsheet/autoload.php';
		$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet;

		$sheetPT = $spreadsheet->getActiveSheet();

		$sheetPT->setCellValue('A1', "kode_pt");
		$sheetPT->setCellValue('B1', "nama_pt");
		$sheetPT->setCellValue('C1', "smt_awal_pt");
		$sheetPT->setCellValue('D1', "jml_prodi");
		$sheetPT->setCellValue('E1', "smt_lapor");
		$sheetPT->setCellValue('F1', "persen_lapor");
		$sheetPT->setCellValue('G1', "tgl_kadal_aipt");
		$sheetPT->setCellValue('H1', "aipt");
		$sheetPT->setCellValue('I1', "jml_mhs");
		$sheetPT->setCellValue('J1', "rasio_mhs");
		$sheetPT->setCellValue('K1', "jml_dosen_rasio");
		$sheetPT->setCellValue('L1', "jml_dosen_tetap_pt");
		$sheetPT->setCellValue('M1', "yayasan");
		$sheetPT->setCellValue('N1', "alamat_yayasan");

		$numRowPT = 2;

		foreach ($perguruan as $row) :
			$sheetPT->setCellValue('A' . $numRowPT, $row['kode_pt']);
			$sheetPT->setCellValue('B' . $numRowPT, $row['nama_pt']);
			$sheetPT->setCellValue('C' . $numRowPT, $row['smt_awal_pt']);
			$sheetPT->setCellValue('D' . $numRowPT, $row['jml_prodi']);
			$sheetPT->setCellValue('E' . $numRowPT, $row['smt_lapor']);
			$sheetPT->setCellValue('F' . $numRowPT, $row['persen_lapor']);
			$sheetPT->setCellValue('G' . $numRowPT, $row['tgl_kadal_aipt']);
			$sheetPT->setCellValue('H' . $numRowPT, $row['aipt']);
			$sheetPT->setCellValue('I' . $numRowPT, $row['jml_mhs']);
			$sheetPT->setCellValue('J' . $numRowPT, $row['rasio_mhs']);
			$sheetPT->setCellValue('K' . $numRowPT, $row['jml_dosen_rasio']);
			$sheetPT->setCellValue('L' . $numRowPT, $row['jml_dosen_tetap_pt']);
			$sheetPT->setCellValue('M' . $numRowPT, $row['yayasan']);
			$sheetPT->setCellValue('N' . $numRowPT, $row['alamat_yayasan']);

			$numRowPT++;
		endforeach;

		$sheetPT->getDefaultColumnDimension()->setAutoSize(true);

		$spreadsheet->setActiveSheetIndex(0);
		$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="[' . $selectedYear . '] Backup Data PT.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
		redirect()->back();
		exit();
	}
	public function backupProdi()
	{
		$selectedYear = $this->request->getGet('date');
		$prodi = $this->model->getData('prodi', $selectedYear);

		require_once ROOTPATH . 'app/ThirdParty/PHPSpreadsheet/autoload.php';
		$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet;

		$sheetProdi = $spreadsheet->getActiveSheet();

		$sheetProdi->setCellValue('A1', "kode_pt");
		$sheetProdi->setCellValue('B1', "nama_pt");
		$sheetProdi->setCellValue('C1', "jenjang");
		$sheetProdi->setCellValue('D1', "kode_prodi");
		$sheetProdi->setCellValue('E1', "nama_prodi");
		$sheetProdi->setCellValue('F1', "smt_awal_prodi");
		$sheetProdi->setCellValue('G1', "tgl_kadal_aps");
		$sheetProdi->setCellValue('H1', "aps");
		$sheetProdi->setCellValue('I1', "jml_mhs_prodi");
		$sheetProdi->setCellValue('J1', "rasio_mhs_prodi");
		$sheetProdi->setCellValue('K1', "jml_dosen_rasio");
		$sheetProdi->setCellValue('L1', "jml_dosen_tetap_prodi");
		$sheetProdi->setCellValue('M1', "lap_akhir");

		$numRowProdi = 2;

		foreach ($prodi as $row) :
			$sheetProdi->setCellValue('A' . $numRowProdi, $row['kode_pt']);
			$sheetProdi->setCellValue('B' . $numRowProdi, $row['nama_pt']);
			$sheetProdi->setCellValue('C' . $numRowProdi, $row['jenjang']);
			$sheetProdi->setCellValue('D' . $numRowProdi, $row['kode_prodi']);
			$sheetProdi->setCellValue('E' . $numRowProdi, $row['nama_prodi']);
			$sheetProdi->setCellValue('F' . $numRowProdi, $row['smt_awal_prodi']);
			$sheetProdi->setCellValue('G' . $numRowProdi, $row['tgl_kadal_aps']);
			$sheetProdi->setCellValue('H' . $numRowProdi, $row['aps']);
			$sheetProdi->setCellValue('I' . $numRowProdi, $row['jml_mhs_prodi']);
			$sheetProdi->setCellValue('J' . $numRowProdi, $row['rasio_mhs_prodi']);
			$sheetProdi->setCellValue('K' . $numRowProdi, $row['jml_dosen_rasio']);
			$sheetProdi->setCellValue('L' . $numRowProdi, $row['jml_dosen_tetap_prodi']);
			$sheetProdi->setCellValue('M' . $numRowProdi, $row['lap_akhir']);

			$numRowProdi++;
		endforeach;

		$sheetProdi->getDefaultColumnDimension()->setAutoSize(true);

		$spreadsheet->setActiveSheetIndex(0);
		$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="[' . $selectedYear . '] Backup Data Prodi.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
		redirect()->back();
		exit();
	}
}
