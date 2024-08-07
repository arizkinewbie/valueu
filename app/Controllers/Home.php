<?php

namespace App\Controllers;

use App\Models\HomeModel;
use App\Models\TokenModel;
use App\Models\DashboardModel;

class Home extends BaseController
{
	protected $model;
	protected $dashboardModel;
	protected $tokenModel;

	public function __construct()
	{
		parent::__construct();
		$this->model = new HomeModel;
		$this->dashboardModel = new DashboardModel;
		$this->tokenModel = new TokenModel;
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
		$token = new TokenModel();
		try {
			$tokenData = $_GET['token'];
			$dataToken = $token->verifyToken($tokenData);
		} catch (\Exception $e) {
			$dataToken = [
				'status' => 500,
				'error' => $e->getMessage(),
				'message' => 'Terjadi kesalahan! data tidak tersedia',
				'data' => []
			];
		}
		return $this->response->setJSON($dataToken);
	}
}
