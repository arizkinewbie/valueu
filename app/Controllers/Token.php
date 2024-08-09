<?php

namespace App\Controllers;

use App\Models\PtTablesModel;
use App\Models\DateModel;
use App\Models\TokenModel;
use CodeIgniter\Encryption\Encryption;

class Token extends \App\Controllers\BaseController
{
	protected $tokenModel;

	public function __construct()
	{

		parent::__construct();

		$this->modelDate = new DateModel;
		$this->tokenModel = new TokenModel;
		$this->table = 'perguruan';
		$this->data['site_title'] = 'Data Tables';

		// Data Tables - Script utama ada di app/Views/themes/modern/header.php
		$this->addJs($this->config->baseURL . 'public/vendors/datatables/extensions/Buttons/js/dataTables.buttons.min.js');
		$this->addJs($this->config->baseURL . 'public/vendors/datatables/extensions/Buttons/js/buttons.bootstrap5.min.js');
		$this->addJs($this->config->baseURL . 'public/vendors/datatables/extensions/pdfmake/vfs_fonts.js');
		$this->addJs($this->config->baseURL . 'public/vendors/datatables/extensions/Buttons/js/buttons.html5.min.js');
		$this->addJs($this->config->baseURL . 'public/vendors/datatables/extensions/Buttons/js/buttons.print.min.js');
		$this->addStyle($this->config->baseURL . 'public/vendors/datatables/extensions/Buttons/css/buttons.bootstrap5.min.css');
		$this->addJs($this->config->baseURL . 'public/themes/modern/js/data-tables-token.js');
		$this->addJs($this->config->baseURL . 'public/themes/modern/js/token.js');
		$this->addJs('https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js');
	}

	public function index()
	{
		$data = $this->data;
		$this->hasPermissionPrefix('read', 'token');
		$data['title'] = 'Riwayat pengesahan dokumen';
		$data['result'] = $this->tokenModel->getAllToken();
		$this->view('token.php', $data);
	}

	public function check()
	{
		$data = $this->data;
		if (empty($_GET['token'])) {
			$this->errorDataNotFound();
			return;
		}
		$token = $_GET['token'];
		$data['result'] = '';
		$this->view('token.php', $data);
	}
}
