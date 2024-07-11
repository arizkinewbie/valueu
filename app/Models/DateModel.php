<?php

namespace App\Models;

class DateModel extends \App\Models\BaseModel
{
    protected $table = 'perguruan';
    public function getTglInput($table)
    {
        $query = $this->db->table($table) // Use the table property to set the table
            ->distinct()
            ->select('tgl_input')
            ->orderBy('tgl_input', 'desc')
            ->get();
        return $query->getResultArray();
    }

    public function getLatestTglInput()
    {
        $builder = $this->db->table('perguruan');
        $builder->selectMax('tgl_input', 'tgl_input');

        $result = $builder->get()->getRow();

        if ($result) {
            return $result->tgl_input;
        } else {
            return null;
        }
    }

    public function getTglInputYear($table)
    {
        $query = $this->db->table($table) // Use the table property to set the table
            ->distinct()
            ->select('YEAR(tgl_input) as year') // Ambil tahun dari tgl_input
            ->orderBy('year', 'desc') // Urutkan berdasarkan tahun
            ->get();

        return $query->getResultArray();
    }

    public function getLatestTglInputYear()
    {
        $builder = $this->db->table('perguruan');
        $builder->select('YEAR(MAX(tgl_input)) as year');

        $result = $builder->get()->getRow();

        if ($result) {
            return $result->year;
        } else {
            return null;
        }
    }

    public function getDataByDate($table, $tglInputSelect)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE tgl_input = ?';
        $result = $this->db->query($sql, [$tglInputSelect])->getResultArray();
        return $result;
    }

    public function deleteAllData($table)
    {
        $sql = 'DELETE FROM ' . $table;
        $result = $this->db->query($sql);
        return $result;
    }

    public function deleteDataByDate($table, $tglInputSelect)
    {
        $sql = 'DELETE FROM ' . $table . ' WHERE tgl_input = ?';
        $result = $this->db->query($sql, [$tglInputSelect]);
        return $result;
    }

    public function deleteDataByYear($table, $tglInputYearSelect)
    {
        $sql = 'DELETE FROM ' . $table . ' WHERE YEAR(tgl_input) = ?';
        $result = $this->db->query($sql, [$tglInputYearSelect]);
        return $result;
    }

    public function backupAllData($table)
    {
        $sql = 'INSERT INTO ' . $table . '_backup SELECT * FROM ' . $table;
        $result = $this->db->query($sql);
        return $result;
    }

    public function backupDataByDate($table, $tglInputSelect)
    {
        $sql = 'INSERT INTO ' . $table . '_backup SELECT * FROM ' . $table . ' WHERE tgl_input = ?';
        $result = $this->db->query($sql, [$tglInputSelect]);
        return $result;
    }
}
