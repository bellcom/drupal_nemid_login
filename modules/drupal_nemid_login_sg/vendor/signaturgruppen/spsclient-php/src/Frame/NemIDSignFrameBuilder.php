<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Frame;


use Signaturgruppen\SPS\Api\Frame\ClientFlow;
use Signaturgruppen\SPS\Api\Frame\NemID\NemIDSignFlowConfig;
use Signaturgruppen\SPS\Api\Services\Document\ToBeSigned;
use Signaturgruppen\SPS\Api\Services\Document\ToBeSignedType;

class NemIDSignFrameBuilder extends NemIDFrameBuilder
{
    public function __construct()
    {
        parent::__construct();
        $this->config = new NemIDSignFlowConfig();
        $this->config->UseLimitedMode = true;
        $this->config->ClientFlow = ClientFlow::NemIDSignature;
    }

    /**
     * @return NemIDSignFlowConfig
     */
    private function getConfig()
    {
        return $this->config;
    }

    /**
     * Define PDF document to sign
     * @param $pdfBytes
     * @return $this
     */
    public function signPdf($pdfBytes)
    {
        $toBeSigned = new ToBeSigned();
        $toBeSigned->DocumentBytes = base64_encode($pdfBytes);
        $toBeSigned->Type = ToBeSignedType::Pdf;
        $this->getConfig()->ToBeSigned = $toBeSigned;
        return $this;
    }

    /**
     * Define plain text to sign
     * @param $text  string to sign
     * @return $this
     */
    public function signText($text)
    {
        $toBeSigned = new ToBeSigned();
        $toBeSigned->DocumentBytes = base64_encode($text);
        $toBeSigned->Type = ToBeSignedType::Text;
        $this->getConfig()->ToBeSigned = $toBeSigned;
        return $this;
    }
}