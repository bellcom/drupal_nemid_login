<?php

namespace Signaturgruppen\SPS\Api\Frame {

    use Signaturgruppen\SPS\Api\Body;

    abstract class FlowMessage extends Body
    {
        /**
         * @var string|null
         */
        public $Timestamp;

        /**
         * @var string|null
         */
        public $TransactionIdentifier;

    };
}

