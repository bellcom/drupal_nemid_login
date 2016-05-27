<?php

namespace Signaturgruppen\SPS\Api\Services\Document {

    use Signaturgruppen\SPS\Api\Webservice;
    use Signaturgruppen\SPS\Transport\WebserviceClient;

    abstract class DocumentWebservice implements Webservice
    {
        protected $client;

        /**
         * @param WebserviceClient $client
         */
        public function __construct(WebserviceClient $client)
        {
            $this->client = $client;
        }

        public function getEndpoint()
        {
            return "Document";
        }

        /**
         * @param DocumentCreateRequest $request
         * @return DocumentCreateResponse
         */
        public abstract function create(DocumentCreateRequest $request);

        /**
         * @param DocumentRequest $request
         * @return DocumentDataResponse
         */
        public abstract function getDocument(DocumentRequest $request);

        /**
         * @param DocumentSummaryRequest $request
         * @return DocumentQueryResponse
         */
        public abstract function getDocumentSummary(DocumentSummaryRequest $request);

        /**
         * @param IdentityQueryRequest $request
         * @return DocumentQueryResponse
         */
        public abstract function getByIdentity(IdentityQueryRequest $request);

        /**
         * @param DocumentAllRequest $request
         * @return DocumentQueryResponse
         */
        public abstract function getAll(DocumentAllRequest $request);

        /**
         * @param DocumentPendingRequest $request
         * @return DocumentQueryResponse
         */
        public abstract function getPending(DocumentPendingRequest $request);

        /**
         * @param DocumentSignedRequest $request
         * @return DocumentQueryResponse
         */
        public abstract function getSigned(DocumentSignedRequest $request);

        /**
         * @param DocumentRequest $request
         * @return DocumentDeleteResponse
         */
        public abstract function delete(DocumentRequest $request);

    }
}

