<?php

namespace Signaturgruppen\SPS\Api\Services\Document {

    class DocumentSummary
    {
        /**
         * @var string|null
         */
        public $DocumentId;

        /**
         * @var string|null
         */
        public $Title;

        /**
         * @var int|null
         */
        public $CreateTime;

        /**
         * @var String[]
         */
        public $PendingSigners;

    };
}

