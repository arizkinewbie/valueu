<?php

namespace App\Models;

class TokenModel extends \App\Models\BaseModel
{
    protected $table = 'token';

    public function getAllToken($filterstatus = null, $filterUser = null)
    {
        $query = $this->db->table($this->table)
            ->select($this->table . '.*, user.nama as creator')
            ->join('user', 'user.id_user = ' . $this->table . '.cuser', 'left');
        if ($filterstatus != null) {
            $query->where($this->table . '.status', $filterstatus);
        }
        if ($filterUser != null) {
            $query->where('user.id_user = ', $filterUser);
        }
        $query->orderBy($this->table . '.id_token', 'DESC');
        $data = $query->get()->getResultArray();
        return $data;
    }

    public function verifyToken($token)
    {
    }

    public function blockToken($token)
    {
        $data = $this->db->table($this->table)->where('token', $token)->update(['status' => 1]);
        if ($data == 0) {
            throw new \CodeIgniter\Database\Exceptions\DataException('Token not found');
        }
        return $data;
    }
}
