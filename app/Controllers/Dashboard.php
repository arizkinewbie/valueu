<?php

namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\DateModel;

class Dashboard extends BaseController
{
	protected $model;
	public function __construct()
	{
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
		$TokenData = $this->model->getAllToken();

		$this->data['site_title'] = 'Dashboard';

		$this->data['jml_allToken'] = $TokenData['all'];
		$this->data['jml_aktifToken'] = $TokenData['active'];
		$this->data['jml_nonaktifToken'] = $TokenData['inactive'];
		$this->data['jml_user'] = $this->model->getJmlUser();
		$this->data['latest_login'] = $this->model->getLatestLoginLogin();
		// dd($this->data);
		// Menampilkan view
		$this->view('dashboard', $this->data);
	}
}
