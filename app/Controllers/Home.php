<?php

namespace App\Controllers;

use App\Models\HomeModel;
use App\Models\DateModel;

class Home extends BaseController
{
	public function __construct()
	{
		parent::__construct();
		$this->model = new HomeModel;
		$this->modelDate = new DateModel;
	}

	public function index()
	{
		$this->data['site_title'] = 'Home for Public';
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

		return view('themes/modern/home', $this->data);
	}
}
