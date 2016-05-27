<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Services;


use Signaturgruppen\SPS\Api\Services\Document\RequiredSigner;
use Signaturgruppen\SPS\Api\Services\Document\SignerIdentity;
use Signaturgruppen\SPS\Api\Services\Document\SignerIdentityType;

class SignerBuilder
{
    /**
     * @var RequiredSigner;
     */
    private $signer;

    public function __construct()
    {
        $this->signer = new RequiredSigner();
        $this->signer->Identities = array();
    }

    /**
     * @param $pid
     * @return SignerBuilder
     */
    public function withPid($pid)
    {
        return $this->withIdentity(SignerIdentityType::NemIdPid, $pid);
    }

    /**
     * @param $id
     * @return SignerBuilder
     */
    public function withId($id)
    {
        return $this->withIdentity(SignerIdentityType::SignerIdentifier, $id);
    }

    /**
     * @return RequiredSigner
     */
    public function build()
    {
        return $this->signer;
    }


    /**
     * @param $type
     * @param $value
     * @return SignerBuilder
     */
    public function withIdentity($type, $value)
    {
        $id = new SignerIdentity();
        $id->Type = $type;
        $id->Value = $value;
        array_push($this->signer->Identities, $id);
        return $this;
    }

}