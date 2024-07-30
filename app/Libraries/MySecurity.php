<?php

namespace App\Libraries;

class MySecurity
{
	private const SALT = '5ipl-h35714b0ARD';
	private const IV = 'b24af491ab32f2bc';
	private const ITERATIONS = 999;

	public static function encrypt($passphrase, $plainText)
	{
		$key = hash_pbkdf2("sha256", $passphrase, self::SALT, self::ITERATIONS, 64, true);
		return bin2hex(openssl_encrypt($plainText, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, self::IV));
	}

	public static function decrypt($passphrase, $encryptedTextHex)
	{
		$key = hash_pbkdf2("sha256", $passphrase, self::SALT, self::ITERATIONS, 64, true);
		return openssl_decrypt(hex2bin($encryptedTextHex), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, self::IV);
	}
}
