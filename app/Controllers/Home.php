<?php

namespace App\Controllers;

use App\Models\HomeModel;
use App\Models\DateModel;
use App\Models\DashboardModel;

class Home extends BaseController
{
	protected $model;
	protected $dashboardModel;

	public function __construct()
	{
		parent::__construct();
		$this->model = new HomeModel;
		$this->dashboardModel = new DashboardModel;
	}

	public function index()
	{
		$data = $this->data;
		$TokenData = $this->dashboardModel->getAllToken();
		$data['jml_allToken'] = $TokenData['all'];
		$data['jml_aktifToken'] = $TokenData['active'];
		$data['jml_nonaktifToken'] = $TokenData['inactive'];
		$data['jml_user'] = $this->dashboardModel->getJmlUser();
		$data['latest_login'] = $this->dashboardModel->getLatestLoginLogin();

		return view('themes/modern/home', $data);
	}

	public function check()
	{
		$jwt = new \App\Libraries\JWT();
		$data = $this->data;
		try {
			$token = $_GET['token'];
			$data = $jwt->decode($token);
			$dataToken = [
				'status' => 200,
				'message' => 'Data dokumen tersedia',
				'data' => $data
			];
		} catch (\Exception $e) {
			$dataToken = [
				'status' => 500,
				'error' => $e->getMessage(),
				'message' => 'Terjadi kesalahan, data dokumen tidak tersedia',
				'data' => []
			];
		}
		return json_encode($dataToken);
	}
}
