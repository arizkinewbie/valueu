<?php
namespace App\Models;

class PtTablesModel extends \App\Models\BaseModel
{

    public function getPerguruan() 
    {
        $sql = 'SELECT * FROM perguruan';
        $result = $this->db->query($sql)->getResultArray();
        return $result;
    }

    public function getPerguruanById($id) {
        $sql = 'SELECT * FROM perguruan WHERE id_pt = ?';
        $result = $this->db->query($sql, trim($id))->getRowArray();
        return $result;
    }

    public function saveData() {
        
        helper('upload_file');
        
        $exp = explode('-', $_POST['tgl_kadal_aipt']);
        $tgl_kadal_aipt = $exp[2].'-'.$exp[1].'-'.$exp[0];
        $data_db['kode_pt'] = $_POST['kode_pt'];
        $data_db['nama_pt'] = $_POST['nama_pt'];
        $data_db['smt_awal_pt'] = $_POST['smt_awal_pt'];
        $data_db['jml_prodi'] = $_POST['jml_prodi'];
        $data_db['smt_lapor'] = $_POST['smt_lapor'];
        $data_db['persen_lapor'] = $_POST['persen_lapor'];
        $data_db['tgl_kadal_aipt'] = $tgl_kadal_aipt;
        $data_db['aipt'] = $_POST['aipt'];
        $data_db['jml_mhs'] = $_POST['jml_mhs'];
        $data_db['rasio_mhs'] = $_POST['rasio_mhs'];
        $data_db['jml_dosen_rasio'] = $_POST['jml_dosen_rasio'];
        $data_db['jml_dosen_tetap_pt'] = $_POST['jml_dosen_tetap_pt'];
        $data_db['yayasan'] = $_POST['yayasan'];
        $data_db['alamat_yayasan'] = $_POST['alamat_yayasan'];
        
        if ($_POST['id']) 
        {
            $data_db['tgl_edit'] = date('Y-m-d');
            $data_db['id_user_edit'] = $_SESSION['user']['id_user'];
            $query = $this->db->table('perguruan')->update($data_db, ['id_pt' => $_POST['id']]);
            if ($query) {
                $result['msg']['status'] = 'ok';
                $result['msg']['content'] = 'Data berhasil disimpan';
            } else {
                $result['msg']['status'] = 'error';
                $result['msg']['content'] = 'Data gagal disimpan';
            }   
        } 
        return $result;
    }
}
?>
