<?php

namespace Signaturgruppen\SPS\Api\Services\Document {

    class SignedDocument
    {
        /**
         * @var string|null
         */
        public $Id;

        /**
         * @var ToBeSigned|null
         */
        public $ToBeSignedDocument;

        /**
         * @var string|null
         */
        public $Signature;

        /**
         * @var string|null
         */
        public $SignatureType;

        /**
         * @var string|null
         */
        public $SigningCertificate;

    };
}

