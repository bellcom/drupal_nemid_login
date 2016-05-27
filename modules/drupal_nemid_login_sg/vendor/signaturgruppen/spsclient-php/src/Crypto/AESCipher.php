<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Crypto;

define('AES_256_CBC', 'aes-256-cbc');

class AESCipher
{
    private $key;

    public function __construct()
    {
        $this->key = openssl_random_pseudo_bytes(32);
    }

    /**
     * @param $key
     * @return AESCipher
     * @throws \Exception
     */
    public static function withKey($key)
    {
        if (strlen($key) != 32) {
            throw new \Exception("Wrong key size");
        }
        $instance = new static();
        $instance->key = $key;
        return $instance;
    }

    /**
     * @return string
     */
    public function generateIv()
    {
        return openssl_random_pseudo_bytes(openssl_cipher_iv_length(AES_256_CBC));
    }

    public function encrypt($plainText, $iv)
    {
        return openssl_encrypt($plainText, AES_256_CBC, $this->key, 0, $iv);
    }

    public function decrypt($cipherText, $iv)
    {
        return openssl_decrypt($cipherText, AES_256_CBC, $this->key, 0, $iv);
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

}