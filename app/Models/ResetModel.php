<?php
namespace App\Models;

class ResetModel extends \App\Models\BaseModel
{
	protected $table = 'perguruan';
	
	public function __construct() {
		parent::__construct();
	}
	public function getPTNames($selectedYear) {
		$sql = 'SELECT DISTINCT nama_pt FROM perguruan WHERE tgl_input = ? ORDER BY nama_pt ASC';
		$result = $this->db->query($sql, [$selectedYear])->getResultArray();
		return $result;
	}
	public function getProdiNames($selectedYear) {
		$sql = 'SELECT DISTINCT nama_prodi FROM prodi WHERE tgl_input = ? ORDER BY nama_prodi ASC';
		$result = $this->db->query($sql, [$selectedYear])->getResultArray();
		return $result;
	}
	public function deleteDataByYear($table, $year)
    {
        $this->db->table($table)->where('YEAR(tgl_input)', $year)->delete();
    }
	public function getData($table, $year)
    {
        
        $allowedTables = ['perguruan', 'prodi'];
        if (!in_array($table, $allowedTables)) {
            throw new \InvalidArgumentException('Tabel tidak valid.');
        }

        $this->table = $table;
        $result = $this->db->table($table)->where('YEAR(tgl_input)', $year)->get()->getResultArray();
        return $result;
    }
}