<?php

namespace App\Libraries;

class JWT
{
	protected $key;
	public function __construct()
	{
		require_once ROOTPATH . 'app/ThirdParty/PHPJwt/autoload.php';
		$this->key = env('JWT_KEY');
	}

	public function encode($data)
	{
		$jwt = new \Firebase\JWT\JWT();
		return $jwt->encode($data, $this->key, 'HS256');
	}

	public function decode($token)
	{
		$jwt = new \Firebase\JWT\JWT();
		$key = new \Firebase\JWT\Key($this->key, 'HS256');
		return $jwt->decode($token, $key);
	}
}
