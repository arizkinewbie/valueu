<?php
namespace App\Controllers;
use App\Models\DashboardModel;
use App\Models\DateModel;

class Dashboard extends BaseController
{
	public function __construct() {
		parent::__construct();
		$this->model = new DashboardModel;
		$this->modelDate = new DateModel;
		
		$this->addJs($this->config->baseURL . 'public/vendors/chartjs/chart.js');
		$this->addStyle($this->config->baseURL . 'public/vendors/material-icons/css.css');
		$this->addStyle($this->config->baseURL . 'public/themes/modern/css/dashboard.css');
		$this->addJs($this->config->baseURL . 'public/themes/modern/js/dashboard.js');
	}
	
	public function index()
    {
        // Memanggil model untuk mendapatkan data
		$this->data['tglInput'] = $this->modelDate->getTglInput('perguruan');

		// Tambahkan ini untuk mengambil nilai default dari model
		$defaultDate = $this->modelDate->getLatestTglInput();

		// Tambahkan parameter "date" ke URL jika belum ada
		if (empty($this->request->getGet('date'))) {
			$url = current_url() . '?date=' . urlencode($defaultDate);
			return redirect()->to($url);
		}

		$selectedDate = $this->request->getGet('date');
		$ptData = $this->model->getPTByDate($selectedDate);
		$prodiData = $this->model->getProdiByDate($selectedDate);
		$yayasanData = $this->model->getYayasanByDate($selectedDate);
		$jmlmhsData = $this->model->getJmlMhsByDate($selectedDate);
		
		$this->data['site_title'] = 'Dashboard';

        $this->data['jml_pt'] = $ptData['jml'];
		$this->data['jml_prodi'] = $prodiData['jml'];
		$this->data['jml_yayasan'] = $yayasanData['jml'];
		$this->data['jml_mhs'] = $jmlmhsData['jml'];
        // Menampilkan view
        $this->view('dashboard', $this->data);
    }
}