<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Crypto;

use Signaturgruppen\SPS\Transport\Mapper;

class KeyAndIv
{
    /**
     * @param string $wrapped
     * @param Certificate $recipient
     * @return KeyAndIv
     * @throws \Exception
     */
    public static function unwrap($wrapped, Certificate $recipient)
    {
        $cipherText = base64_decode($wrapped);
        $plain = $recipient->decrypt($cipherText);
        return Mapper::deserialize($plain, new KeyAndIv());
    }

    /**
     * @param $rawKey
     * @param $rawIv
     * @return KeyAndIv
     */
    public static function fromRaw($rawKey, $rawIv)
    {
        $res = new KeyAndIv();
        $res->key = base64_encode($rawKey);
        $res->iv = base64_encode($rawIv);
        return $res;
    }

    /*
     * Base64 encoded key
     * @var string
     */
    public $key;

    /*
     * Base64 encoded iv
     * @var string
     */
    public $iv;

    /**
     * Encrypt this key and iv to recipient
     * @param Certificate $recipient
     * @return mixed
     * @throws \Exception
     */
    public function wrap(Certificate $recipient)
    {
        $json = json_encode($this);
        $cipherText = $recipient->encrypt($json);
        return base64_encode($cipherText);
    }

    public function decodeKey()
    {
        return base64_decode($this->key);
    }

    public function decodeIv()
    {
        return base64_decode($this->iv);
    }

}