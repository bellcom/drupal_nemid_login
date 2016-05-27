<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Transport;

use Signaturgruppen\SPS\Crypto\AESCipher;
use Signaturgruppen\SPS\Crypto\Certificate;
use Signaturgruppen\SPS\Crypto\KeyAndIv;

class EncryptionHandler
{
    private $recipient;

    public function __construct(Certificate $recipient)
    {
        $this->recipient = $recipient;
    }

    public function encrypt(Envelope $envelope)
    {
        if ($envelope->EncryptedKey != null) {
            throw new \Exception("Envelope already encrypted");
        }
        if ($envelope->BodySerialized == null) {
            throw new \Exception("Body must be serialized before encryption");
        }
        $cipher = new AESCipher();
        $iv = $cipher->generateIv();

        $cipherText = $cipher->encrypt($envelope->BodySerialized, $iv);
        $envelope->BodySerialized = $cipherText;

        $keyAndIv = KeyAndIv::fromRaw($cipher->getKey(), $iv);
        $envelope->EncryptedKey = $keyAndIv->wrap($this->recipient);
    }

    public function decrypt(Envelope $envelope)
    {
        if ($envelope->EncryptedKey == null) {
            throw new \Exception("Envelope not encrypted");
        }
        $keyAndIv = KeyAndIv::unwrap($envelope->EncryptedKey, $this->recipient);

        $cipher = AESCipher::withKey($keyAndIv->decodeKey());
        $cipherText = $envelope->BodySerialized;

        $plainText = $cipher->decrypt($cipherText, $keyAndIv->decodeIv());
        $envelope->BodySerialized = $plainText;
        $envelope->EncryptedKey = null;
    }


}