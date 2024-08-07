<?php

namespace App\Models;

use App\Libraries\JWT as JWT;

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

    public function addToken($data)
    {
        try {
            $this->db->table($this->table)->insert($data);
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

    public function verifyToken($token)
    {
        $jwt = new JWT();
        //check if token expired or not
        if ($this->db->table($this->table)->where('token', $token)->where('expired <', date('Y-m-d H:i:s'))->get()->getRowArray()) {
            $status = 400;
            $msg = 'Dokumen sudah kadaluarsa. Silahkan hubungi pihak terkait';
            $data = [];
        }
        //check if token status block
        else if ($this->db->table($this->table)->where('token', $token)->where('status', 1)->get()->getRowArray()) {
            $status = 400;
            $msg = 'Dokumen telah diblokir. Silahkan hubungi pihak terkait';
            $data = [];
        }
        // check if token exist
        else if ($this->db->table($this->table)->where('token', $token)->where('status', 0)->where('expired >', date('Y-m-d H:i:s'))->get()->getRowArray()) {
            $status = 200;
            $msg = 'Data dokumen tersedia';
            $data = $jwt->decode($token);
        } else {
            $status = 500;
            $msg = 'Dokumen tidak ditemukan. Silahkan hubungi pihak terkait';
            $data = [];
        }
        return $data = [
            'status' => $status,
            'message' => $msg,
            'data' => $data
        ];
    }

    public function blockToken()
    {
        $token = $_POST['token'];
        //check if token already status block
        if ($this->db->table($this->table)->where('token', $token)->where('status', 1)->get()->getRowArray()) {
            $result['msg']['status'] = 'warning';
            $result['msg']['content'] = 'Token sudah diblokir sebelumnya';
            // $result['msg']['redirect'] = true;
            return $result;
        }
        //check if token nothing
        if (!$this->db->table($this->table)->where('token', $token)->where('status', 0)->get()->getRowArray()) {
            $result['msg']['status'] = 'error';
            $result['msg']['content'] = 'Token tidak ditemukan';
            return $result;
        }
        $data = $this->db->table($this->table)->where('token', $token)->update(['status' => 1, 'dtime' => date('Y-m-d H:i:s'), 'duser' => $_SESSION['user']['id_user']]);
        if (!$data) {
            $result['msg']['status'] = 'error';
            $result['msg']['content'] = 'Token gagal diblokir';
        } else {
            $result['msg']['status'] = 'ok';
            $result['msg']['content'] = 'Token berhasil diblokir';
            $result['msg']['redirect'] = true;
        }
        return $result;
    }
}
