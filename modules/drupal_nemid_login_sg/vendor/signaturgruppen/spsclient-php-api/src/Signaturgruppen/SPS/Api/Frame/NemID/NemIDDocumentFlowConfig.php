<?php

namespace Signaturgruppen\SPS\Api\Frame\NemID {

    use Signaturgruppen\SPS\Api\Services\Document\SignerIdentity;

    class NemIDDocumentFlowConfig extends NemIDFlowConfig
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
         * @var SignerIdentity[]
         */
        public $SignerIdentities;

        /**
         * @var string|null
         */
        public $Cpr;

        /**
         * @var string|null
         */
        public $DocumentId;

    };
}

