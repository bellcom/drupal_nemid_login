<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Crypto;

class Certificate
{
    private $cert;
    private $privateKey;

    public function __construct($pem, $isPKCS12)
    {
        if ($isPKCS12) {
            $p12 = null;
            if (!openssl_pkcs12_read(base64_decode($pem), $p12, "notasecret")) {
                throw new \Exception("Cannot read PKCS#12");
            };
            $this->cert = $p12["cert"];
            $this->privateKey = $p12["pkey"];
        } else {
            $this->cert = "-----BEGIN CERTIFICATE-----\n" . chunk_split($pem, 64, "\n") . "-----END CERTIFICATE-----";
        }
    }

    /**
     * @param string $plainText
     * @return string
     * @throws \Exception
     */
    public function encrypt($plainText)
    {
        $encrypted = null;
        $res = openssl_public_encrypt($plainText, $encrypted, $this->cert, OPENSSL_PKCS1_OAEP_PADDING);
        if (!($res)) {
            throw new \Exception("Could not encrypt data: " . openssl_error_string());
        }
        return $encrypted;
    }

    /**
     * @param string $cipherText
     * @return string
     * @throws \Exception
     */
    public function decrypt($cipherText)
    {
        $decrypted = null;
        $res = openssl_private_decrypt($cipherText, $decrypted, $this->privateKey, OPENSSL_PKCS1_OAEP_PADDING);
        if (!($res)) {
            throw new \Exception("Unable to decrypt string: " . openssl_error_string());
        }
        return $decrypted;
    }

    /**
     * @param string $data
     * @return string
     * @throws \Exception
     */
    public function sign($data)
    {
        $signature = null;
        $signed = openssl_sign($data, $signature, $this->privateKey, OPENSSL_ALGO_SHA256);
        if (!$signed) {
            throw new \Exception("Unable to create signature");
        }
        return base64_encode($signature);
    }

    /**
     * @param string $data
     * @param string $signature
     * @throws \Exception
     */
    public function verify($data, $signature)
    {
        $decoded = base64_decode($signature);
        $verified = openssl_verify($data, $decoded, $this->cert, OPENSSL_ALGO_SHA256);
        if ($verified != 1) {
            throw new \Exception("Signature invalid");
        }
    }

    public function getName()
    {
        $values = openssl_x509_parse($this->cert);
        return $values["name"];
    }
}