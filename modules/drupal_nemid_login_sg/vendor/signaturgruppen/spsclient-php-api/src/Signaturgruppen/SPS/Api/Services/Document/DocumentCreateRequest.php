<?php

namespace Signaturgruppen\SPS\Api\Services\Document {

    use Signaturgruppen\SPS\Api\Body;

    class DocumentCreateRequest extends Body
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
         * @var RequiredSigner[]
         */
        public $RequiredSigners;

        /**
         * @var ToBeSigned|null
         */
        public $ToBeSignedDocument;

        /**
         * @var string|null
         */
        public $Title;

    };
}

