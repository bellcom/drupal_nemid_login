<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Transport;


use Signaturgruppen\SPS\Crypto\Certificate;

class SignatureHandler
{
    private $signer;

    public function __construct(Certificate $certificate)
    {
        $this->signer = $certificate;
    }

    public function sign(Envelope $envelope)
    {
        $digestString = $this->getDigestString($envelope);
        $envelope->Signature = $this->signer->sign($digestString);
    }

    public function verify(Envelope $envelope)
    {
        $digestString = $this->getDigestString($envelope);
        $this->signer->verify($digestString, $envelope->Signature);
    }

    /**
     * @param Envelope $envelope
     * @return string
     * @throws \Exception
     */
    public function getDigestString(Envelope $envelope)
    {
        $props = get_object_vars($envelope);
        unset($props["Signature"]);
        unset($props["body"]);

        if (!ksort($props, SORT_STRING | SORT_FLAG_CASE)) {
            throw new \Exception("Unable to sort params");
        }
        $digestString = "";
        foreach ($props as $key => $value) {
            $digestString .= $key . $value;
        }
        return $digestString;
    }

}