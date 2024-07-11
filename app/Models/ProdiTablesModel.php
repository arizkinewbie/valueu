<?php
namespace App\Models;

class ProdiTablesModel extends \App\Models\BaseModel
{
	public function getProdi() 
	{
		$sql = 'SELECT * FROM prodi';
		$result = $this->db->query($sql)->getResultArray();
		return $result;
	}
	
	public function getProdiById($id) {
		$sql = 'SELECT * FROM prodi WHERE id_prodi = ?';
		$result = $this->db->query($sql, trim($id))->getRowArray();
		return $result;
	}
	
	public function saveData() {
		
		helper('upload_file');
		
		$exp = explode('-', $_POST['tgl_kadal_aps']);
		$tgl_kadal_aps = $exp[2].'-'.$exp[1].'-'.$exp[0];
		$data_db['kode_pt'] = $_POST['kode_pt'];
		$data_db['nama_pt'] = $_POST['nama_pt'];
		$data_db['jenjang'] = $_POST['jenjang'];
		$data_db['kode_prodi'] = $_POST['kode_prodi'];
		$data_db['nama_prodi'] = $_POST['nama_prodi'];
		$data_db['smt_awal_prodi'] = $_POST['smt_awal_prodi'];
		$data_db['tgl_kadal_aps'] = $tgl_kadal_aps;
		$data_db['aps'] = $_POST['aps'];
		$data_db['jml_mhs_prodi'] = $_POST['jml_mhs_prodi'];
		$data_db['rasio_mhs_prodi'] = $_POST['rasio_mhs_prodi'];
		$data_db['jml_dosen_rasio'] = $_POST['jml_dosen_rasio'];
		$data_db['jml_dosen_tetap_prodi'] = $_POST['jml_dosen_tetap_prodi'];
		$data_db['lap_akhir'] = $_POST['lap_akhir'];
		
		if ($_POST['id']) 
		{
			$data_db['tgl_edit'] = date('Y-m-d');
			$data_db['id_user_edit'] = $_SESSION['user']['id_user'];
			$query = $this->db->table('prodi')->update($data_db, ['id_prodi' => $_POST['id']]);
			if ($query) {
				$result['msg']['status'] = 'ok';
				$result['msg']['content'] = 'Data berhasil disimpan';
			} else {
				$result['msg']['status'] = 'error';
				$result['msg']['content'] = 'Data gagal disimpan';
			}
			
		} else {
			
			// $data_db['tgl_input'] = date('Y-m-d');
			// $data_db['id_user_input'] = $_SESSION['user']['id_user'];
			// $query = $this->db->table('prodi')->insert($data_db);
			// $result['id_prodi'] = '';
			// if ($query) {
			// 	$result['msg']['status'] = 'ok';
			// 	$result['msg']['content'] = 'Data berhasil disimpan';
			// 	$result['id_prodi'] = $this->db->insertID();
			// } else {
			// 	$result['msg']['status'] = 'error';
			// 	$result['msg']['content'] = 'Data gagal disimpan';
			// }
		}
		
		return $result;
	}
}
?>