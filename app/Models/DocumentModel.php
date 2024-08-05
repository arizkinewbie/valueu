<?php

namespace App\Models;

class DocumentModel extends \App\Models\BaseModel
{
  protected $table = 'token';
  protected $primaryKey = 'id_token';

  public function getUsers()
  {
    $sql = 'SELECT * FROM user';
    $result = $this->db->query($sql)->getResultArray();
    return $result;
  }

  public function addDocument()
  {
  }
}
