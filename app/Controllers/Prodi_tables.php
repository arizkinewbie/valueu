<?php
namespace App\Controllers;
use App\Models\ProdiTablesModel;
use App\Models\DateModel;

class Prodi_tables extends \App\Controllers\BaseController
{

	public function __construct() {
		
		parent::__construct();

		$this->model = new ProdiTablesModel;
		$this->modelDate = new DateModel;
		$this->table = 'prodi';	
		$this->data['site_title'] = 'Data Tables';
		
		$this->addJs ( $this->config->baseURL . 'public/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js' );
		$this->addJs ( $this->config->baseURL . 'public/themes/modern/js/date-picker.js');
		$this->addJs ( $this->config->baseURL . 'public/themes/modern/js/image-upload.js');
		
		// Data Tables - Script utama ada di app/Views/themes/modern/header.php
		$this->addJs ( $this->config->baseURL . 'public/vendors/datatables/extensions/Buttons/js/dataTables.buttons.min.js');
		$this->addJs ( $this->config->baseURL . 'public/vendors/datatables/extensions/Buttons/js/buttons.bootstrap5.min.js');
		$this->addJs ( $this->config->baseURL . 'public/vendors/datatables/extensions/JSZip/jszip.min.js');
		$this->addJs ( $this->config->baseURL . 'public/vendors/datatables/extensions/pdfmake/pdfmake.min.js');
		$this->addJs ( $this->config->baseURL . 'public/vendors/datatables/extensions/pdfmake/vfs_fonts.js');
		$this->addJs ( $this->config->baseURL . 'public/vendors/datatables/extensions/Buttons/js/buttons.html5.min.js');
		$this->addJs ( $this->config->baseURL . 'public/vendors/datatables/extensions/Buttons/js/buttons.print.min.js');
		$this->addStyle ( $this->config->baseURL . 'public/vendors/datatables/extensions/Buttons/css/buttons.bootstrap5.min.css');
		$this->addJs ( $this->config->baseURL . 'public/themes/modern/js/data-tables-prodi.js');
		// -- Data Tables
		
		$this->addStyle ( $this->config->baseURL . 'public/vendors/bootstrap-datepicker/css/bootstrap-datepicker3.css');
		
	}
	
	public function index()
	{
		$this->data['tglInput'] = $this->modelDate->getTglInput($this->table);
		$this->hasPermissionPrefix('update', 'perguruan');
		$data = $this->data;
		if (empty($this->request->getGet('date'))) {
			$url = current_url() . '?date=all';
			return redirect()->to($url);
		}

		$condition = $this->request->getGet('date');
		if ($condition == 'all' OR empty($condition)) {
			$data['result'] = $this->model->getProdi();
		} else {
			$selectedDate = $condition;
			$data['result'] = $this->modelDate->getDataByDate($this->table,$selectedDate);
		}
		$this->view('prodi-tables.php', $data);
	}
	
	public function edit()
	{
		$this->hasPermissionPrefix('update', 'prodi');
		
		$this->data['title'] = 'Edit ' . $this->currentModule['judul_module'];;
		$data = $this->data;
		
		if (empty($_GET['id'])) {
			$this->errorDataNotFound();
			return;
		}
				
		// Submit
		$data['msg'] = [];
		if (isset($_POST['submit'])) 
		{
			// $form_errors = validate_form();
			$form_errors = false;
							
			if ($form_errors) {
				$data['msg']['status'] = 'error';
				$data['msg']['content'] = $form_errors;
			} else {
				
				// $query = false;
				$message = $this->model->saveData();
				$data = array_merge($data, $message);
			}
		}
		
		$data['breadcrumb']['Edit'] = '';
		
		$data_prodi = $this->model->getProdiById($_GET['id']);
		if (empty($data_prodi)) {
			$this->errorDataNotFound();
			return;
		}
		$data = array_merge($data, $data_prodi);
		$this->view('upload-form-prodi.php', $data);
	}

	public function delete()
    {
		$condition = $this->request->getGet('date');
		if ($condition == 'all' OR empty($condition)) {
			$result = $this->modelDate->deleteAllData($this->table);
		} else {
			$selectedDate = $condition;
			$result = $this->modelDate->deleteDataByDate($this->table, $selectedDate);
		}
        $currentURL = current_url();
		$urlParts = explode('/', $currentURL);
		// Buat ulang URL hingga setelah '/delete'
		$desiredURL = $urlParts[0] . '//' . $urlParts[2] . '/' . $urlParts[3];
		return redirect()->to($desiredURL)->with('message', 'Semua data Prodi berhasil dihapus');
    }

	public function backup()
	{
		// buat backup data by date
	}
}