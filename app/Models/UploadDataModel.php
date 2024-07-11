<?php

namespace App\Models;
// use App\Spout;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use RuntimeException;


class UploadDataModel extends \App\Models\BaseModel
{
	public $total_row_perguruan = 0;
	public $total_row_prodi = 0;
	public function __construct()
	{
		parent::__construct();
	}

	public function uploadExcelPerguruan($tgl_input)
	{
		helper(['upload_file', 'format']);
		$path = ROOTPATH . 'public/tmp/';

		$file = $this->request->getFile('file_excel_perguruan');
		if (!$file->isValid()) {
			throw new RuntimeException($file->getErrorString() . '(' . $file->getError() . ')');
		}

		require_once 'app/ThirdParty/Spout/src/Spout/Autoloader/autoload.php';

		$filename = upload_file($path, $_FILES['file_excel_perguruan']);
		$reader = ReaderEntityFactory::createReaderFromFile($path . $filename);
		$reader->open($path . $filename);

		foreach ($reader->getSheetIterator() as $sheet) {
			$this->total_row_perguruan = 0;
			foreach ($sheet->getRowIterator() as $num_row => $row) {
				$cols = $row->toArray();

				if ($num_row == 1) {
					$field_table = $cols;
					$field_name = array_map('strtolower', $field_table);
					continue;
				}

				$data_value = [];

				foreach ($field_name as $num_col => $field) {
					$val = null;
					if (key_exists($num_col, $cols) && $cols[$num_col] != '') {
						$val = $cols[$num_col];
					}

					if ($val instanceof \DateTime) {
						$val = $val->format('Y-m-d H:i:s');
					}

					$data_value[$field] = $val;
				}

				// Tambahkan kolom tgl_input ke data
				$data_value['tgl_input'] = $tgl_input;

				$data_db[] = $data_value;
				$this->total_row_perguruan += 1;
				if ($num_row % 2000 == 0) {
					$query = $this->db->table('perguruan')->insertBatch($data_db);
					$data_db = [];
				}
			}

			if ($data_db) {
				$query = $this->db->table('perguruan')->insertBatch($data_db);
			}
		}
		$reader->close();
		delete_file($path . $filename);
	}

	public function uploadExcelProdi($tgl_input)
	{
		helper(['upload_file', 'format']);
		$path = ROOTPATH . 'public/tmp/';

		$file = $this->request->getFile('file_excel_prodi');
		if (!$file->isValid()) {
			throw new RuntimeException($file->getErrorString() . '(' . $file->getError() . ')');
		}

		require_once 'app/ThirdParty/Spout/src/Spout/Autoloader/autoload.php';

		$filename = upload_file($path, $_FILES['file_excel_prodi']);
		$reader = ReaderEntityFactory::createReaderFromFile($path . $filename);
		$reader->open($path . $filename);

		foreach ($reader->getSheetIterator() as $sheet) {
			foreach ($sheet->getRowIterator() as $num_row => $row) {
				$cols = $row->toArray();

				if ($num_row == 1) {
					$field_table = $cols;
					$field_name = array_map('strtolower', $field_table);
					continue;
				}

				$data_value = [];

				foreach ($field_name as $num_col => $field) {
					$val = null;
					if (key_exists($num_col, $cols) && $cols[$num_col] != '') {
						$val = $cols[$num_col];
					}

					if ($val instanceof \DateTime) {
						$val = $val->format('Y-m-d H:i:s');
					}

					$data_value[$field] = $val;
				}

				// Tambahkan kolom tgl_input ke data
				$data_value['tgl_input'] = $tgl_input;

				$data_db[] = $data_value;
				$this->total_row_prodi += 1;
				if ($num_row % 2000 == 0) {
					$query = $this->db->table('prodi')->insertBatch($data_db);
					$data_db = [];
				}
			}

			if ($data_db) {
				$query = $this->db->table('prodi')->insertBatch($data_db);
			}
		}
		$reader->close();
		delete_file($path . $filename);

		$result = ['status' => '', 'content'];
		if ($query) {
			$result['status'] = 'ok';
			$result['content'] = 'Data berhasil di masukkan ke dalam tabel <strong>PT sebanyak ' . format_ribuan($this->total_row_perguruan) . ' baris dan Prodi sebanyak ' . format_ribuan($this->total_row_prodi) . ' baris</strong>';
		}

		return $result;
	}
}
