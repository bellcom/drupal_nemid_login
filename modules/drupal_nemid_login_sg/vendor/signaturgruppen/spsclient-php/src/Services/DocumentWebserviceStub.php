<?php
/*
* Copyright (c) 2016, Signaturgruppen A/S <info@signaturgruppen.dk>.
* All rights reserved.
* @license    See separate agreement regarding license information
*/

namespace Signaturgruppen\SPS\Services;


use Signaturgruppen\SPS\Api\Services\Document\DocumentAllRequest;
use Signaturgruppen\SPS\Api\Services\Document\DocumentCompletedRequest;
use Signaturgruppen\SPS\Api\Services\Document\DocumentCreateRequest;
use Signaturgruppen\SPS\Api\Services\Document\DocumentCreateResponse;
use Signaturgruppen\SPS\Api\Services\Document\DocumentDeleteResponse;
use Signaturgruppen\SPS\Api\Services\Document\DocumentInfoResponse;
use Signaturgruppen\SPS\Api\Services\Document\DocumentPendingRequest;
use Signaturgruppen\SPS\Api\Services\Document\DocumentQueryResponse;
use Signaturgruppen\SPS\Api\Services\Document\DocumentRequest;
use Signaturgruppen\SPS\Api\Services\Document\DocumentWebservice;
use Signaturgruppen\SPS\Api\Services\Document\IdentityQueryRequest;

class DocumentWebserviceStub extends DocumentWebservice
{

    /**
     * @param DocumentCreateRequest $request
     * @return DocumentCreateResponse
     */
    public function create(DocumentCreateRequest $request)
    {
        return $this->client->invoke($request, $this, "Create");
    }

    /**
     * @param DocumentRequest $request
     * @return DocumentInfoResponse
     */
    public function getDocumentInfo(DocumentRequest $request)
    {
        return $this->client->invoke($request, $this, "GetDocumentInfo");
    }

    /**
     * @param DocumentRequest $request
     * @return DocumentDeleteResponse
     */
    public function delete(DocumentRequest $request)
    {
        return $this->client->invoke($request, $this, "Delete");
    }

    /**
     * @param DocumentRequest $request
     * @return DocumentInfoResponse
     */
    public function getInfo(DocumentRequest $request)
    {
        return $this->client->invoke($request, $this, "GetInfo");
    }

    /**
     * @param IdentityQueryRequest $request
     * @return DocumentQueryResponse
     */
    public function getByIdentity(IdentityQueryRequest $request)
    {
        return $this->client->invoke($request, $this, "GetByIdentity");
    }

    /**
     * @param DocumentAllRequest $request
     * @return DocumentQueryResponse
     */
    public function getAll(DocumentAllRequest $request)
    {
        return $this->client->invoke($request, $this, "GetAll");
    }

    /**
     * @param DocumentPendingRequest $request
     * @return DocumentQueryResponse
     */
    public function getPending(DocumentPendingRequest $request)
    {
        return $this->client->invoke($request, $this, "GetPending");
    }

    /**
     * @param DocumentCompletedRequest $request
     * @return DocumentQueryResponse
     */
    public function getCompleted(DocumentCompletedRequest $request)
    {
        return $this->client->invoke($request, $this, "GetCompleted");
    }
}