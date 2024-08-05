<?php

namespace App\Controllers;

use App\Models\HomeModel;
use App\Models\DateModel;
use App\Models\DashboardModel;

class Home extends BaseController
{
	protected $model;
	protected $modelDate;
	protected $dashboardModel;

	public function __construct()
	{
		parent::__construct();
		$this->model = new HomeModel;
		$this->modelDate = new DateModel;
		$this->dashboardModel = new DashboardModel;
	}

	public function index()
	{
		$LatestDate = $this->modelDate->getLatestTglInput();

		//Model
		$ptData = $this->model->getPTByDate($LatestDate);
		$prodiData = $this->model->getProdiByDate($LatestDate);
		$yayasanData = $this->model->getYayasanByDate($LatestDate);
		$jmlmhsData = $this->model->getJmlMhsByDate($LatestDate);

		//direct
		$this->data['ptNames'] = $this->model->getPTNames($LatestDate);
		$this->data['jml_pt'] = $ptData['jml'];
		$this->data['jml_prodi'] = $prodiData['jml'];
		$this->data['jml_yayasan'] = $yayasanData['jml'];
		$this->data['jml_mhs'] = $jmlmhsData['jml'];

		$TokenData = $this->dashboardModel->getAllToken();
		$this->data['jml_allToken'] = $TokenData['all'];
		$this->data['jml_aktifToken'] = $TokenData['active'];
		$this->data['jml_nonaktifToken'] = $TokenData['inactive'];
		$this->data['jml_user'] = $this->dashboardModel->getJmlUser();
		$this->data['latest_login'] = $this->dashboardModel->getLatestLoginLogin();

		return view('themes/modern/home', $this->data);
	}
}
