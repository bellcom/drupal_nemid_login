<?php

namespace Signaturgruppen\SPS\Api\Frame\NemID {

    class NemIDFlowConfig extends OcesFlowConfig
    {
        public function mustEncrypt()
        {
            return false;
        }

        public function mustSign()
        {
            return true;
        }

        /**
         * @var bool|null
         */
        public $UseLimitedMode;

    };
}

