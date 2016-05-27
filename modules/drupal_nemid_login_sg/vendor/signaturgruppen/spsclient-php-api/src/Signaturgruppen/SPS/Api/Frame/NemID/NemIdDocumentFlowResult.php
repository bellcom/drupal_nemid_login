<?php

namespace Signaturgruppen\SPS\Api\Frame\NemID {

    class NemIdDocumentFlowResult extends NemIDFlowResult
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
         * @var string|null
         */
        public $DocumentId;

    };
}

