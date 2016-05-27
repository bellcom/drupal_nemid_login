<?php

namespace Signaturgruppen\SPS\Api\Services\Document {

    use Signaturgruppen\SPS\Api\Body;

    class DocumentQueryResponse extends Body
    {
        public function mustEncrypt()
        {
            return true;
        }

        public function mustSign()
        {
            return true;
        }

        /**
         * @var DocumentSummary[]
         */
        public $QueryResult;

    };
}

