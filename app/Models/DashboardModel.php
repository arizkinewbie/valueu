<?php

namespace App\Models;

class DashboardModel extends \App\Models\BaseModel
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getPTByDate($tglInput)
	{
		$sql = "SELECT COUNT(nama_pt) AS jml FROM perguruan WHERE tgl_input = ?";
		return $this->db->query($sql, [$tglInput])->getRowArray();
	}

	public function getProdiByDate($tglInput)
	{
		$sql = "SELECT SUM(jml_prodi) AS jml FROM perguruan WHERE tgl_input = ?";
		return $this->db->query($sql, [$tglInput])->getRowArray();
	}

	public function getYayasanByDate($tglInput)
	{
		$sql = "SELECT COUNT(DISTINCT yayasan) AS jml FROM perguruan WHERE tgl_input = ?";
		return $this->db->query($sql, [$tglInput])->getRowArray();
	}

	public function getJmlMhsByDate($tglInput)
	{
		$sql = "SELECT SUM(jml_mhs) AS jml FROM perguruan WHERE tgl_input = ?";
		return $this->db->query($sql, [$tglInput])->getRowArray();
	}

	public function getLatestLoginLogin()
	{
		$sql = "
			SELECT ula.id, ula.id_user, ula.time, ula.ip, ula.agent, u.nama, u.email
			FROM user_login_activity ula
			LEFT JOIN user u ON ula.id_user = u.id_user
			ORDER BY ula.id DESC
			LIMIT 10
		";
		return $this->db->query($sql)->getResultArray();
	}
}
