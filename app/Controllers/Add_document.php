<?php

namespace App\Controllers;

use App\Models\DocumentModel;
use App\Models\TokenModel;

class Add_document extends \App\Controllers\BaseController
{
  protected $model;
  private $formValidation;

  public function __construct()
  {

    parent::__construct();

    $this->model = new DocumentModel;
    $this->data['site_title'] = 'Data Dokumen';

    $this->addJs($this->config->baseURL . 'public/vendors/jquery.select2/js/select2.full.min.js');
    $this->addStyle($this->config->baseURL . 'public/vendors/jquery.select2/css/select2.min.css');
    $this->addStyle($this->config->baseURL . 'public/vendors/jquery.select2/bootstrap-5-theme/select2-bootstrap-5-theme.min.css');

    $this->addJs($this->config->baseURL . 'public/themes/modern/js/add-document.js');
    $this->addJs($this->config->baseURL . 'public/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js');
    $this->addJs($this->config->baseURL . 'public/themes/modern/js/date-picker.js');
    $this->addJs('https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js');
    $this->addStyle($this->config->baseURL . 'public/vendors/bootstrap-datepicker/css/bootstrap-datepicker3.css');
  }

  public function index()
  {
    $this->hasPermissionPrefix('create');
    $data = $this->data;
    $data['title'] = 'Pengesahan Dokumen';
    $data['msg'] = [];
    $data_options = $this->setDataOptions();
    $data = array_merge($data, $data_options);
    //when submit
    if (isset($_POST['submit'])) {
      // $form_errors = validate_form();
      $form_errors = false;
      if ($form_errors) {
        $data['msg']['status'] = 'error';
        $data['msg']['content'] = $form_errors;
      } else {
        // $query = false;
        //SAVE
        $jwt = new \App\Libraries\JWT();
        $user_name = $_SESSION['user']['nama'];
        $id = $_SESSION['user']['id_user'];
        $tglTerbit = date('Y-m-d', strtotime($_POST['tgl_terbit']));
        $tglBerlaku = !empty($_POST['tgl_berlaku']) ? date('Y-m-d', strtotime($_POST['tgl_berlaku'])) : null;
        $dataForm = [
          'tgl_terbit' => format_tanggal($tglTerbit),
          'nomor' => $_POST['nomor'],
          'hal' => $_POST['hal'],
          'pengaju' => $_POST['pengaju'],
          'tgl_berlaku' => $tglBerlaku ? format_tanggal($tglBerlaku) : 'selamanya',
          'keterangan' => $_POST['keterangan'],
          'iss' => $user_name,
          'iat' => time(),
        ];
        $token = $jwt->encode($dataForm);
        $dataToken = [
          'token' => $token,
          'no_surat' => $dataForm['nomor'],
          'expired' => $tglBerlaku,
          'status' => 0,
          'ctime' => date('Y-m-d H:i:s'),
          'cuser' => $id,
        ];
        $tokenModel = new TokenModel();
        $isSave = $tokenModel->addToken($dataToken);
        if ($isSave) {
          $data['msg']['status'] = 'ok';
          $data['msg']['content'] = 'Data berhasil disimpan';
          $data['jwtoken'] = $token;
        } else {
          $data['msg']['status'] = 'error';
          $data['msg']['content'] = 'Data gagal disimpan';
        }
      }
    }
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
