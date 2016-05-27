<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Services;

use Signaturgruppen\SPS\Api\Services\Document\DocumentAllRequest;
use Signaturgruppen\SPS\Configuration\Config;
use Signaturgruppen\SPS\Transport\WebserviceClient;

class DocumentApiClient
{
    /**
     * @param $pdfBytes
     * @return DocumentRequestBuilder
     */
    public function createPdfDocument($pdfBytes)
    {
        return DocumentRequestBuilder::withPdf($pdfBytes);
    }

    public function getAll()
    {
        $stub = $this->getStub();
        return $stub->getAll(new DocumentAllRequest());
    }

    /**
     * @return DocumentWebserviceStub
     */
    private function getStub()
    {
        $config = Config::getDefault();
        $stub = new DocumentWebserviceStub(WebserviceClient::fromConfig($config));
        return $stub;
    }

}