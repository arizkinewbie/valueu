<?php

namespace App\Controllers;

use App\Models\UploadDataModel;

class Upload_data extends BaseController
{
	protected $model;

	public function __construct()
	{
		parent::__construct();
		$this->model = new UploadDataModel;

		$this->data['title'] = 'Upload Data Perguruan Tinggi dan Program Studi';
		$this->addJs($this->config->baseURL . 'public/themes/modern/js/uploadexcel.js');
	}

	public function index()
	{
		if (isset($_POST['submit'])) {
			$form_errors = $this->validateForm();
			$tgl_input = $this->request->getPost('tgl_input');
			if ($form_errors) {
				$this->data['message']['status'] = 'error';
				$this->data['message']['content'] = $form_errors;
			} else {
				$this->model->uploadExcelPerguruan($tgl_input);
				$this->data['message'] = $this->model->uploadExcelProdi($tgl_input);
			}
		}

		$this->view('upload-data.php', $this->data);
	}

	function validateForm()
	{

		$form_errors = [];

		if ($_FILES['file_excel_perguruan']['name']) {
			$file_type = $_FILES['file_excel_perguruan']['type'];
			$allowed = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

			if (!in_array($file_type, $allowed)) {
				$form_errors['file_excel_perguruan'] = 'Tipe file harus .xlsx';
			}
		} else {
			$form_errors['file_excel_perguruan'] = 'File excel PT belum dipilih';
		}

		if ($_FILES['file_excel_prodi']['name']) {
			$file_type = $_FILES['file_excel_prodi']['type'];
			$allowed = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

			if (!in_array($file_type, $allowed)) {
				$form_errors['file_excel_prodi'] = 'Tipe file harus .xlsx';
			}
		} else {
			$form_errors['file_excel_prodi'] = 'File excel Prodi belum dipilih';
		}

		return $form_errors;
	}
}
