<?php

namespace App\Models;

class HomeModel extends \App\Models\BaseModel
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

	public function getPTNames($selectedDate)
	{
		$sql = 'SELECT DISTINCT nama_pt FROM perguruan WHERE tgl_input = ? ORDER BY nama_pt ASC';
		$result = $this->db->query($sql, [$selectedDate])->getResultArray();
		return $result;
	}
}
