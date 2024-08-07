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
		$data = $this->data;
		if (empty($_GET['token'])) {
			$token = 'default';
		} else {
			$token = $_GET['token'];
		}
		$data['result'] = '';
		$dataToken = [
			'status' => 200,
			'data' => [
				'name' => 'token',
				'value' => '123',
				'token' => $token ?? '',
				'pengaju' => '123',
			]
		];
		return json_encode($dataToken);
	}
}
