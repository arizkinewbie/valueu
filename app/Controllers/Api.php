<?php

namespace App\Controllers;

use App\Models\HomeModel;
use App\Models\TokenModel;
use App\Models\DashboardModel;

class Api extends BaseController
{
	protected $model;

	public function __construct()
	{
		parent::__construct();
		$this->model = new HomeModel;
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

	public function infoToken()
	{
		$model = new DashboardModel();
		try {
			$data = $model->getAllToken();
			$data = [
				'status' => 200,
				'message' => 'Data tersedia',
				'data' => [
					'all' => $data['all'],
					'active' => $data['active'],
					'blocked' => $data['inactive'],
				]
			];
		} catch (\Exception $e) {
			$data = [
				'status' => 500,
				'error' => $e->getMessage(),
				'message' => 'Terjadi kesalahan! data tidak tersedia',
				'data' => []
			];
		}
		return $this->response->setJSON($data);
	}

	public function blockToken()
	{
		$token = new TokenModel();
		try {
			$tokenData = $_GET['token'];
			$data = $token->blockToken($tokenData);
			$data = [
				'status' => 200,
				'message' => $data['msg']['content'],
				'data' => [
					'token' => $tokenData,
				],
			];
		} catch (\Exception $e) {
			$data = [
				'status' => 500,
				'error' => $e->getMessage(),
				'message' => 'Terjadi kesalahan! silahkan coba lagi',
				'data' => []
			];
		}
		return $this->response->setJSON($data);
	}
}
