<?php

namespace Signaturgruppen\SPS\Api\Services\Document {

    class DocumentData
    {
        /**
         * @var string|null
         */
        public $DocumentId;

        /**
         * @var ToBeSigned|null
         */
        public $ToBeSignedDocument;

        /**
         * @var Signer[]
         */
        public $Signers;

        /**
         * @var string|null
         */
        public $Title;

    };
}

