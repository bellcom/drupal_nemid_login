<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Transport;

use Signaturgruppen\SPS\Crypto\Certificate;

class SecurityHandler
{
    private $sender;
    private $recipient;

    public function __construct(Certificate $sender, Certificate $recipient)
    {
        $this->sender = $sender;
        $this->recipient = $recipient;
    }

    public function wrap(Envelope $envelope)
    {
        $envelope->serializeBody();
        $this->encrypt($envelope);
        $this->sign($envelope);
    }

    private function encrypt(Envelope $envelope)
    {
        if ($envelope->mustEncrypt()) {
            $handler = new EncryptionHandler($this->recipient);
            $handler->encrypt($envelope);
        }
    }

    private function sign(Envelope $envelope)
    {
        if ($envelope->mustSign()) {
            $handler = new SignatureHandler($this->sender);
            $handler->sign($envelope);
        }
    }

    public function unwrap(Envelope $envelope)
    {
        $this->assertTimestampValid($envelope);
        $this->verify($envelope);
        $this->decrypt($envelope);
        $envelope->deserializeBody();
    }

    private function assertTimestampValid(Envelope $envelope)
    {
        if ($envelope->isExpired()) {
            throw new \Exception("Envelope timestamp has expired or is not yet valid");
        }
    }

    private function verify(Envelope $envelope)
    {
        if ($envelope->mustSign()) {
            $handler = new SignatureHandler($this->sender);
            $handler->verify($envelope);
        }
    }

    private function decrypt(Envelope $envelope)
    {
        if ($envelope->mustEncrypt()) {
            $handler = new EncryptionHandler($this->recipient);
            $handler->decrypt($envelope);
        }
    }

}