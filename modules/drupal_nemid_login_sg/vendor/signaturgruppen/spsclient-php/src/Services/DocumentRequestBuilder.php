<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Services;

use Signaturgruppen\SPS\Api\Services\Document\DocumentCreateRequest;
use Signaturgruppen\SPS\Api\Services\Document\ToBeSigned;
use Signaturgruppen\SPS\Api\Services\Document\ToBeSignedType;
use Signaturgruppen\SPS\Configuration\Config;
use Signaturgruppen\SPS\Transport\WebserviceClient;

class DocumentRequestBuilder
{
    /**
     * @var DocumentCreateRequest
     */
    public $Request;

    /**
     * @param $pdfBytes
     * @param string $title
     * @return DocumentRequestBuilder
     */
    public static function withPdf($pdfBytes, $title = "Empty")
    {
        $result = new DocumentRequestBuilder();
        $toBeSigned = new ToBeSigned();
        $toBeSigned->Type = ToBeSignedType::Pdf;
        $toBeSigned->DocumentBytes = base64_encode($pdfBytes);
        $result->Request->ToBeSignedDocument = $toBeSigned;
        $result->Request->Title = $title;
        return $result;
    }

    public function __construct()
    {
        $this->Request = new DocumentCreateRequest();
        $this->Request->RequiredSigners = array();
        $this->Request->RequireStrongIdentification = false;
        $this->Request->AllowNonRequiredSigners = false;
    }

    public function withSignerId($id)
    {
        $builder = new SignerBuilder();
        $signer = $builder->withId($id)->build();
        array_push($this->Request->RequiredSigners, $signer);
        return $this;
    }

    public function invoke()
    {
        $config = Config::getDefault();
        $stub = new DocumentWebserviceStub(WebserviceClient::fromConfig($config));
        $response = $stub->create($this->Request);

        return $response->Guid;
    }
}