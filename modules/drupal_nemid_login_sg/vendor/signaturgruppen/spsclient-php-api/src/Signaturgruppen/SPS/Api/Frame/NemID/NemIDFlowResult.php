<?php

namespace Signaturgruppen\SPS\Api\Frame\NemID {

    use Signaturgruppen\SPS\Api\Frame\FlowResult;

    class NemIDFlowResult extends FlowResult
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
         * @var AuthenticationInfo|null
         */
        public $AuthenticationInfo;

    };
}

