<?php
// final --> a class that can't be extended by other classes
final class Encryption {
	private $key;

	public function __construct($key) {
		$this->key = hash('sha256', $key, true);
	}

	// public function encrypt($value) {
	// 	return strtr(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, hash('sha256', $this->key, true), $value, MCRYPT_MODE_ECB)), '+/=', '-_,');
	// }

	// public function decrypt($value) {
	// 	return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, hash('sha256', $this->key, true), base64_decode(strtr($value, '-_,', '+/=')), MCRYPT_MODE_ECB));
	// }

	public function encrypt($value) {
		return strtr(base64_encode(openssl_encrypt($value, 'aes-256-ecb', hash('sha256', $this->key, true), OPENSSL_RAW_DATA)), '+/=', '-_,');
	}

	public function decrypt($value) {
		return trim(openssl_decrypt(base64_decode(strtr($value, '-_,', '+/=')), 'aes-256-ecb', hash('sha256', $this->key, true), OPENSSL_RAW_DATA));
	}
}
