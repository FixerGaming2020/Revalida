<?php

/**
 * Description of Encriptador
 *
 * @author Emanuel
 */
class Encriptador {

    private $iv;

    public function __construct() {
        $this->iv = NULL;
    }

    public function encriptar($datos, $clave) {
        $encryption_key = base64_decode($clave);
        $this->iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($datos, 'aes-256-cbc', $encryption_key, 0, $this->iv);
        return base64_encode($encrypted . '::' . $this->iv);
    }

    public function desencriptar($datos, $clave) {
        $encryption_key = base64_decode($clave);
        list($encrypted_data, $this->iv) = explode('::', base64_decode($datos), 2);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $this->iv);
    }

}
