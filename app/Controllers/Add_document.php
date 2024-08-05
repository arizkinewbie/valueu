<?php

namespace App\Controllers;

use App\Models\DocumentModel;

class Add_document extends \App\Controllers\BaseController
{
  protected $model;
  private $formValidation;

  public function __construct()
  {

    parent::__construct();
    // $this->mustLoggedIn();

    $this->model = new DocumentModel;
    $this->data['site_title'] = 'Data Dokumen';

    $this->addJs($this->config->baseURL . 'public/vendors/jquery.select2/js/select2.full.min.js');
    $this->addStyle($this->config->baseURL . 'public/vendors/jquery.select2/css/select2.min.css');
    $this->addStyle($this->config->baseURL . 'public/vendors/jquery.select2/bootstrap-5-theme/select2-bootstrap-5-theme.min.css');

    $this->addJs($this->config->baseURL . 'public/themes/modern/js/add-document.js');
    $this->addJs($this->config->baseURL . 'public/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js');
    $this->addJs($this->config->baseURL . 'public/themes/modern/js/date-picker.js');
    $this->addStyle($this->config->baseURL . 'public/vendors/bootstrap-datepicker/css/bootstrap-datepicker3.css');
  }

  // public function index()
  // {
  //   $this->hasPermissionPrefix('read');

  //   $data = $this->data;
  //   if (!empty($_POST['delete'])) {

  //     $result = $this->model->deleteData();

  //     // $result = true;
  //     if ($result) {
  //       $data['msg'] = ['status' => 'ok', 'message' => 'Data akta berhasil dihapus'];
  //     } else {
  //       $data['msg'] = ['status' => 'error', 'message' => 'Data akta gagal dihapus'];
  //     }
  //   }

  //   $data_akta = $this->model->getData();
  //   $data['result'] = $data_akta['data_akta'];
  //   $data['akta_file'] = $data_akta['akta_file'];

  //   if (!$data['result']) {
  //     $data['msg']['status'] = 'error';
  //     $data['msg']['content'] = 'Data tidak ditemukan';
  //   }

  //   $this->view('options-dinamis-result.php', $data);
  // }

  public function index()
  {
    $this->hasPermissionPrefix('create');

    $data = $this->data;
    $data['title'] = 'Pengesahan Dokumen';

    // Submit
    $data['msg'] = [];
    if (isset($_POST['submit'])) {
      // $form_errors = validate_form();
      $form_errors = false;

      if ($form_errors) {
        $data['msg']['status'] = 'error';
        $data['msg']['content'] = $form_errors;
      } else {

        // $query = false;
        $isSave = $this->model->saveData();

        if ($isSave) {
          $data['msg']['status'] = 'ok';
          $data['msg']['content'] = 'Data berhasil disimpan';
        } else {
          $data['msg']['status'] = 'error';
          $data['msg']['content'] = 'Data gagal disimpan';
        }
      }
    }
    $data_options = $this->setDataOptions();
    $data = array_merge($data, $data_options);

    $this->view('add-document-form.php', $data);
  }

  private function setDataOptions()
  {
    $result = $this->model->getUsers();
    $users = [];
    foreach ($result as $val) {
      $users[$val['id_user']] = $val['nama'];
    }
    $data['users'] = $users;
    return $data;
  }

  private function validateForm()
  {

    $validation =  \Config\Services::validation();
    $validation->setRule('nama_penghadap[]', 'Nama Penghadap', 'trim|required');
    $validation->withRequest($this->request)->run();
    $form_errors = $validation->getErrors();

    return $form_errors;
  }
}
